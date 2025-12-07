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
 * @author     Boris Avdeev <elephant@lislon.ru>
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

use Mockery\Generator\MockConfiguration;
<<<<<<< HEAD
=======
use function preg_replace;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

/**
 * Remove mock's empty destructor if we tend to use original class destructor
 */
<<<<<<< HEAD
class RemoveDestructorPass
{
=======
class RemoveDestructorPass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function apply($code, MockConfiguration $config)
    {
        $target = $config->getTargetClass();

<<<<<<< HEAD
        if (!$target) {
            return $code;
        }

        if (!$config->isMockOriginalDestructor()) {
            $code = preg_replace('/public function __destruct\(\)\s+\{.*?\}/sm', '', $code);
=======
        if (! $target) {
            return $code;
        }

        if (! $config->isMockOriginalDestructor()) {
            return preg_replace('/public function __destruct\(\)\s+\{.*?\}/sm', '', $code);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return $code;
    }
}
