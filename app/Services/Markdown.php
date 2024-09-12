<?php

namespace App\Services;

use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use Illuminate\Support\Str;
use App\Services\DirectoryScannerService;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;


class Markdown
{ 
    /* Converte um conteúdo Markdown em um vetor com as informações do Front Matter.
    *
    * @param File $markdown
    * @return Array $frontMatter
    * @author Antonio A. Campos, em 22/08/2024
    */
    public static function md2FrontMatter($markdown) 
    {
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension()); // Extensões para interpretar o Markdown
        $environment->addExtension(new FrontMatterExtension()); // Suporte para Front Matter
        
        $converter = new MarkdownConverter($environment);
        $result = $converter->convert($markdown);
        
        if ($result instanceof RenderedContentWithFrontMatter) {
            $frontMatter = $result->getFrontMatter(); // Retorna o Front Matter se presente
            return $frontMatter;
        } else {
            throw new \Exception('Não contém front matter.'); 
        }
    }

    /* Converte o conteúdo de um arquivo Markdown para HTML.
    *
    * @param File $markdown, File $style optional
    * @return HTML
    * @author Antonio A. Campos, em 22/08/2024
    */
    public static function md2html($markdown, $style = 'default.css') 
    { 
        $config = [];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension()); // Sxtensões para interpretar o Markdown
        $environment->addExtension(new FrontMatterExtension()); // Suporte para Front Matter, necessária para não ser exibido como HTML

        $environment->addExtension(new GithubFlavoredMarkdownExtension()); // suporte para GitHub Flavored Markdown
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer()); // renderizador para blocos de código com destaque
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer()); // renderizador para código indentado

        $converter = new MarkdownConverter($environment);
       
        $html = '<style>' . file_get_contents(base_path('vendor/scrivo/highlight.php/styles/' . $style)) . '</style>';  // Adiciona o estilo padrão
        $html .= $converter->convertToHtml($markdown); 
        return $html; 
    } 


    /* Gera e exibe uma lista HTML dos diretórios e arquivos (estrutura), com links para arquivos baseados no Front Matter.
    *
    * @param Array $structure, Array $files
    * @return void
    * @author Antonio A. Campos, em 22/08/2024
    */
    public static function displayDirectories($structure, $files)
    {
        foreach ($structure as $folder => $subfolders) {
            $folderPath = '/' . htmlspecialchars($folder);
            echo "<li>" . htmlspecialchars($folder) . "</li>";
            echo "<ul>";
            
            foreach ($files as $file) {
                $pathname = $file->getPathname();
                if (file_exists($pathname)) {
                    $content = file_get_contents($pathname); // Obtém o conteúdo do arquivo para extrair o front matter
                    $frontMatter = Markdown::md2FrontMatter($content);

                    $pathToParent = $frontMatter["parentspath"]; // Obtém as informações mais importantes do front matter
                    $parentFolder = $frontMatter["parent"];
                    $title = $frontMatter["title"];

                    $fileName = Str::afterLast($pathname, '/');
                    
                    if (strtoupper($parentFolder) == strtoupper(Str::title($folder))) { // Verifica se o diretório é o que contém o arquivo, segundo o front matter
                        echo "<li><a href='./".$pathToParent . "/" . $parentFolder . "/" . $fileName . "'>" . htmlspecialchars($title) . "</a></li>";
                    }   
                }
            }
            
            if (is_array($subfolders)) {
                self::displayDirectories($subfolders, $files, $folderPath); // chama recursivamente para os subdiretórios
            }
            echo "</ul>";
        }
    }
}
