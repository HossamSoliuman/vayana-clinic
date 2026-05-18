<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SyncTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync missing translation keys from blade files to language files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting translation sync...');

        $viewsPath = resource_path('views');
        $bladeFiles = File::allFiles($viewsPath);

        $keys = [];

        // Regex to match __('file.key') or @lang('file.key')
        $pattern = '/(?:__|@lang)\(\s*[\'"]([a-zA-Z0-9_\-\.]+)[\'"]\s*\)/';

        foreach ($bladeFiles as $file) {
            if ($file->getExtension() === 'php') {
                $content = file_get_contents($file->getRealPath());
                if (preg_match_all($pattern, $content, $matches)) {
                    foreach ($matches[1] as $match) {
                        if (strpos($match, '.') !== false) {
                            $keys[] = $match;
                        }
                    }
                }
            }
        }

        $keys = array_unique($keys);
        $groupedKeys = [];

        foreach ($keys as $key) {
            list($file, $item) = explode('.', $key, 2);
            $groupedKeys[$file][] = $item;
        }

        $locales = ['en', 'ar'];

        foreach ($locales as $locale) {
            foreach ($groupedKeys as $file => $items) {
                $langPath = base_path("lang/{$locale}/{$file}.php");
                
                $existingKeys = [];
                if (File::exists($langPath)) {
                    $existingKeys = require $langPath;
                } else {
                    File::ensureDirectoryExists(dirname($langPath));
                }

                $addedCount = 0;
                foreach ($items as $item) {
                    if (!array_key_exists($item, $existingKeys)) {
                        // Generate a sensible default value
                        $defaultValue = Str::title(str_replace('_', ' ', $item));
                        $existingKeys[$item] = $defaultValue;
                        $addedCount++;
                    }
                }

                if ($addedCount > 0) {
                    $this->writeLangFile($langPath, $existingKeys);
                    $this->info("Added {$addedCount} missing keys to {$locale}/{$file}.php");
                } else {
                    $this->info("No missing keys for {$locale}/{$file}.php");
                }
            }
        }

        $this->info('Translation sync complete!');
    }

    /**
     * Write array to language file.
     *
     * @param string $path
     * @param array $data
     * @return void
     */
    protected function writeLangFile($path, array $data)
    {
        $content = "<?php\n\nreturn [\n";
        foreach ($data as $key => $value) {
            // Escape single quotes in value
            $value = str_replace("'", "\'", $value);
            $content .= "    '{$key}' => '{$value}',\n";
        }
        $content .= "];\n";

        File::put($path, $content);
    }
}
