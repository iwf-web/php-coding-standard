<?php declare(strict_types=1);

/**
 * PHP Coding Standard
 *
 * @package   PHP Coding Standard
 * @author    IWF Web Solutions <web-solutions@iwf.ch>
 * @copyright Copyright (c) 2025-2026 IWF Web Solutions <web-solutions@iwf.ch>
 * @license   https://github.com/iwf-web/php-coding-standard/blob/main/LICENSE.txt MIT License
 * @link      https://github.com/iwf-web/php-coding-standard
 */

namespace IWFWeb\CodingStandard;

use PhpCsFixer\RuleSet\AbstractRuleSetDefinition;

/**
 * IWF Web Coding Standard - Risky rules.
 *
 * This ruleset contains risky rules that may change code behavior.
 * These are rules that require careful review as they can affect runtime behavior.
 *
 * Usage: '@IWFWeb/standard:risky' => true
 */
class IWFWebStandardRiskySet extends AbstractRuleSetDefinition
{
    public function getDescription(): string
    {
        return 'IWF Web Coding Standard - Risky rules that may change code behavior.';
    }

    public function getName(): string
    {
        return RuleSetNameResolver::resolve(parent::getName());
    }

    public function getRules(): array
    {
        return [
            // Base risky rulesets
            '@auto:risky' => true, // Automatically chooses PHP & PHPUnit risky rulesets based on composer.json
            '@PhpCsFixer:risky' => true, // includes @Symfony:risky, @PSR12:risky, and more

            // Fix PhpUnit wrong access (mock expecations are not static calls)
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
                'methods' => [
                    'never' => 'this',
                    'once' => 'this',
                    'exactly' => 'this',
                ],
            ],

            // Disable strict types, we use PhpStan for that
            'declare_strict_types' => false,

            // We might want to use a provider for multiple files, so don't force a match
            'php_unit_data_provider_name' => false,

            // Ignore some tags when converting comments to PHPDoc
            'comment_to_phpdoc' => ['ignored_tags' => ['php-cs-fixer-ignore', 'todo']],
        ];
    }
}
