# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Composer package (`iwf-web/php-coding-standard`) that provides custom PHP-CS-Fixer rule sets for IWF Web Solutions projects. It defines two rule sets:
- `@IWF/standard` - Non-risky formatting rules
- `@IWF/standard:risky` - Risky rules that may alter code behavior

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

- **IWFSet.php** - Extends `AbstractRuleSetDefinition`, returns `@IWF/standard`. Builds on `@PhpCsFixer` with customizations: no Yoda style, strict types at file top (no blank line), trailing commas everywhere, preserved single-line DocBlocks.

- **IWFRiskySet.php** - Extends `AbstractRuleSetDefinition`, returns `@IWF/standard:risky`. Builds on `@PhpCsFixer:risky` with customizations: PHPUnit uses `self::` instead of `$this->`, flexible data provider naming.

## Usage in Other Projects

```php
<?php declare(strict_types=1);

use IWF\CodingStandard\IWFRiskySet;
use IWF\CodingStandard\IWFSet;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return new Config()
    ->registerCustomRuleSets([
        new IWFSet(),
        new IWFRiskySet(),
    ])
    ->setFinder(Finder::create()->in(__DIR__))
    ->setRiskyAllowed(true)
    ->setRules([
        '@IWF/standard' => true,
        '@IWF/standard:risky' => true,
    ]);
```

## Code Style

- PHP: 4-space indentation
- Always `declare(strict_types=1);` at file top with no blank line after opening tag
- Natural comparison style (not Yoda)
- Trailing commas in multiline constructs
- UTF-8 encoding, LF line endings
