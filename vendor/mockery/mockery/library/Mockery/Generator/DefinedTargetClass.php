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

namespace Mockery\Generator;

<<<<<<< HEAD
class DefinedTargetClass implements TargetClassInterface
{
    private $rfc;
    private $name;

    public function __construct(\ReflectionClass $rfc, $alias = null)
    {
        $this->rfc = $rfc;
        $this->name = $alias === null ? $rfc->getName() : $alias;
    }

    public static function factory($name, $alias = null)
    {
        return new self(new \ReflectionClass($name), $alias);
    }

=======
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;

use function array_map;
use function array_merge;
use function array_unique;

use const PHP_VERSION_ID;

class DefinedTargetClass implements TargetClassInterface
{
    /**
     * @var class-string
     */
    private $name;

    /**
     * @var ReflectionClass
     */
    private $rfc;

    /**
     * @param ReflectionClass   $rfc
     * @param class-string|null $alias
     */
    public function __construct(ReflectionClass $rfc, $alias = null)
    {
        $this->rfc = $rfc;
        $this->name = $alias ?? $rfc->getName();
    }

    /**
     * @return class-string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param  class-string      $name
     * @param  class-string|null $alias
     * @return self
     */
    public static function factory($name, $alias = null)
    {
        return new self(new ReflectionClass($name), $alias);
    }

    /**
     * @return list<class-string>
     */
    public function getAttributes()
    {
        if (PHP_VERSION_ID < 80000) {
            return [];
        }

        return array_unique(
            array_merge(
                ['\AllowDynamicProperties'],
                array_map(
                    static function (ReflectionAttribute $attribute): string {
                        return '\\' . $attribute->getName();
                    },
                    $this->rfc->getAttributes()
                )
            )
        );
    }

    /**
     * @return array<class-string,self>
     */
    public function getInterfaces()
    {
        return array_map(
            static function (ReflectionClass $interface): self {
                return new self($interface);
            },
            $this->rfc->getInterfaces()
        );
    }

    /**
     * @return list<Method>
     */
    public function getMethods()
    {
        return array_map(
            static function (ReflectionMethod $method): Method {
                return new Method($method);
            },
            $this->rfc->getMethods()
        );
    }

    /**
     * @return class-string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getName()
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function isAbstract()
    {
        return $this->rfc->isAbstract();
    }

    public function isFinal()
    {
        return $this->rfc->isFinal();
    }

    public function getMethods()
    {
        return array_map(function ($method) {
            return new Method($method);
        }, $this->rfc->getMethods());
    }

    public function getInterfaces()
    {
        $class = __CLASS__;
        return array_map(function ($interface) use ($class) {
            return new $class($interface);
        }, $this->rfc->getInterfaces());
    }

    public function __toString()
    {
        return $this->getName();
    }

=======
    /**
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getNamespaceName()
    {
        return $this->rfc->getNamespaceName();
    }

<<<<<<< HEAD
    public function inNamespace()
    {
        return $this->rfc->inNamespace();
    }

=======
    /**
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getShortName()
    {
        return $this->rfc->getShortName();
    }

<<<<<<< HEAD
    public function implementsInterface($interface)
    {
        return $this->rfc->implementsInterface($interface);
    }

=======
    /**
     * @return bool
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function hasInternalAncestor()
    {
        if ($this->rfc->isInternal()) {
            return true;
        }

        $child = $this->rfc;
        while ($parent = $child->getParentClass()) {
            if ($parent->isInternal()) {
                return true;
            }
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $child = $parent;
        }

        return false;
    }
<<<<<<< HEAD
=======

    /**
     * @param  class-string $interface
     * @return bool
     */
    public function implementsInterface($interface)
    {
        return $this->rfc->implementsInterface($interface);
    }

    /**
     * @return bool
     */
    public function inNamespace()
    {
        return $this->rfc->inNamespace();
    }

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return $this->rfc->isAbstract();
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return $this->rfc->isFinal();
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
