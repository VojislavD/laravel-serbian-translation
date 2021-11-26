<?php

namespace VojislavD\LaravelSerbianTranslation\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use VojislavD\LaravelSerbianTranslation\Tests\TestCase;

class InstallLaravelSerbianTranslationTest extends TestCase
{
    /**
     * @test
     */
    public function test_install_command_copies_the_localization_files()
    {
        // Start from a clean state
        if (File::exists(resource_path('lang/sr.json'))) {
            unlink(resource_path('lang/sr.json'));
        }

        if (File::exists(resource_path('lang/sr'))) {
            if (File::exists(resource_path('lang/sr/auth.php'))) {
                unlink(resource_path('lang/sr/auth.php'));
            }

            if (File::exists(resource_path('lang/sr/pagination.php'))) {
                unlink(resource_path('lang/sr/pagination.php'));
            }

            if (File::exists(resource_path('lang/sr/passwords.php'))) {
                unlink(resource_path('lang/sr/passwords.php'));
            }

            if (File::exists(resource_path('lang/sr/validation.php'))) {
                unlink(resource_path('lang/sr/validation.php'));
            }

            rmdir(resource_path('lang/sr'));
        }
        
        $this->assertFalse(File::exists(resource_path('lang/sr.json')));
        $this->assertFalse(File::exists(resource_path('lang/sr')));
        
        Artisan::call('lst:install');
        
        $this->assertTrue(File::exists(resource_path('lang/sr.json')));
        $this->assertTrue(File::exists(resource_path('lang/sr/auth.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/pagination.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/passwords.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/validation.php')));
    }
}