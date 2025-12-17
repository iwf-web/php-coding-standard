<?php declare(strict_types=1);

/**
 * PHP Coding Standard
 *
 * @package   PHP Coding Standard
 * @author    IWF Web Solutions <web-solutions@iwf.ch>
 * @copyright Copyright (c) 2025-2025 IWF Web Solutions <web-solutions@iwf.ch>
 * @license   https://github.com/iwf-web/php-coding-standard/blob/main/LICENSE.txt MIT License
 * @link      https://github.com/iwf-web/php-coding-standard
 */

namespace IWF\CodingStandard;

use PhpCsFixer\RuleSet\AbstractRuleSetDefinition;

/**
 * IWF Coding Standard - Risky rules.
 *
 * This ruleset contains risky rules that may change code behavior.
 * These are rules that require careful review as they can affect runtime behavior.
 *
 * Usage: '@IWF/standard:risky' => true
 */
final class IWFRiskySet extends AbstractRuleSetDefinition
{
    public function getName(): string
    {
        // @IWF:risky -> @IWF/standard:risky
        return implode(':', array_filter([($parts = explode(':', parent::getName()))[0].'/standard', $parts[1] ?? null]));
    }

    public function getRules(): array
    {
        return [
            // Base risky rulesets
            '@auto:risky' => true, // Automatically chooses PHP & PHPUnit risky rulesets based on composer.json
            '@PhpCsFixer:risky' => true, // includes @Symfony:risky, @PSR12:risky, and more

            // Fix PhpUnit wrong access
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
            ],

            // Disable strict types, we use PhpStan for that
            'declare_strict_types' => false,

            // We might want to use a provider for multiple files, so don't force a match
            'php_unit_data_provider_name' => false,

            // Ignore some tags when converting comments to PHPDoc
            'comment_to_phpdoc' => ['ignored_tags' => ['php-cs-fixer-ignore', 'todo']],
        ];
    }

    public function getDescription(): string
    {
        return 'IWF Coding Standard - Risky rules that may change code behavior.';
    }
}
