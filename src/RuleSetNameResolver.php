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

/**
 * Resolves a base rule set name from {@see AbstractRuleSetDefinition::getName()}
 * into the final rule set name with vendor prefix separation.
 *
 * Takes the output of parent::getName() (e.g. @IWFWebStandard or @IWFWebStandard:risky)
 * and inserts a "/" between the vendor prefix and the set name.
 *
 * Examples:
 * - @IWFWebStandard       -> @IWFWeb/standard
 * - @IWFWebStandard:risky -> @IWFWeb/standard:risky
 *
 * @internal
 */
final class RuleSetNameResolver
{
    private const VENDOR_PREFIX = 'IWFWeb';

    /**
     * Resolve a base rule set name to the final rule set name.
     *
     * @param string $baseName the output of parent::getName()
     */
    public static function resolve(string $baseName): string
    {
        // Split off :risky suffix if present
        $parts = explode(':', $baseName);

        // Strip @ prefix, then strip vendor prefix to get set name
        $setName = substr($parts[0], 1 + \strlen(self::VENDOR_PREFIX));

        // Rebuild: @IWFWeb/{setname}[:risky]
        return implode(':', array_filter([
            '@'.self::VENDOR_PREFIX.'/'.strtolower($setName),
            $parts[1] ?? null,
        ]));
    }
}
