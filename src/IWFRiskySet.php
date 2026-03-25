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

namespace IWF\CodingStandard;

use IWFWeb\CodingStandard\IWFWebStandardRiskySet;

/**
 * @deprecated Use {@see IWFWebStandardRiskySet} instead. Will be removed in v2.0.
 *
 * TODO: Remove in v2.0
 */
class IWFRiskySet extends IWFWebStandardRiskySet
{
    public function __construct()
    {
        parent::__construct();

        @trigger_error(\sprintf(
            'Class "%s" is deprecated, use "%s" instead. It will be removed in v2.0.',
            self::class,
            IWFWebStandardRiskySet::class,
        ), E_USER_DEPRECATED);
    }

    public function getDescription(): string
    {
        return 'Deprecated: Use @IWFWeb/standard:risky instead. '.parent::getDescription();
    }

    public function getName(): string
    {
        return '@IWF/standard:risky';
    }
}
