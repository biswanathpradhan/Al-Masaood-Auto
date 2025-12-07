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
use Mockery\Generator\Method;
use Mockery\Generator\Parameter;
use Mockery\Generator\MockConfiguration;

class AvoidMethodClashPass implements Pass
{
    public function apply($code, MockConfiguration $config)
    {
        $names = array_map(function ($method) {
            return $method->getName();
        }, $config->getMethodsToMock());

        foreach (["allows", "expects"] as $method) {
            if (in_array($method, $names)) {
                $code = preg_replace(
                    "#// start method {$method}.*// end method {$method}#ms",
                    "",
                    $code
                );

                $code = str_replace(" implements MockInterface", " implements LegacyMockInterface", $code);
=======
use Mockery\Generator\MockConfiguration;
use function array_map;
use function in_array;
use function preg_replace;
use function sprintf;
use function str_replace;

class AvoidMethodClashPass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
    public function apply($code, MockConfiguration $config)
    {
        $names = array_map(static function ($method) {
            return $method->getName();
        }, $config->getMethodsToMock());

        foreach (['allows', 'expects'] as $method) {
            if (in_array($method, $names, true)) {
                $code = preg_replace(sprintf('#// start method %s.*// end method %s#ms', $method, $method), '', $code);

                $code = str_replace(' implements MockInterface', ' implements LegacyMockInterface', $code);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }
        }

        return $code;
    }
}
