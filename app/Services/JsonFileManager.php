<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JsonFileManager
{
    private const ALLOWED_FOLDERS = ['equipamentos', 'inputs', 'multiplicadores'];
    private const BACKUP_FOLDER = 'backups';

    public static function validateFolder(string $folder): bool
    {
        return in_array($folder, self::ALLOWED_FOLDERS);
    }

    public static function getFilePath(string $folder, string $filename): string
    {
        return "{$folder}/{$filename}.json";
    }

    public static function exists(string $folder, string $filename): bool
    {
        return Storage::exists(self::getFilePath($folder, $filename));
    }

    public static function get(string $folder, string $filename): ?array
    {
        $filePath = self::getFilePath($folder, $filename);
        
        if (!Storage::exists($filePath)) {
            return null;
        }

        $content = Storage::get($filePath);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON format in file {$filePath}");
        }

        return $data;
    }

    public static function store(string $folder, string $filename, array $content): bool
    {
        if (!self::validateFolder($folder)) {
            throw new \InvalidArgumentException("Invalid folder: {$folder}");
        }

        $filePath = self::getFilePath($folder, $filename);

        // Create backup if file exists
        if (Storage::exists($filePath)) {
            self::createBackup($folder, $filename);
        }

        return Storage::put($filePath, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public static function delete(string $folder, string $filename): bool
    {
        $filePath = self::getFilePath($folder, $filename);

        if (!Storage::exists($filePath)) {
            return false;
        }

        // Create backup before deletion
        self::createBackup($folder, $filename);

        return Storage::delete($filePath);
    }

    public static function listFiles(string $folder): array
    {
        if (!self::validateFolder($folder)) {
            throw new \InvalidArgumentException("Invalid folder: {$folder}");
        }

        $files = Storage::files($folder);
        
        return array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);
    }

    private static function createBackup(string $folder, string $filename): void
    {
        $filePath = self::getFilePath($folder, $filename);
        $backupPath = self::BACKUP_FOLDER . '/' . $folder . '/' . $filename . '_' . date('Y-m-d_H-i-s') . '.json';

        if (Storage::exists($filePath)) {
            Storage::copy($filePath, $backupPath);
        }
    }

    public static function restoreBackup(string $backupPath): bool
    {
        if (!Storage::exists($backupPath)) {
            return false;
        }

        $pathParts = explode('/', $backupPath);
        $filename = $pathParts[count($pathParts) - 1];
        $folder = $pathParts[count($pathParts) - 2];

        // Remove timestamp from filename
        $originalFilename = preg_replace('/_\d{4}-\d{2}-\d{2}_\d{2}-\d{2}-\d{2}\.json$/', '', $filename);

        return Storage::copy($backupPath, self::getFilePath($folder, $originalFilename));
    }

    public static function validateJsonStructure(array $content, string $type): bool
    {
        // Basic structure validation
        if ($type === 'inputs' || $type === 'multiplicadores') {
            return isset($content['sections']) && is_array($content['sections']);
        }

        if ($type === 'equipamentos') {
            return isset($content['equipamentos']) && is_array($content['equipamentos']);
        }

        return false;
    }
} 