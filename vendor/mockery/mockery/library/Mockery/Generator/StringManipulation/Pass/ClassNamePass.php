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

use Mockery\Generator\MockConfiguration;
<<<<<<< HEAD

class ClassNamePass implements Pass
{
=======
use function ltrim;
use function str_replace;

class ClassNamePass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function apply($code, MockConfiguration $config)
    {
        $namespace = $config->getNamespaceName();

<<<<<<< HEAD
        $namespace = ltrim($namespace, "\\");

        $className = $config->getShortName();

        $code = str_replace(
            'namespace Mockery;',
            $namespace ? 'namespace ' . $namespace . ';' : '',
            $code
        );

        $code = str_replace(
            'class Mock',
            'class ' . $className,
            $code
        );

        return $code;
=======
        $namespace = ltrim($namespace, '\\');

        $className = $config->getShortName();

        $code = str_replace('namespace Mockery;', $namespace !== '' ? 'namespace ' . $namespace . ';' : '', $code);

        return str_replace('class Mock', 'class ' . $className, $code);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
