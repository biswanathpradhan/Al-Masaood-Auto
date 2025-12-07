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
=======
use function strrpos;
use function substr;
use const PHP_VERSION_ID;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

/**
 * Internal classes can not be instantiated with the newInstanceWithoutArgs
 * reflection method, so need the serialization hack. If the class also
 * implements Serializable, we need to replace the standard unserialize method
 * definition with a dummy
 */
<<<<<<< HEAD
class RemoveUnserializeForInternalSerializableClassesPass
{
    const DUMMY_METHOD_DEFINITION_LEGACY = 'public function unserialize($string) {} ';
    const DUMMY_METHOD_DEFINITION = 'public function unserialize(string $data): void {} ';

=======
class RemoveUnserializeForInternalSerializableClassesPass implements Pass
{
    public const DUMMY_METHOD_DEFINITION = 'public function unserialize(string $data): void {} ';

    public const DUMMY_METHOD_DEFINITION_LEGACY = 'public function unserialize($string) {} ';

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

        if (!$target->hasInternalAncestor() || !$target->implementsInterface("Serializable")) {
            return $code;
        }

        $code = $this->appendToClass($code, \PHP_VERSION_ID < 80100 ? self::DUMMY_METHOD_DEFINITION_LEGACY : self::DUMMY_METHOD_DEFINITION);

        return $code;
=======
        if (! $target) {
            return $code;
        }

        if (! $target->hasInternalAncestor() || ! $target->implementsInterface('Serializable')) {
            return $code;
        }

        return $this->appendToClass(
            $code,
            PHP_VERSION_ID < 80100 ? self::DUMMY_METHOD_DEFINITION_LEGACY : self::DUMMY_METHOD_DEFINITION
        );
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    protected function appendToClass($class, $code)
    {
<<<<<<< HEAD
        $lastBrace = strrpos($class, "}");
        $class = substr($class, 0, $lastBrace) . $code . "\n    }\n";
        return $class;
=======
        $lastBrace = strrpos($class, '}');
        return substr($class, 0, $lastBrace) . $code . "\n    }\n";
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
