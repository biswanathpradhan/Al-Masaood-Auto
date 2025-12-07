<?php
<<<<<<< HEAD
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======

/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 */

namespace Mockery\Generator\StringManipulation\Pass;

<<<<<<< HEAD
use Mockery\Generator\MockConfiguration;

class InterfacePass implements Pass
{
    public function apply($code, MockConfiguration $config)
    {
        foreach ($config->getTargetInterfaces() as $i) {
            $name = ltrim($i->getName(), "\\");
            if (!interface_exists($name)) {
                \Mockery::declareInterface($name);
            }
        }

        $interfaces = array_reduce((array) $config->getTargetInterfaces(), function ($code, $i) {
            return $code . ", \\" . ltrim($i->getName(), "\\");
        }, "");

        $code = str_replace(
            "implements MockInterface",
            "implements MockInterface" . $interfaces,
            $code
        );

        return $code;
=======
use Mockery;
use Mockery\Generator\MockConfiguration;
use function array_reduce;
use function interface_exists;
use function ltrim;
use function str_replace;

class InterfacePass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
    public function apply($code, MockConfiguration $config)
    {
        foreach ($config->getTargetInterfaces() as $i) {
            $name = ltrim($i->getName(), '\\');
            if (! interface_exists($name)) {
                Mockery::declareInterface($name);
            }
        }

        $interfaces = array_reduce($config->getTargetInterfaces(), static function ($code, $i) {
            return $code . ', \\' . ltrim($i->getName(), '\\');
        }, '');

        return str_replace('implements MockInterface', 'implements MockInterface' . $interfaces, $code);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
