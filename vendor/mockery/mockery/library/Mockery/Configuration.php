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

namespace Mockery;

<<<<<<< HEAD
class Configuration
{
    /**
     * Boolean assertion of whether we can mock methods which do not actually
     * exist for the given class or object (ignored for unreal mocks)
     *
     * @var bool
     */
    protected $_allowMockingNonExistentMethod = true;

    /**
=======
use Closure;
use Hamcrest\Matcher;
use Hamcrest_Matcher;
use InvalidArgumentException;
use LogicException;
use Mockery\Matcher\MatcherInterface;

use function array_key_exists;
use function array_merge;
use function class_implements;
use function get_parent_class;
use function is_a;
use function sprintf;
use function strtolower;
use function trigger_error;

use const E_USER_DEPRECATED;
use const PHP_MAJOR_VERSION;

class Configuration
{
    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Boolean assertion of whether we ignore unnecessary mocking of methods,
     * i.e. when method expectations are made, set using a zeroOrMoreTimes()
     * constraint, and then never called. Essentially such expectations are
     * not required and are just taking up test space.
     *
     * @var bool
     */
    protected $_allowMockingMethodsUnnecessarily = true;

    /**
<<<<<<< HEAD
     * Parameter map for use with PHP internal classes.
     *
     * @var array
     */
    protected $_internalClassParamMap = array();

    protected $_constantsMap = array();
=======
     * Boolean assertion of whether we can mock methods which do not actually
     * exist for the given class or object (ignored for unreal mocks)
     *
     * @var bool
     */
    protected $_allowMockingNonExistentMethod = true;

    /**
     * Constants map
     *
     * e.g. ['class' => ['MY_CONST' => 123, 'OTHER_CONST' => 'foo']]
     *
     * @var array<class-string,array<string,array<scalar>|scalar>>
     */
    protected $_constantsMap = [];

    /**
     * Default argument matchers
     *
     * e.g. ['class' => 'matcher']
     *
     * @var array<class-string,class-string>
     */
    protected $_defaultMatchers = [];

    /**
     * Parameter map for use with PHP internal classes.
     *
     *  e.g. ['class' => ['method' => ['param1', 'param2']]]
     *
     * @var array<class-string,array<string,list<string>>>
     */
    protected $_internalClassParamMap = [];

    /**
     * Custom object formatters
     *
     * e.g. ['class' => static fn($object) => 'formatted']
     *
     * @var array<class-string,Closure>
     */
    protected $_objectFormatters = [];

    /**
     * @var QuickDefinitionsConfiguration
     */
    protected $_quickDefinitionsConfiguration;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Boolean assertion is reflection caching enabled or not. It should be
     * always enabled, except when using PHPUnit's --static-backup option.
     *
     * @see https://github.com/mockery/mockery/issues/268
     */
    protected $_reflectionCacheEnabled = true;

<<<<<<< HEAD
    /**
     * Set boolean to allow/prevent mocking of non-existent methods
     *
     * @param bool $flag
     */
    public function allowMockingNonExistentMethods($flag = true)
    {
        $this->_allowMockingNonExistentMethod = (bool) $flag;
    }

    /**
     * Return flag indicating whether mocking non-existent methods allowed
     *
     * @return bool
     */
    public function mockingNonExistentMethodsAllowed()
    {
        return $this->_allowMockingNonExistentMethod;
    }

    /**
     * @deprecated
     *
     * Set boolean to allow/prevent unnecessary mocking of methods
     *
     * @param bool $flag
     */
    public function allowMockingMethodsUnnecessarily($flag = true)
    {
        trigger_error(sprintf("The %s method is deprecated and will be removed in a future version of Mockery", __METHOD__), E_USER_DEPRECATED);
=======
    public function __construct()
    {
        $this->_quickDefinitionsConfiguration = new QuickDefinitionsConfiguration();
    }

    /**
     * Set boolean to allow/prevent unnecessary mocking of methods
     *
     * @param bool $flag
     *
     * @return void
     *
     * @deprecated since 1.4.0
     */
    public function allowMockingMethodsUnnecessarily($flag = true)
    {
        @trigger_error(
            sprintf('The %s method is deprecated and will be removed in a future version of Mockery', __METHOD__),
            E_USER_DEPRECATED
        );
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        $this->_allowMockingMethodsUnnecessarily = (bool) $flag;
    }

    /**
<<<<<<< HEAD
     * Return flag indicating whether mocking non-existent methods allowed
     *
     * @return bool
     */
    public function mockingMethodsUnnecessarilyAllowed()
    {
        trigger_error(sprintf("The %s method is deprecated and will be removed in a future version of Mockery", __METHOD__), E_USER_DEPRECATED);

        return $this->_allowMockingMethodsUnnecessarily;
    }

    /**
     * Set a parameter map (array of param signature strings) for the method
     * of an internal PHP class.
     *
     * @param string $class
     * @param string $method
     * @param array $map
     */
    public function setInternalClassMethodParamMap($class, $method, array $map)
    {
        if (\PHP_MAJOR_VERSION > 7) {
            throw new \LogicException('Internal class parameter overriding is not available in PHP 8. Incompatible signatures have been reclassified as fatal errors.');
        }

        if (!isset($this->_internalClassParamMap[strtolower($class)])) {
            $this->_internalClassParamMap[strtolower($class)] = array();
        }
        $this->_internalClassParamMap[strtolower($class)][strtolower($method)] = $map;
    }

    /**
     * Remove all overridden parameter maps from internal PHP classes.
     */
    public function resetInternalClassMethodParamMaps()
    {
        $this->_internalClassParamMap = array();
    }

    /**
     * Get the parameter map of an internal PHP class method
     *
     * @return array|null
     */
    public function getInternalClassMethodParamMap($class, $method)
    {
        if (isset($this->_internalClassParamMap[strtolower($class)][strtolower($method)])) {
            return $this->_internalClassParamMap[strtolower($class)][strtolower($method)];
        }
    }

    public function getInternalClassMethodParamMaps()
    {
        return $this->_internalClassParamMap;
    }

    public function setConstantsMap(array $map)
    {
        $this->_constantsMap = $map;
    }

    public function getConstantsMap()
    {
        return $this->_constantsMap;
=======
     * Set boolean to allow/prevent mocking of non-existent methods
     *
     * @param bool $flag
     *
     * @return void
     */
    public function allowMockingNonExistentMethods($flag = true)
    {
        $this->_allowMockingNonExistentMethod = (bool) $flag;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Disable reflection caching
     *
     * It should be always enabled, except when using
     * PHPUnit's --static-backup option.
     *
     * @see https://github.com/mockery/mockery/issues/268
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function disableReflectionCache()
    {
        $this->_reflectionCacheEnabled = false;
    }

    /**
     * Enable reflection caching
     *
     * It should be always enabled, except when using
     * PHPUnit's --static-backup option.
     *
     * @see https://github.com/mockery/mockery/issues/268
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function enableReflectionCache()
    {
        $this->_reflectionCacheEnabled = true;
    }

    /**
<<<<<<< HEAD
     * Is reflection cache enabled?
=======
     * Get the map of constants to be used in the mock generator
     *
     * @return array<class-string,array<string,array<scalar>|scalar>>
     */
    public function getConstantsMap()
    {
        return $this->_constantsMap;
    }

    /**
     * Get the default matcher for a given class
     *
     * @param class-string $class
     *
     * @return null|class-string
     */
    public function getDefaultMatcher($class)
    {
        $classes = [];

        $parentClass = $class;

        do {
            $classes[] = $parentClass;

            $parentClass = get_parent_class($parentClass);
        } while ($parentClass !== false);

        $classesAndInterfaces = array_merge($classes, class_implements($class));

        foreach ($classesAndInterfaces as $type) {
            if (array_key_exists($type, $this->_defaultMatchers)) {
                return $this->_defaultMatchers[$type];
            }
        }

        return null;
    }

    /**
     * Get the parameter map of an internal PHP class method
     *
     * @param class-string $class
     * @param string       $method
     *
     * @return null|array
     */
    public function getInternalClassMethodParamMap($class, $method)
    {
        $class = strtolower($class);
        $method = strtolower($method);
        if (! array_key_exists($class, $this->_internalClassParamMap)) {
            return null;
        }

        if (! array_key_exists($method, $this->_internalClassParamMap[$class])) {
            return null;
        }

        return $this->_internalClassParamMap[$class][$method];
    }

    /**
     * Get the parameter maps of internal PHP classes
     *
     * @return array<class-string,array<string,list<string>>>
     */
    public function getInternalClassMethodParamMaps()
    {
        return $this->_internalClassParamMap;
    }

    /**
     * Get the object formatter for a class
     *
     * @param class-string $class
     * @param Closure      $defaultFormatter
     *
     * @return Closure
     */
    public function getObjectFormatter($class, $defaultFormatter)
    {
        $parentClass = $class;

        do {
            $classes[] = $parentClass;

            $parentClass = get_parent_class($parentClass);
        } while ($parentClass !== false);

        $classesAndInterfaces = array_merge($classes, class_implements($class));

        foreach ($classesAndInterfaces as $type) {
            if (array_key_exists($type, $this->_objectFormatters)) {
                return $this->_objectFormatters[$type];
            }
        }

        return $defaultFormatter;
    }

    /**
     * Returns the quick definitions configuration
     */
    public function getQuickDefinitions(): QuickDefinitionsConfiguration
    {
        return $this->_quickDefinitionsConfiguration;
    }

    /**
     * Return flag indicating whether mocking non-existent methods allowed
     *
     * @return bool
     *
     * @deprecated since 1.4.0
     */
    public function mockingMethodsUnnecessarilyAllowed()
    {
        @trigger_error(
            sprintf('The %s method is deprecated and will be removed in a future version of Mockery', __METHOD__),
            E_USER_DEPRECATED
        );

        return $this->_allowMockingMethodsUnnecessarily;
    }

    /**
     * Return flag indicating whether mocking non-existent methods allowed
     *
     * @return bool
     */
    public function mockingNonExistentMethodsAllowed()
    {
        return $this->_allowMockingNonExistentMethod;
    }

    /**
     * Is reflection cache enabled?
     *
     * @return bool
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function reflectionCacheEnabled()
    {
        return $this->_reflectionCacheEnabled;
    }
<<<<<<< HEAD
=======

    /**
     * Remove all overridden parameter maps from internal PHP classes.
     *
     * @return void
     */
    public function resetInternalClassMethodParamMaps()
    {
        $this->_internalClassParamMap = [];
    }

    /**
     * Set a map of constants to be used in the mock generator
     *
     * e.g. ['MyClass' => ['MY_CONST' => 123, 'ARRAY_CONST' => ['foo', 'bar']]]
     *
     * @param array<class-string,array<string,array<scalar>|scalar>> $map
     *
     * @return void
     */
    public function setConstantsMap(array $map)
    {
        $this->_constantsMap = $map;
    }

    /**
     * @param class-string $class
     * @param class-string $matcherClass
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setDefaultMatcher($class, $matcherClass)
    {
        $isHamcrest = is_a($matcherClass, Matcher::class, true)
            || is_a($matcherClass, Hamcrest_Matcher::class, true);

        if ($isHamcrest) {
            @trigger_error('Hamcrest package has been deprecated and will be removed in 2.0', E_USER_DEPRECATED);
        }

        if (! $isHamcrest && ! is_a($matcherClass, MatcherInterface::class, true)) {
            throw new InvalidArgumentException(sprintf(
                "Matcher class must implement %s, '%s' given.",
                MatcherInterface::class,
                $matcherClass
            ));
        }

        $this->_defaultMatchers[$class] = $matcherClass;
    }

    /**
     * Set a parameter map (array of param signature strings) for the method of an internal PHP class.
     *
     * @param class-string $class
     * @param string       $method
     * @param list<string> $map
     *
     * @throws LogicException
     *
     * @return void
     */
    public function setInternalClassMethodParamMap($class, $method, array $map)
    {
        if (PHP_MAJOR_VERSION > 7) {
            throw new LogicException(
                'Internal class parameter overriding is not available in PHP 8. Incompatible signatures have been reclassified as fatal errors.'
            );
        }

        $class = strtolower($class);

        if (! array_key_exists($class, $this->_internalClassParamMap)) {
            $this->_internalClassParamMap[$class] = [];
        }

        $this->_internalClassParamMap[$class][strtolower($method)] = $map;
    }

    /**
     * Set a custom object formatter for a class
     *
     * @param class-string $class
     * @param Closure      $formatterCallback
     *
     * @return void
     */
    public function setObjectFormatter($class, $formatterCallback)
    {
        $this->_objectFormatters[$class] = $formatterCallback;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
