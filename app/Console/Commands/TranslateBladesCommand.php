<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TranslateBladesCommand extends Command
{
    protected $signature = 'translations:wrap-blades {--path=resources/views/admin}';
    protected $description = 'Automatically wrap raw english texts in blade templates with translation keys';

    public function handle()
    {
        $path = base_path($this->option('path'));
        
        if (!File::isDirectory($path)) {
            $this->error("Path does not exist: {$path}");
            return;
        }

        $files = File::allFiles($path);
        
        $tagsToWrap = ['th', 'label', 'button', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span'];

        $count = 0;

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $originalContent = file_get_contents($file->getRealPath());
            $content = $originalContent;

            // Pattern to match <tag ...> Text </tag> where Text is mostly capitalized words
            // without existing blade directives
            $pattern = '/<(' . implode('|', $tagsToWrap) . ')([^>]*)>\s*([A-Z][a-zA-Z0-9\s]+)\s*<\/\1>/s';
            
            $content = preg_replace_callback($pattern, function($matches) {
                $tag = $matches[1];
                $attributes = $matches[2];
                $text = trim($matches[3]);
                
                // Skip if it contains blade curly braces or directives
                if (strpos($text, '{{') !== false || strpos($text, '@') !== false) {
                    return $matches[0];
                }
                
                // Generate a translation key
                $key = Str::snake($text);
                
                return "<{$tag}{$attributes}>{{ __('messages.{$key}') }}</{$tag}>";
            }, $content);

            // Also target text right before a closing tag like Option values: <option value="x">Value</option>
            $optionPattern = '/<option([^>]*)>\s*([A-Z][a-zA-Z0-9\s]+)\s*<\/option>/s';
            $content = preg_replace_callback($optionPattern, function($matches) {
                $attributes = $matches[1];
                $text = trim($matches[2]);
                if (strpos($text, '{{') !== false || strpos($text, '@') !== false) {
                    return $matches[0];
                }
                $key = Str::snake($text);
                return "<option{$attributes}>{{ __('messages.{$key}') }}</option>";
            }, $content);

            if ($content !== $originalContent) {
                File::put($file->getRealPath(), $content);
                $this->info("Updated {$file->getRelativePathname()}");
                $count++;
            }
        }

        $this->info("Wrapped texts in {$count} files.");
        $this->info("Now run `php artisan translations:sync` to add the new keys to your language files.");
    }
}
