# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Composer package (`iwf-web/php-coding-standard`) that provides custom PHP-CS-Fixer rule sets for IWF Web Solutions projects. It defines two rule sets:
- `@IWFWeb/standard` - Non-risky formatting rules
- `@IWFWeb/standard:risky` - Risky rules that may alter code behavior

## Commands

```bash
# Install dependencies
composer install

# Check code style (dry run)
vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix code style violations
vendor/bin/php-cs-fixer fix

# Fix a single file
vendor/bin/php-cs-fixer fix path/to/file.php
```

No test suite exists - this is a configuration library.

## Architecture

The package contains two source files in `src/`:

- **IWFWebStandardSet.php** - Extends `AbstractRuleSetDefinition`, returns `@IWFWeb/standard`. Builds on `@PhpCsFixer` with customizations: no Yoda style, strict types at file top (no blank line), trailing commas everywhere, preserved single-line DocBlocks.

- **IWFWebStandardRiskySet.php** - Extends `AbstractRuleSetDefinition`, returns `@IWFWeb/standard:risky`. Builds on `@PhpCsFixer:risky` with customizations: PHPUnit uses `self::` instead of `$this->`, flexible data provider naming.

- **IWFSet.php** - Deprecated wrapper for `IWFWebStandardSet`. Will be removed in v2.0.

- **IWFRiskySet.php** - Deprecated wrapper for `IWFWebStandardRiskySet`. Will be removed in v2.0.

## Usage in Other Projects

```php
<?php declare(strict_types=1);

use IWFWeb\CodingStandard\IWFWebStandardRiskySet;
use IWFWeb\CodingStandard\IWFWebStandardSet;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return new Config()
    ->registerCustomRuleSets([
        new IWFWebStandardSet(),
        new IWFWebStandardRiskySet(),
    ])
    ->setFinder(Finder::create()->in(__DIR__))
    ->setRiskyAllowed(true)
    ->setRules([
        '@IWFWeb/standard' => true,
        '@IWFWeb/standard:risky' => true,
    ]);
```

## Code Style

- PHP: 4-space indentation
- Always `declare(strict_types=1);` at file top with no blank line after opening tag
- Natural comparison style (not Yoda)
- Trailing commas in multiline constructs
- UTF-8 encoding, LF line endings
