# IWF Web PHP Coding Standard

Custom PHP-CS-Fixer rule sets for consistent code style across IWF Web projects.

[![License](https://img.shields.io/github/license/iwf-web/php-coding-standard)][license]
[![Version](https://img.shields.io/packagist/v/iwf-web/php-coding-standard?label=latest%20release)][packagist]
[![Version (including pre-releases)](https://img.shields.io/packagist/v/iwf-web/php-coding-standard?include_prereleases&label=latest%20pre-release)][packagist]
[![Downloads on Packagist](https://img.shields.io/packagist/dt/iwf-web/php-coding-standard)][packagist]

## Rule Sets

This package provides two rule sets:

| Rule Set                 | Description                                                  |
| ------------------------ | ------------------------------------------------------------ |
| `@IWFWeb/standard`       | Non-risky coding style rules for consistent formatting       |
| `@IWFWeb/standard:risky` | Risky rules that may change code behavior (use with caution) |

Both rule sets build upon the excellent `@PhpCsFixer` rule set (which includes `@Symfony` and `@PSR12`) with customizations tailored for IWF Web projects.

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) ^3.88 — the `Config::registerCustomRuleSets()` method used below was added in 3.88; earlier versions cannot load these rule sets

### Installation

```bash
composer require --dev iwf-web/php-coding-standard
```

### Usage

Create a `.php-cs-fixer.dist.php` file in your project root:

```php
<?php declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use IWFWeb\CodingStandard\IWFWebStandardRiskySet;
use IWFWeb\CodingStandard\IWFWebStandardSet;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return new Config()
    ->registerCustomRuleSets([
        new IWFWebStandardSet(),
        new IWFWebStandardRiskySet(),
    ])
    ->setFinder(Finder::create()
        ->in(__DIR__)
    )
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        '@IWFWeb/standard' => true,
        '@IWFWeb/standard:risky' => true,
    ])
;
```

Run the fixer:

```bash
# Check for violations (dry run)
vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix violations
vendor/bin/php-cs-fixer fix
```

## Rule Customizations

### @IWFWeb/standard

Key customizations over the base `@PhpCsFixer` rule set:

- **No Yoda style** - Uses natural comparison order (`$value === null` instead of `null === $value`)
- **Strict types at top** - No blank line after opening tag to keep `declare(strict_types=1);` at the very top
- **Simplified class ordering** - Only requires traits to be placed first in classes
- **Preserved DocBlocks** - Single-line DocBlocks are preserved; `@inheritDoc` is not removed
- **Trailing commas everywhere** - In arrays, arguments, parameters, and match expressions
- **PHPUnit flexibility** - Does not require `@covers` annotations on test classes

### @IWFWeb/standard:risky

Key customizations over the base `@PhpCsFixer:risky` rule set:

- **PHPUnit assertions** - Uses `self::` for test case static method calls
- **No forced strict types** - Relies on PHPStan for type safety instead of enforcing `declare(strict_types=1);`
- **Flexible data providers** - Does not enforce naming conventions for PHPUnit data providers
- **Ignored comment tags** - Preserves `php-cs-fixer-ignore` and `todo` comments

## Migration from v1.x

In v1.x, the namespace was `IWF\CodingStandard` with classes `IWFSet` and `IWFRiskySet`, and rule sets `@IWF/standard` and `@IWF/standard:risky`. These still work but are **deprecated** and will be removed in v2.0.

To migrate, update your `.php-cs-fixer.dist.php`:

```diff
-use IWF\CodingStandard\IWFRiskySet;
-use IWF\CodingStandard\IWFSet;
+use IWFWeb\CodingStandard\IWFWebStandardRiskySet;
+use IWFWeb\CodingStandard\IWFWebStandardSet;

 return new Config()
     ->registerCustomRuleSets([
-        new IWFSet(),
-        new IWFRiskySet(),
+        new IWFWebStandardSet(),
+        new IWFWebStandardRiskySet(),
     ])
     ->setRules([
-        '@IWF/standard' => true,
-        '@IWF/standard:risky' => true,
+        '@IWFWeb/standard' => true,
+        '@IWFWeb/standard:risky' => true,
     ])
 ;
```

## Contributing

Please read [CONTRIBUTING.md][contributing] for details on our code of conduct and the process for submitting pull requests.

This project uses [Conventional Commits](https://www.conventionalcommits.org/) for automated releases and changelog generation.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For available versions, see the [tags on this repository][gh-tags].

## Authors

### Special thanks for all the people who had helped this project so far

- **Manuele** - [D3strukt0r](https://github.com/D3strukt0r)

See also the full list of [contributors][gh-contributors] who participated in this project.

### I would like to join this list. How can I help the project?

We're currently looking for contributions for the following:

- [ ] Bug fixes
- [ ] Translations
- [ ] etc...

For more information, please refer to our [CONTRIBUTING.md][contributing] guide.

## License

This project is licensed under the MIT License - see the [LICENSE.txt](LICENSE.txt) file for details.

## Acknowledgments

This project currently uses no third-party libraries or copied code.

[license]: https://github.com/iwf-web/php-coding-standard/blob/main/LICENSE.txt
[packagist]: https://packagist.org/packages/iwf-web/php-coding-standard
[gh-tags]: https://github.com/iwf-web/php-coding-standard/tags
[gh-contributors]: https://github.com/iwf-web/php-coding-standard/contributors
[contributing]: https://github.com/iwf-web/.github/blob/main/CONTRIBUTING.md
