<?php declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use IWFWeb\CodingStandard\IWFWebStandardRiskySet;
use IWFWeb\CodingStandard\IWFWebStandardSet;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$year = date('Y');
$header = <<<EOF
    PHP Coding Standard

    @package   PHP Coding Standard
    @author    IWF Web Solutions <web-solutions@iwf.ch>
    @copyright Copyright (c) 2025-{$year} IWF Web Solutions <web-solutions@iwf.ch>
    @license   https://github.com/iwf-web/php-coding-standard/blob/main/LICENSE.txt MIT License
    @link      https://github.com/iwf-web/php-coding-standard
    EOF;

// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/ruleSets/index.rst
// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/index.rst
return (new Config())
    ->registerCustomRuleSets([
        new IWFWebStandardSet(),
        new IWFWebStandardRiskySet(),
    ])
    ->setFinder(Finder::create()
        ->in(__DIR__)
        ->ignoreDotFiles(false)
        ->ignoreVCSIgnored(true),
    )
    ->setUnsupportedPhpVersionAllowed(true)
    ->setRiskyAllowed(true)
    ->setRules([
        '@IWFWeb/standard' => true,
        '@IWFWeb/standard:risky' => true,
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => $header,
        ],
    ])
;

// @php-cs-fixer-ignore header_comment
