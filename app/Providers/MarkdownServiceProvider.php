<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CommonMarkConverter::class, function ($app) {
            return new CommonMarkConverter([
                'html_input' => 'allow', // Permite HTML no Markdown
                'allow_unsafe_links' => true, // Permite links potencialmente inseguros
            ]);
        });
    }
}
