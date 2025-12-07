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
=======
use Mockery\Exception;
use Serializable;
use function array_filter;
use function array_keys;
use function array_map;
use function array_merge;
use function array_pop;
use function array_unique;
use function array_values;
use function class_alias;
use function class_exists;
use function explode;
use function get_class;
use function implode;
use function in_array;
use function interface_exists;
use function is_object;
use function md5;
use function preg_match;
use function serialize;
use function strpos;
use function strtolower;
use function trait_exists;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
/**
 * This class describes the configuration of mocks and hides away some of the
 * reflection implementation
 */
class MockConfiguration
{
    /**
<<<<<<< HEAD
     * A class that we'd like to mock
     */
    protected $targetClass;
    protected $targetClassName;

    /**
     * A number of interfaces we'd like to mock, keyed by name to attempt to
     * keep unique
     */
    protected $targetInterfaces = array();
    protected $targetInterfaceNames = array();

    /**
     * A number of traits we'd like to mock, keyed by name to attempt to
     * keep unique
     */
    protected $targetTraits = array();
    protected $targetTraitNames = array();

    /**
     * An object we'd like our mock to proxy to
     */
    protected $targetObject;

    /**
     * The class name we'd like to use for a generated mock
     */
    protected $name;
=======
     * Instance cache of all methods
     *
     * @var list<Method>
     */
    protected $allMethods = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Methods that should specifically not be mocked
     *
<<<<<<< HEAD
     * This is currently populated with stuff we don't know how to deal with,
     * should really be somewhere else
     */
    protected $blackListedMethods = array();

    /**
     * If not empty, only these methods will be mocked
     */
    protected $whiteListedMethods = array();

    /**
     * An instance mock is where we override the original class before it's
     * autoloaded
=======
     * This is currently populated with stuff we don't know how to deal with, should really be somewhere else
     */
    protected $blackListedMethods = [];

    protected $constantsMap = [];

    /**
     * An instance mock is where we override the original class before it's autoloaded
     *
     * @var bool
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    protected $instanceMock = false;

    /**
<<<<<<< HEAD
     * Param overrides
     */
    protected $parameterOverrides = array();

    /**
     * Instance cache of all methods
     */
    protected $allMethods;

    /**
     * If true, overrides original class destructor
     */
    protected $mockOriginalDestructor = false;

    protected $constantsMap = array();

    public function __construct(
        array $targets = array(),
        array $blackListedMethods = array(),
        array $whiteListedMethods = array(),
        $name = null,
        $instanceMock = false,
        array $parameterOverrides = array(),
        $mockOriginalDestructor = false,
        array $constantsMap = array()
=======
     * If true, overrides original class destructor
     *
     * @var bool
     */
    protected $mockOriginalDestructor = false;

    /**
     * The class name we'd like to use for a generated mock
     *
     * @var string|null
     */
    protected $name;

    /**
     * Param overrides
     *
     * @var array<string,mixed>
     */
    protected $parameterOverrides = [];

    /**
     * A class that we'd like to mock
     * @var TargetClassInterface|null
     */
    protected $targetClass;

    /**
     * @var class-string|null
     */
    protected $targetClassName;

    /**
     * @var array<class-string>
     */
    protected $targetInterfaceNames = [];

    /**
     * A number of interfaces we'd like to mock, keyed by name to attempt to keep unique
     *
     * @var array<TargetClassInterface>
     */
    protected $targetInterfaces = [];

    /**
     * An object we'd like our mock to proxy to
     *
     * @var object|null
     */
    protected $targetObject;

    /**
     * @var array<string>
     */
    protected $targetTraitNames = [];

    /**
     * A number of traits we'd like to mock, keyed by name to attempt to keep unique
     *
     * @var array<string,DefinedTargetClass>
     */
    protected $targetTraits = [];

    /**
     * If not empty, only these methods will be mocked
     *
     * @var array<string>
     */
    protected $whiteListedMethods = [];

    /**
     * @param array<class-string|object>         $targets
     * @param array<string>                      $blackListedMethods
     * @param array<string>                      $whiteListedMethods
     * @param string|null                        $name
     * @param bool                               $instanceMock
     * @param array<string,mixed>                $parameterOverrides
     * @param bool                               $mockOriginalDestructor
     * @param array<string,array<scalar>|scalar> $constantsMap
     */
    public function __construct(
        array $targets = [],
        array $blackListedMethods = [],
        array $whiteListedMethods = [],
        $name = null,
        $instanceMock = false,
        array $parameterOverrides = [],
        $mockOriginalDestructor = false,
        array $constantsMap = []
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    ) {
        $this->addTargets($targets);
        $this->blackListedMethods = $blackListedMethods;
        $this->whiteListedMethods = $whiteListedMethods;
        $this->name = $name;
        $this->instanceMock = $instanceMock;
        $this->parameterOverrides = $parameterOverrides;
        $this->mockOriginalDestructor = $mockOriginalDestructor;
        $this->constantsMap = $constantsMap;
    }

    /**
<<<<<<< HEAD
=======
     * Generate a suitable name based on the config
     *
     * @return string
     */
    public function generateName()
    {
        $nameBuilder = new MockNameBuilder();

        $targetObject = $this->getTargetObject();
        if ($targetObject !== null) {
            $className = get_class($targetObject);

            $nameBuilder->addPart(strpos($className, '@') !== false ? md5($className) : $className);
        }

        $targetClass = $this->getTargetClass();
        if ($targetClass instanceof TargetClassInterface) {
            $className = $targetClass->getName();

            $nameBuilder->addPart(strpos($className, '@') !== false ? md5($className) : $className);
        }

        foreach ($this->getTargetInterfaces() as $targetInterface) {
            $nameBuilder->addPart($targetInterface->getName());
        }

        return $nameBuilder->build();
    }

    /**
     * @return array<string>
     */
    public function getBlackListedMethods()
    {
        return $this->blackListedMethods;
    }

    /**
     * @return array<string,scalar|array<scalar>>
     */
    public function getConstantsMap()
    {
        return $this->constantsMap;
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Attempt to create a hash of the configuration, in order to allow caching
     *
     * @TODO workout if this will work
     *
     * @return string
     */
    public function getHash()
    {
<<<<<<< HEAD
        $vars = array(
            'targetClassName'        => $this->targetClassName,
            'targetInterfaceNames'   => $this->targetInterfaceNames,
            'targetTraitNames'       => $this->targetTraitNames,
            'name'                   => $this->name,
            'blackListedMethods'     => $this->blackListedMethods,
            'whiteListedMethod'      => $this->whiteListedMethods,
            'instanceMock'           => $this->instanceMock,
            'parameterOverrides'     => $this->parameterOverrides,
            'mockOriginalDestructor' => $this->mockOriginalDestructor
        );
=======
        $vars = [
            'targetClassName' => $this->targetClassName,
            'targetInterfaceNames' => $this->targetInterfaceNames,
            'targetTraitNames' => $this->targetTraitNames,
            'name' => $this->name,
            'blackListedMethods' => $this->blackListedMethods,
            'whiteListedMethod' => $this->whiteListedMethods,
            'instanceMock' => $this->instanceMock,
            'parameterOverrides' => $this->parameterOverrides,
            'mockOriginalDestructor' => $this->mockOriginalDestructor,
        ];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        return md5(serialize($vars));
    }

    /**
<<<<<<< HEAD
     * Gets a list of methods from the classes, interfaces and objects and
     * filters them appropriately. Lot's of filtering going on, perhaps we could
     * have filter classes to iterate through
=======
     * Gets a list of methods from the classes, interfaces and objects and filters them appropriately.
     * Lot's of filtering going on, perhaps we could have filter classes to iterate through
     *
     * @return list<Method>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function getMethodsToMock()
    {
        $methods = $this->getAllMethods();

        foreach ($methods as $key => $method) {
            if ($method->isFinal()) {
                unset($methods[$key]);
            }
        }

        /**
         * Whitelist trumps everything else
         */
<<<<<<< HEAD
        if (count($this->getWhiteListedMethods())) {
            $whitelist = array_map('strtolower', $this->getWhiteListedMethods());
            $methods = array_filter($methods, function ($method) use ($whitelist) {
                return $method->isAbstract() || in_array(strtolower($method->getName()), $whitelist);
            });

            return $methods;
=======
        $whiteListedMethods = $this->getWhiteListedMethods();
        if ($whiteListedMethods !== []) {
            $whitelist = array_map('strtolower', $whiteListedMethods);

            return array_filter($methods, static function ($method) use ($whitelist) {
                if ($method->isAbstract()) {
                    return true;
                }

                return in_array(strtolower($method->getName()), $whitelist, true);
            });
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        /**
         * Remove blacklisted methods
         */
<<<<<<< HEAD
        if (count($this->getBlackListedMethods())) {
            $blacklist = array_map('strtolower', $this->getBlackListedMethods());
            $methods = array_filter($methods, function ($method) use ($blacklist) {
                return !in_array(strtolower($method->getName()), $blacklist);
=======
        $blackListedMethods = $this->getBlackListedMethods();
        if ($blackListedMethods !== []) {
            $blacklist = array_map('strtolower', $blackListedMethods);

            $methods = array_filter($methods, static function ($method) use ($blacklist) {
                return ! in_array(strtolower($method->getName()), $blacklist, true);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            });
        }

        /**
         * Internal objects can not be instantiated with newInstanceArgs and if
         * they implement Serializable, unserialize will have to be called. As
         * such, we can't mock it and will need a pass to add a dummy
         * implementation
         */
<<<<<<< HEAD
        if ($this->getTargetClass()
            && $this->getTargetClass()->implementsInterface("Serializable")
            && $this->getTargetClass()->hasInternalAncestor()) {
            $methods = array_filter($methods, function ($method) {
                return $method->getName() !== "unserialize";
=======
        $targetClass = $this->getTargetClass();

        if (
            $targetClass !== null
            && $targetClass->implementsInterface(Serializable::class)
            && $targetClass->hasInternalAncestor()
        ) {
            $methods = array_filter($methods, static function ($method) {
                return $method->getName() !== 'unserialize';
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            });
        }

        return array_values($methods);
    }

    /**
<<<<<<< HEAD
     * We declare the __call method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     */
    public function requiresCallTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ("__call" === $method->getName()) {
                $params = $method->getParameters();
                return !$params[1]->isArray();
            }
        }

        return false;
    }

    /**
     * We declare the __callStatic method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     */
    public function requiresCallStaticTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ("__callStatic" === $method->getName()) {
                $params = $method->getParameters();
                return !$params[1]->isArray();
            }
        }

        return false;
    }

    public function rename($className)
    {
        $targets = array();
=======
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getNamespaceName()
    {
        $parts = explode('\\', $this->getName());
        array_pop($parts);

        if ($parts !== []) {
            return implode('\\', $parts);
        }

        return '';
    }

    /**
     * @return array<string,mixed>
     */
    public function getParameterOverrides()
    {
        return $this->parameterOverrides;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        $parts = explode('\\', $this->getName());
        return array_pop($parts);
    }

    /**
     * @return null|TargetClassInterface
     */
    public function getTargetClass()
    {
        if ($this->targetClass) {
            return $this->targetClass;
        }

        if (! $this->targetClassName) {
            return null;
        }

        if (class_exists($this->targetClassName)) {
            $alias = null;
            if (strpos($this->targetClassName, '@') !== false) {
                $alias = (new MockNameBuilder())
                    ->addPart('anonymous_class')
                    ->addPart(md5($this->targetClassName))
                    ->build();
                class_alias($this->targetClassName, $alias);
            }

            $dtc = DefinedTargetClass::factory($this->targetClassName, $alias);

            if ($this->getTargetObject() === null && $dtc->isFinal()) {
                throw new Exception(
                    'The class ' . $this->targetClassName . ' is marked final and its methods'
                    . ' cannot be replaced. Classes marked final can be passed in'
                    . ' to \Mockery::mock() as instantiated objects to create a'
                    . ' partial mock, but only if the mock is not subject to type'
                    . ' hinting checks.'
                );
            }

            $this->targetClass = $dtc;
        } else {
            $this->targetClass = UndefinedTargetClass::factory($this->targetClassName);
        }

        return $this->targetClass;
    }

    /**
     * @return class-string|null
     */
    public function getTargetClassName()
    {
        return $this->targetClassName;
    }

    /**
     * @return list<TargetClassInterface>
     */
    public function getTargetInterfaces()
    {
        if ($this->targetInterfaces !== []) {
            return $this->targetInterfaces;
        }

        foreach ($this->targetInterfaceNames as $targetInterface) {
            if (! interface_exists($targetInterface)) {
                $this->targetInterfaces[] = UndefinedTargetClass::factory($targetInterface);
                continue;
            }

            $dtc = DefinedTargetClass::factory($targetInterface);
            $extendedInterfaces = array_keys($dtc->getInterfaces());
            $extendedInterfaces[] = $targetInterface;

            $traversableFound = false;
            $iteratorShiftedToFront = false;
            foreach ($extendedInterfaces as $interface) {
                if (! $traversableFound && preg_match('/^\\?Iterator(|Aggregate)$/i', $interface)) {
                    break;
                }

                if (preg_match('/^\\\\?IteratorAggregate$/i', $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory('\\IteratorAggregate');
                    $iteratorShiftedToFront = true;

                    continue;
                }

                if (preg_match('/^\\\\?Iterator$/i', $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory('\\Iterator');
                    $iteratorShiftedToFront = true;

                    continue;
                }

                if (preg_match('/^\\\\?Traversable$/i', $interface)) {
                    $traversableFound = true;
                }
            }

            if ($traversableFound && ! $iteratorShiftedToFront) {
                $this->targetInterfaces[] = DefinedTargetClass::factory('\\IteratorAggregate');
            }

            /**
             * We never straight up implement Traversable
             */
            $isTraversable = preg_match('/^\\\\?Traversable$/i', $targetInterface);
            if ($isTraversable === 0 || $isTraversable === false) {
                $this->targetInterfaces[] = $dtc;
            }
        }

        return $this->targetInterfaces = array_unique($this->targetInterfaces);
    }

    /**
     * @return object|null
     */
    public function getTargetObject()
    {
        return $this->targetObject;
    }

    /**
     * @return list<TargetClassInterface>
     */
    public function getTargetTraits()
    {
        if ($this->targetTraits !== []) {
            return $this->targetTraits;
        }

        foreach ($this->targetTraitNames as $targetTrait) {
            $this->targetTraits[] = DefinedTargetClass::factory($targetTrait);
        }

        $this->targetTraits = array_unique($this->targetTraits); // just in case
        return $this->targetTraits;
    }

    /**
     * @return array<string>
     */
    public function getWhiteListedMethods()
    {
        return $this->whiteListedMethods;
    }

    /**
     * @return bool
     */
    public function isInstanceMock()
    {
        return $this->instanceMock;
    }

    /**
     * @return bool
     */
    public function isMockOriginalDestructor()
    {
        return $this->mockOriginalDestructor;
    }

    /**
     * @param  class-string $className
     * @return self
     */
    public function rename($className)
    {
        $targets = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        if ($this->targetClassName) {
            $targets[] = $this->targetClassName;
        }

        if ($this->targetInterfaceNames) {
            $targets = array_merge($targets, $this->targetInterfaceNames);
        }

        if ($this->targetTraitNames) {
            $targets = array_merge($targets, $this->targetTraitNames);
        }

        if ($this->targetObject) {
            $targets[] = $this->targetObject;
        }

        return new self(
            $targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $className,
            $this->instanceMock,
            $this->parameterOverrides,
            $this->mockOriginalDestructor,
            $this->constantsMap
        );
    }

<<<<<<< HEAD
=======
    /**
     * We declare the __callStatic method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     *
     * @return bool
     */
    public function requiresCallStaticTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ($method->getName() === '__callStatic') {
                $params = $method->getParameters();

                if (! array_key_exists(1, $params)) {
                    return false;
                }

                return ! $params[1]->isArray();
            }
        }

        return false;
    }

    /**
     * We declare the __call method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     *
     * @return bool
     */
    public function requiresCallTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ($method->getName() === '__call') {
                $params = $method->getParameters();
                return ! $params[1]->isArray();
            }
        }

        return false;
    }

    /**
     * @param class-string|object $target
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    protected function addTarget($target)
    {
        if (is_object($target)) {
            $this->setTargetObject($target);
            $this->setTargetClassName(get_class($target));
<<<<<<< HEAD
            return $this;
        }

        if ($target[0] !== "\\") {
            $target = "\\" . $target;
=======
            return;
        }

        if ($target[0] !== '\\') {
            $target = '\\' . $target;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        if (class_exists($target)) {
            $this->setTargetClassName($target);
<<<<<<< HEAD
            return $this;
=======
            return;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        if (interface_exists($target)) {
            $this->addTargetInterfaceName($target);
<<<<<<< HEAD
            return $this;
=======
            return;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        if (trait_exists($target)) {
            $this->addTargetTraitName($target);
<<<<<<< HEAD
            return $this;
=======
            return;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        /**
         * Default is to set as class, or interface if class already set
         *
         * Don't like this condition, can't remember what the default
         * targetClass is for
         */
        if ($this->getTargetClassName()) {
            $this->addTargetInterfaceName($target);
<<<<<<< HEAD
            return $this;
=======
            return;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        $this->setTargetClassName($target);
    }

<<<<<<< HEAD
=======
    /**
     * If we attempt to implement Traversable,
     * we must ensure we are also implementing either Iterator or IteratorAggregate,
     * and that whichever one it is comes before Traversable in the list of implements.
     *
     * @param class-string $targetInterface
     */
    protected function addTargetInterfaceName($targetInterface)
    {
        $this->targetInterfaceNames[] = $targetInterface;
    }

    /**
     * @param array<class-string> $interfaces
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    protected function addTargets($interfaces)
    {
        foreach ($interfaces as $interface) {
            $this->addTarget($interface);
        }
    }

<<<<<<< HEAD
    public function getTargetClassName()
    {
        return $this->targetClassName;
    }

    public function getTargetClass()
    {
        if ($this->targetClass) {
            return $this->targetClass;
        }

        if (!$this->targetClassName) {
            return null;
        }

        if (class_exists($this->targetClassName)) {
            $alias = null;
            if (strpos($this->targetClassName, '@') !== false) {
                $alias = (new MockNameBuilder())
                    ->addPart('anonymous_class')
                    ->addPart(md5($this->targetClassName))
                    ->build();
                class_alias($this->targetClassName, $alias);
            }
            $dtc = DefinedTargetClass::factory($this->targetClassName, $alias);

            if ($this->getTargetObject() == false && $dtc->isFinal()) {
                throw new \Mockery\Exception(
                    'The class ' . $this->targetClassName . ' is marked final and its methods'
                    . ' cannot be replaced. Classes marked final can be passed in'
                    . ' to \Mockery::mock() as instantiated objects to create a'
                    . ' partial mock, but only if the mock is not subject to type'
                    . ' hinting checks.'
                );
            }

            $this->targetClass = $dtc;
        } else {
            $this->targetClass = UndefinedTargetClass::factory($this->targetClassName);
        }

        return $this->targetClass;
    }

    public function getTargetTraits()
    {
        if (!empty($this->targetTraits)) {
            return $this->targetTraits;
        }

        foreach ($this->targetTraitNames as $targetTrait) {
            $this->targetTraits[] = DefinedTargetClass::factory($targetTrait);
        }

        $this->targetTraits = array_unique($this->targetTraits); // just in case
        return $this->targetTraits;
    }

    public function getTargetInterfaces()
    {
        if (!empty($this->targetInterfaces)) {
            return $this->targetInterfaces;
        }

        foreach ($this->targetInterfaceNames as $targetInterface) {
            if (!interface_exists($targetInterface)) {
                $this->targetInterfaces[] = UndefinedTargetClass::factory($targetInterface);
                continue;
            }

            $dtc = DefinedTargetClass::factory($targetInterface);
            $extendedInterfaces = array_keys($dtc->getInterfaces());
            $extendedInterfaces[] = $targetInterface;

            $traversableFound = false;
            $iteratorShiftedToFront = false;
            foreach ($extendedInterfaces as $interface) {
                if (!$traversableFound && preg_match("/^\\?Iterator(|Aggregate)$/i", $interface)) {
                    break;
                }

                if (preg_match("/^\\\\?IteratorAggregate$/i", $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory("\\IteratorAggregate");
                    $iteratorShiftedToFront = true;
                } elseif (preg_match("/^\\\\?Iterator$/i", $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory("\\Iterator");
                    $iteratorShiftedToFront = true;
                } elseif (preg_match("/^\\\\?Traversable$/i", $interface)) {
                    $traversableFound = true;
                }
            }

            if ($traversableFound && !$iteratorShiftedToFront) {
                $this->targetInterfaces[] = DefinedTargetClass::factory("\\IteratorAggregate");
            }

            /**
             * We never straight up implement Traversable
             */
            if (!preg_match("/^\\\\?Traversable$/i", $targetInterface)) {
                $this->targetInterfaces[] = $dtc;
            }
        }
        $this->targetInterfaces = array_unique($this->targetInterfaces); // just in case
        return $this->targetInterfaces;
    }

    public function getTargetObject()
    {
        return $this->targetObject;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Generate a suitable name based on the config
     */
    public function generateName()
    {
        $nameBuilder = new MockNameBuilder();

        if ($this->getTargetObject()) {
            $className = get_class($this->getTargetObject());
            $nameBuilder->addPart(strpos($className, '@') !== false ? md5($className) : $className);
        }

        if ($this->getTargetClass()) {
            $className = $this->getTargetClass()->getName();
            $nameBuilder->addPart(strpos($className, '@') !== false ? md5($className) : $className);
        }

        foreach ($this->getTargetInterfaces() as $targetInterface) {
            $nameBuilder->addPart($targetInterface->getName());
        }

        return $nameBuilder->build();
    }

    public function getShortName()
    {
        $parts = explode("\\", $this->getName());
        return array_pop($parts);
    }

    public function getNamespaceName()
    {
        $parts = explode("\\", $this->getName());
        array_pop($parts);

        if (count($parts)) {
            return implode("\\", $parts);
        }

        return "";
    }

    public function getBlackListedMethods()
    {
        return $this->blackListedMethods;
    }

    public function getWhiteListedMethods()
    {
        return $this->whiteListedMethods;
    }

    public function isInstanceMock()
    {
        return $this->instanceMock;
    }

    public function getParameterOverrides()
    {
        return $this->parameterOverrides;
    }

    public function isMockOriginalDestructor()
    {
        return $this->mockOriginalDestructor;
    }

    protected function setTargetClassName($targetClassName)
    {
        $this->targetClassName = $targetClassName;
    }

=======
    /**
     * @param class-string $targetTraitName
     */
    protected function addTargetTraitName($targetTraitName)
    {
        $this->targetTraitNames[] = $targetTraitName;
    }

    /**
     * @return list<Method>
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    protected function getAllMethods()
    {
        if ($this->allMethods) {
            return $this->allMethods;
        }

        $classes = $this->getTargetInterfaces();

        if ($this->getTargetClass()) {
            $classes[] = $this->getTargetClass();
        }

<<<<<<< HEAD
        $methods = array();
=======
        $methods = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        foreach ($classes as $class) {
            $methods = array_merge($methods, $class->getMethods());
        }

        foreach ($this->getTargetTraits() as $trait) {
            foreach ($trait->getMethods() as $method) {
                if ($method->isAbstract()) {
                    $methods[] = $method;
                }
            }
        }

<<<<<<< HEAD
        $names = array();
        $methods = array_filter($methods, function ($method) use (&$names) {
            if (in_array($method->getName(), $names)) {
=======
        $names = [];
        $methods = array_filter($methods, static function ($method) use (&$names) {
            if (in_array($method->getName(), $names, true)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                return false;
            }

            $names[] = $method->getName();
            return true;
        });

<<<<<<< HEAD
        // In HHVM, class methods can be annotated with the built-in
        // <<__Memoize>> attribute (similar to a Python decorator),
        // which builds an LRU cache of method arguments and their
        // return values.
        // https://docs.hhvm.com/hack/attributes/special#__memoize
        //
        // HHVM implements this behavior by inserting a private helper
        // method into the class at runtime which is named as the
        // method to be memoized, suffixed by `$memoize_impl`.
        // https://github.com/facebook/hhvm/blob/6aa46f1e8c2351b97d65e67b73e26f274a7c3f2e/hphp/runtime/vm/func.cpp#L364
        //
        // Ordinarily, PHP does not all allow the `$` token in method
        // names, but since the memoization helper is inserted at
        // runtime (and not in userland), HHVM allows it.
        //
        // We use code generation and eval() for some types of mocks,
        // so to avoid syntax errors from these memoization helpers,
        // we must filter them from our list of class methods.
        //
        // This effectively disables the memoization behavior in HHVM,
        // but that's preferable to failing catastrophically when
        // attempting to mock a class using the attribute.
        if (defined('HHVM_VERSION')) {
            $methods = array_filter($methods, function ($method) {
                return strpos($method->getName(), '$memoize_impl') === false;
            });
        }

=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->allMethods = $methods;
    }

    /**
<<<<<<< HEAD
     * If we attempt to implement Traversable, we must ensure we are also
     * implementing either Iterator or IteratorAggregate, and that whichever one
     * it is comes before Traversable in the list of implements.
     */
    protected function addTargetInterfaceName($targetInterface)
    {
        $this->targetInterfaceNames[] = $targetInterface;
    }

    protected function addTargetTraitName($targetTraitName)
    {
        $this->targetTraitNames[] = $targetTraitName;
    }

=======
     * @param class-string $targetClassName
     */
    protected function setTargetClassName($targetClassName)
    {
        $this->targetClassName = $targetClassName;
    }

    /**
     * @param object $object
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    protected function setTargetObject($object)
    {
        $this->targetObject = $object;
    }
<<<<<<< HEAD

    public function getConstantsMap()
    {
        return $this->constantsMap;
    }
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
