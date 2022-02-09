# Laravel translation to Serbian language

---

This Laravel package translates default Laravel's localization files and <a href="https://github.com/laravel/jetstream">Jetstream</a>, <a href="https://github.com/laravel/breeze">Breeze</a> packages to Serbian language.

Once package is installed, run install command and choose writing system between Latin and Cyrillic.

## Installation

You can install the package via composer:

```bash
composer require vojislavd/laravel-serbian-translation
```

After that run install command:
```bash
php artisan lst:install
```

Package offers two writing systems, Latin and Cyrillic. You can choose one you want during package installation.

#### NOTE
Package will overwrite `lang/sr.json` file and default files in `lang\sr` directory, if present.

## Testing
Run the tests with:

```bash
composer test
```

## Credits

- [Vojislav Dragicevic](https://vojislavd.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
