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
    public function test_install_command_copies_the_localization_files_latin()
    {
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
        
        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Latin')
            ->expectsOutput('Localization files published.');

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin.json'),
            file_get_contents(resource_path('lang/sr.json'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/auth.php'),
            file_get_contents(resource_path('lang/sr/auth.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/pagination.php'),
            file_get_contents(resource_path('lang/sr/pagination.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/passwords.php'),
            file_get_contents(resource_path('lang/sr/passwords.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/validation.php'),
            file_get_contents(resource_path('lang/sr/validation.php'))
        );
    }

    /**
     * @test
     */
    public function test_install_command_copies_the_localization_files_cyrillic()
    {
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
        
        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Cyrillic')
            ->expectsOutput('Localization files published.');

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic.json'),
            file_get_contents(resource_path('lang/sr.json'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/auth.php'),
            file_get_contents(resource_path('lang/sr/auth.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/pagination.php'),
            file_get_contents(resource_path('lang/sr/pagination.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/passwords.php'),
            file_get_contents(resource_path('lang/sr/passwords.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/validation.php'),
            file_get_contents(resource_path('lang/sr/validation.php'))
        );
    }

    /**
     * @test
     */
    public function test_when_a_localization_files_are_present_and_user_choose_to_not_overwrite_it_latin()
    {
        File::put(resource_path('lang/sr.json'), 'Test Content sr.json');
        File::put(resource_path('lang/sr/auth.php'), 'Test Content auth.php');
        File::put(resource_path('lang/sr/pagination.php'), 'Test Content pagination.php');
        File::put(resource_path('lang/sr/passwords.php'), 'Test Content passwords.php');
        File::put(resource_path('lang/sr/validation.php'), 'Test Content validation.php');

        $this->assertTrue(File::exists(resource_path('lang/sr.json')));
        $this->assertTrue(File::exists(resource_path('lang/sr/auth.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/pagination.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/passwords.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/validation.php')));

        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Latin')
            ->expectsQuestion('Localization files for Serbian language already exists. Do you want to overwrite it?', false)
            ->expectsOutput('Existing localization files not overwritten.');

        $this->assertEquals('Test Content sr.json', file_get_contents(resource_path('lang/sr.json')));
        $this->assertEquals('Test Content auth.php', file_get_contents(resource_path('lang/sr/auth.php')));
        $this->assertEquals('Test Content pagination.php', file_get_contents(resource_path('lang/sr/pagination.php')));
        $this->assertEquals('Test Content passwords.php', file_get_contents(resource_path('lang/sr/passwords.php')));
        $this->assertEquals('Test Content validation.php', file_get_contents(resource_path('lang/sr/validation.php')));
    }

    /**
     * @test
     */
    public function test_when_a_localization_files_are_present_and_user_choose_to_not_overwrite_it_cyrillic()
    {
        File::put(resource_path('lang/sr.json'), 'Test Content sr.json');
        File::put(resource_path('lang/sr/auth.php'), 'Test Content auth.php');
        File::put(resource_path('lang/sr/pagination.php'), 'Test Content pagination.php');
        File::put(resource_path('lang/sr/passwords.php'), 'Test Content passwords.php');
        File::put(resource_path('lang/sr/validation.php'), 'Test Content validation.php');

        $this->assertTrue(File::exists(resource_path('lang/sr.json')));
        $this->assertTrue(File::exists(resource_path('lang/sr/auth.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/pagination.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/passwords.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/validation.php')));

        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Cyrillic')
            ->expectsQuestion('Localization files for Serbian language already exists. Do you want to overwrite it?', false)
            ->expectsOutput('Existing localization files not overwritten.');

        $this->assertEquals('Test Content sr.json', file_get_contents(resource_path('lang/sr.json')));
        $this->assertEquals('Test Content auth.php', file_get_contents(resource_path('lang/sr/auth.php')));
        $this->assertEquals('Test Content pagination.php', file_get_contents(resource_path('lang/sr/pagination.php')));
        $this->assertEquals('Test Content passwords.php', file_get_contents(resource_path('lang/sr/passwords.php')));
        $this->assertEquals('Test Content validation.php', file_get_contents(resource_path('lang/sr/validation.php')));
    }

    /**
     * @test
     */
    public function test_when_a_localization_files_are_present_and_user_choose_to_overwrite_it_latin()
    {
        File::put(resource_path('lang/sr.json'), 'Test Content sr.json');
        File::put(resource_path('lang/sr/auth.php'), 'Test Content auth.php');
        File::put(resource_path('lang/sr/pagination.php'), 'Test Content pagination.php');
        File::put(resource_path('lang/sr/passwords.php'), 'Test Content passwords.php');
        File::put(resource_path('lang/sr/validation.php'), 'Test Content validation.php');

        $this->assertTrue(File::exists(resource_path('lang/sr.json')));
        $this->assertTrue(File::exists(resource_path('lang/sr/auth.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/pagination.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/passwords.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/validation.php')));

        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Latin')
            ->expectsQuestion('Localization files for Serbian language already exists. Do you want to overwrite it?', true)
            ->expectsOutput('Overwritting localization files...');

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin.json'),
            file_get_contents(resource_path('lang/sr.json'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/auth.php'),
            file_get_contents(resource_path('lang/sr/auth.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/pagination.php'),
            file_get_contents(resource_path('lang/sr/pagination.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/passwords.php'),
            file_get_contents(resource_path('lang/sr/passwords.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_latin/validation.php'),
            file_get_contents(resource_path('lang/sr/validation.php'))
        );
    }

    /**
     * @test
     */
    public function test_when_a_localization_files_are_present_and_user_choose_to_overwrite_it_cyrillic()
    {
        File::put(resource_path('lang/sr.json'), 'Test Content sr.json');
        File::put(resource_path('lang/sr/auth.php'), 'Test Content auth.php');
        File::put(resource_path('lang/sr/pagination.php'), 'Test Content pagination.php');
        File::put(resource_path('lang/sr/passwords.php'), 'Test Content passwords.php');
        File::put(resource_path('lang/sr/validation.php'), 'Test Content validation.php');

        $this->assertTrue(File::exists(resource_path('lang/sr.json')));
        $this->assertTrue(File::exists(resource_path('lang/sr/auth.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/pagination.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/passwords.php')));
        $this->assertTrue(File::exists(resource_path('lang/sr/validation.php')));

        $this->artisan('lst:install')
            ->expectsQuestion('Which writing system you want to use?', 'Cyrillic')
            ->expectsQuestion('Localization files for Serbian language already exists. Do you want to overwrite it?', true)
            ->expectsOutput('Overwritting localization files...');

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic.json'),
            file_get_contents(resource_path('lang/sr.json'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/auth.php'),
            file_get_contents(resource_path('lang/sr/auth.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/pagination.php'),
            file_get_contents(resource_path('lang/sr/pagination.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/passwords.php'),
            file_get_contents(resource_path('lang/sr/passwords.php'))
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/lang/sr_cyrillic/validation.php'),
            file_get_contents(resource_path('lang/sr/validation.php'))
        );

        // Clean up
        unlink(resource_path('lang/sr.json'));
        unlink(resource_path('lang/sr/auth.php'));
        unlink(resource_path('lang/sr/pagination.php'));
        unlink(resource_path('lang/sr/passwords.php'));
        unlink(resource_path('lang/sr/validation.php'));
        rmdir(resource_path('lang/sr'));
    }
}