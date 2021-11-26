<?php

namespace VojislavD\LaravelSerbianTranslation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallLaravelSerbianTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lst:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install LaravelSerbianTranslation package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->translationFilesExists()) {
            $this->publishTranslationFiles();
            $this->info('Localization files published.');
        } else {
            if ($this->shouldOverwriteTranslationFiles()) {
                $this->info('Overwritting localization files...');
                $this->publishTranslationFiles(true);
                $this->info('Localization files published.');
            } else {
                $this->info('Existing localization files not overwritten.');
            }
        }
    }

    /**
     * Check if localization files already exists.
     *
     * @return bool
     */
    private function translationFilesExists()
    {
        return (File::exists(resource_path('lang/sr')) || File::exists(resource_path('lang/sr.json')));
    }

    /**
     * Ask permission to overwrite existsing localization files.
     *
     * @return bool
     */
    private function shouldOverwriteTranslationFiles()
    {
        return $this->confirm(
            'Localization files for Serbian language already exists. Do you want to overwrite it?',
            false
        );
    }

    /**
     * Publish localization files.
     *
     * @return void
     */
    private function publishTranslationFiles($forcePublish = false)
    {
        $params = [
            '--provider' => "VojislavD\LaravelSerbianTranslation\LaravelSerbianTranslationServiceProvider",
            '--tag' => "localization-serbian"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}