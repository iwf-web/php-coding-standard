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
 * IWF Coding Standard - Non-risky rules.
 *
 * This ruleset contains all non-risky coding style rules
 * that are standard across IWF projects.
 *
 * Usage: '@IWF/standard' => true
 */
final class IWFSet extends AbstractRuleSetDefinition
{
    public function getName(): string
    {
        // @IWF -> @IWF/standard
        return implode(':', array_filter([($parts = explode(':', parent::getName()))[0].'/standard', $parts[1] ?? null]));
    }

    public function getRules(): array
    {
        return [
            // Base rulesets
            '@auto' => true, // Automatically chooses PHP rulesets based on composer.json
            '@PhpCsFixer' => true, // includes @Symfony, @PSR12, and more

            // No header, since no licence to put
            'header_comment' => [
                'header' => '',
            ],

            // Don't use unreadable yoda style
            'yoda_style' => [
                'equal' => false,
                'identical' => false,
                'less_and_greater' => false,
            ],

            // Required, so "declare(strict_types=1);" is always on top
            'blank_line_after_opening_tag' => false,
            'linebreak_after_opening_tag' => false,

            // Reset order to simply put traits first
            'ordered_class_elements' => ['order' => ['use_trait']],

            // Keep single line DocBlocks to overwrite types
            'single_line_comment_style' => ['comment_types' => ['hash']],

            // Remove "yield" from requiring one space before (from base @PhpCsFixer)
            'blank_line_before_statement' => ['statements' => [
                'break', 'continue', 'declare', 'default', 'exit', 'goto',
                'include', 'include_once', 'phpdoc', 'require', 'require_once',
                'return', 'switch', 'throw', 'try', 'yield_from',
            ]],

            // Add PhpUnit DocBlocks grouping
            'phpdoc_separation' => ['groups' => [
                ['deprecated', 'link', 'see', 'since'],
                ['author', 'copyright', 'license'],
                ['category', 'package', 'subpackage'],
                ['property', 'property-read', 'property-write'],
                // PhpUnit
                ['internal', 'internalNothing', 'covers', 'coversNothing'],
            ]],

            // Keep space between constructor parameters in Messages
            'method_argument_space' => ['on_multiline' => 'ignore'],

            // Revert requiring @covers/@coversNothing for tests
            'php_unit_test_class_requires_covers' => false,

            // Do not remove @inheritDoc
            'no_superfluous_phpdoc_tags' => [
                'allow_hidden_params' => true,
                'allow_mixed' => true,
                'remove_inheritdoc' => false,
            ],

            // Always add trailing comma
            'trailing_comma_in_multiline' => [
                'after_heredoc' => true,
                'elements' => ['arguments', 'array_destructuring', 'arrays', 'match', 'parameters'],
            ],
        ];
    }

    public function getDescription(): string
    {
        return 'IWF Coding Standard - Non-risky rules for consistent code style across IWF projects.';
    }
}
