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
class MockConfigurationBuilder
{
    protected $name;
    protected $blackListedMethods = array(
=======
use function array_diff;

class MockConfigurationBuilder
{
    /**
     * @var list<string>
     */
    protected $blackListedMethods = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        '__call',
        '__callStatic',
        '__clone',
        '__wakeup',
        '__set',
        '__get',
        '__toString',
        '__isset',
        '__destruct',
        '__debugInfo', ## mocking this makes it difficult to debug with xdebug

        // below are reserved words in PHP
<<<<<<< HEAD
        "__halt_compiler", "abstract", "and", "array", "as",
        "break", "callable", "case", "catch", "class",
        "clone", "const", "continue", "declare", "default",
        "die", "do", "echo", "else", "elseif",
        "empty", "enddeclare", "endfor", "endforeach", "endif",
        "endswitch", "endwhile", "eval", "exit", "extends",
        "final", "for", "foreach", "function", "global",
        "goto", "if", "implements", "include", "include_once",
        "instanceof", "insteadof", "interface", "isset", "list",
        "namespace", "new", "or", "print", "private",
        "protected", "public", "require", "require_once", "return",
        "static", "switch", "throw", "trait", "try",
        "unset", "use", "var", "while", "xor"
    );

    protected $php7SemiReservedKeywords = [
        "callable", "class", "trait", "extends", "implements", "static", "abstract", "final",
        "public", "protected", "private", "const", "enddeclare", "endfor", "endforeach", "endif",
        "endwhile", "and", "global", "goto", "instanceof", "insteadof", "interface", "namespace", "new",
        "or", "xor", "try", "use", "var", "exit", "list", "clone", "include", "include_once", "throw",
        "array", "print", "echo", "require", "require_once", "return", "else", "elseif", "default",
        "break", "continue", "switch", "yield", "function", "if", "endswitch", "finally", "for", "foreach",
        "declare", "case", "do", "while", "as", "catch", "die", "self", "parent",
    ];

    protected $whiteListedMethods = array();
    protected $instanceMock = false;
    protected $parameterOverrides = array();

    protected $mockOriginalDestructor = false;
    protected $targets = array();

    protected $constantsMap = array();

    public function __construct()
    {
        if (\PHP_VERSION_ID >= 70000) {
            $this->blackListedMethods = array_diff($this->blackListedMethods, $this->php7SemiReservedKeywords);
        }
    }

=======
        '__halt_compiler', 'abstract', 'and', 'array', 'as',
        'break', 'callable', 'case', 'catch', 'class',
        'clone', 'const', 'continue', 'declare', 'default',
        'die', 'do', 'echo', 'else', 'elseif',
        'empty', 'enddeclare', 'endfor', 'endforeach', 'endif',
        'endswitch', 'endwhile', 'eval', 'exit', 'extends',
        'final', 'for', 'foreach', 'function', 'global',
        'goto', 'if', 'implements', 'include', 'include_once',
        'instanceof', 'insteadof', 'interface', 'isset', 'list',
        'namespace', 'new', 'or', 'print', 'private',
        'protected', 'public', 'require', 'require_once', 'return',
        'static', 'switch', 'throw', 'trait', 'try',
        'unset', 'use', 'var', 'while', 'xor',
    ];

    /**
     * @var array
     */
    protected $constantsMap = [];

    /**
     * @var bool
     */
    protected $instanceMock = false;

    /**
     * @var bool
     */
    protected $mockOriginalDestructor = false;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $parameterOverrides = [];

    /**
     * @var list<string>
     */
    protected $php7SemiReservedKeywords = [
        'callable', 'class', 'trait', 'extends', 'implements', 'static', 'abstract', 'final',
        'public', 'protected', 'private', 'const', 'enddeclare', 'endfor', 'endforeach', 'endif',
        'endwhile', 'and', 'global', 'goto', 'instanceof', 'insteadof', 'interface', 'namespace', 'new',
        'or', 'xor', 'try', 'use', 'var', 'exit', 'list', 'clone', 'include', 'include_once', 'throw',
        'array', 'print', 'echo', 'require', 'require_once', 'return', 'else', 'elseif', 'default',
        'break', 'continue', 'switch', 'yield', 'function', 'if', 'endswitch', 'finally', 'for', 'foreach',
        'declare', 'case', 'do', 'while', 'as', 'catch', 'die', 'self', 'parent',
    ];

    /**
     * @var array
     */
    protected $targets = [];

    /**
     * @var array
     */
    protected $whiteListedMethods = [];

    public function __construct()
    {
        $this->blackListedMethods = array_diff($this->blackListedMethods, $this->php7SemiReservedKeywords);
    }

    /**
     * @param  string $blackListedMethod
     * @return self
     */
    public function addBlackListedMethod($blackListedMethod)
    {
        $this->blackListedMethods[] = $blackListedMethod;
        return $this;
    }

    /**
     * @param  list<string> $blackListedMethods
     * @return self
     */
    public function addBlackListedMethods(array $blackListedMethods)
    {
        foreach ($blackListedMethods as $method) {
            $this->addBlackListedMethod($method);
        }

        return $this;
    }

    /**
     * @param  class-string $target
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function addTarget($target)
    {
        $this->targets[] = $target;

        return $this;
    }

<<<<<<< HEAD
=======
    /**
     * @param  list<class-string> $targets
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function addTargets($targets)
    {
        foreach ($targets as $target) {
            $this->addTarget($target);
        }

        return $this;
    }

<<<<<<< HEAD
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function addBlackListedMethod($blackListedMethod)
    {
        $this->blackListedMethods[] = $blackListedMethod;
        return $this;
    }

    public function addBlackListedMethods(array $blackListedMethods)
    {
        foreach ($blackListedMethods as $method) {
            $this->addBlackListedMethod($method);
        }
        return $this;
    }

    public function setBlackListedMethods(array $blackListedMethods)
    {
        $this->blackListedMethods = $blackListedMethods;
        return $this;
    }

=======
    /**
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function addWhiteListedMethod($whiteListedMethod)
    {
        $this->whiteListedMethods[] = $whiteListedMethod;
        return $this;
    }

<<<<<<< HEAD
=======
    /**
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function addWhiteListedMethods(array $whiteListedMethods)
    {
        foreach ($whiteListedMethods as $method) {
            $this->addWhiteListedMethod($method);
        }
<<<<<<< HEAD
        return $this;
    }

    public function setWhiteListedMethods(array $whiteListedMethods)
    {
        $this->whiteListedMethods = $whiteListedMethods;
        return $this;
    }

    public function setInstanceMock($instanceMock)
    {
        $this->instanceMock = (bool) $instanceMock;
    }

    public function setParameterOverrides(array $overrides)
    {
        $this->parameterOverrides = $overrides;
    }

    public function setMockOriginalDestructor($mockDestructor)
    {
        $this->mockOriginalDestructor = $mockDestructor;
        return $this;
    }

    public function setConstantsMap(array $map)
    {
        $this->constantsMap = $map;
    }

=======

        return $this;
    }

    /**
     * @return MockConfiguration
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getMockConfiguration()
    {
        return new MockConfiguration(
            $this->targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $this->name,
            $this->instanceMock,
            $this->parameterOverrides,
            $this->mockOriginalDestructor,
            $this->constantsMap
        );
    }
<<<<<<< HEAD
=======

    /**
     * @param  list<string> $blackListedMethods
     * @return self
     */
    public function setBlackListedMethods(array $blackListedMethods)
    {
        $this->blackListedMethods = $blackListedMethods;
        return $this;
    }

    /**
     * @return self
     */
    public function setConstantsMap(array $map)
    {
        $this->constantsMap = $map;

        return $this;
    }

    /**
     * @param bool $instanceMock
     */
    public function setInstanceMock($instanceMock)
    {
        $this->instanceMock = (bool) $instanceMock;

        return $this;
    }

    /**
     * @param bool $mockDestructor
     */
    public function setMockOriginalDestructor($mockDestructor)
    {
        $this->mockOriginalDestructor = (bool) $mockDestructor;
        return $this;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return self
     */
    public function setParameterOverrides(array $overrides)
    {
        $this->parameterOverrides = $overrides;
        return $this;
    }

    /**
     * @param  list<string> $whiteListedMethods
     * @return self
     */
    public function setWhiteListedMethods(array $whiteListedMethods)
    {
        $this->whiteListedMethods = $whiteListedMethods;
        return $this;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
