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
        $writingSystem = $this->chooseWritingSystem();
        
        if ($writingSystem === 'Latin') {
            if (! $this->translationFilesExists()) {
                $this->publishTranslationFilesLatin();
                $this->info('Localization files published.');
            } else {
                if ($this->shouldOverwriteTranslationFiles()) {
                    $this->info('Overwritting localization files...');
                    $this->publishTranslationFilesLatin(true);
                    $this->info('Localization files published.');
                } else {
                    $this->info('Existing localization files not overwritten.');
                }
            }
        } else if ($writingSystem === 'Cyrillic') {
            if (! $this->translationFilesExists()) {
                $this->publishTranslationFilesCyrillic();
                $this->info('Localization files published.');
            } else {
                if ($this->shouldOverwriteTranslationFiles()) {
                    $this->info('Overwritting localization files...');
                    $this->publishTranslationFilesCyrillic(true);
                    $this->info('Localization files published.');
                } else {
                    $this->info('Existing localization files not overwritten.');
                }
            }
        }
    }

    /**
     * Choose writing system between Latin and Cyrillic
     * 
     * @return int
     */
    public function chooseWritingSystem()
    {
        return $this->choice(
            'Which writing system you want to use?',
            ['Latin', 'Cyrillic'],
            0
        );
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
    private function publishTranslationFilesLatin($forcePublish = false)
    {
        $params = [
            '--provider' => "VojislavD\LaravelSerbianTranslation\LaravelSerbianTranslationServiceProvider",
            '--tag' => "localization-serbian-latin"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    /**
     * Publish localization files.
     *
     * @return void
     */
    private function publishTranslationFilesCyrillic($forcePublish = false)
    {
        $params = [
            '--provider' => "VojislavD\LaravelSerbianTranslation\LaravelSerbianTranslationServiceProvider",
            '--tag' => "localization-serbian-cyrillic"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}