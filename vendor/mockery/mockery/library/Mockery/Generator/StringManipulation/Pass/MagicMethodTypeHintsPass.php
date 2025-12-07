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
use Mockery\Generator\TargetClassInterface;
use Mockery\Generator\Method;
use Mockery\Generator\Parameter;
=======
use Mockery\Generator\Method;
use Mockery\Generator\MockConfiguration;
use Mockery\Generator\Parameter;
use Mockery\Generator\TargetClassInterface;
use function array_filter;
use function array_merge;
use function end;
use function in_array;
use function is_array;
use function preg_match;
use function preg_match_all;
use function preg_replace;
use function rtrim;
use function sprintf;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

class MagicMethodTypeHintsPass implements Pass
{
    /**
<<<<<<< HEAD
     * @var array $mockMagicMethods
     */
    private $mockMagicMethods = array(
=======
     * @var array
     */
    private $mockMagicMethods = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        '__construct',
        '__destruct',
        '__call',
        '__callStatic',
        '__get',
        '__set',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
<<<<<<< HEAD
        '__debugInfo'
    );
=======
        '__debugInfo',
    ];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Apply implementation.
     *
     * @param string $code
<<<<<<< HEAD
     * @param MockConfiguration $config
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return string
     */
    public function apply($code, MockConfiguration $config)
    {
        $magicMethods = $this->getMagicMethods($config->getTargetClass());
        foreach ($config->getTargetInterfaces() as $interface) {
            $magicMethods = array_merge($magicMethods, $this->getMagicMethods($interface));
        }

        foreach ($magicMethods as $method) {
            $code = $this->applyMagicTypeHints($code, $method);
        }

        return $code;
    }

    /**
     * Returns the magic methods within the
     * passed DefinedTargetClass.
     *
<<<<<<< HEAD
     * @param TargetClassInterface $class
     * @return array
     */
    public function getMagicMethods(
        TargetClassInterface $class = null
    ) {
        if (is_null($class)) {
            return array();
        }
        return array_filter($class->getMethods(), function (Method $method) {
            return in_array($method->getName(), $this->mockMagicMethods);
        });
    }

=======
     * @return array
     */
    public function getMagicMethods(?TargetClassInterface $class = null)
    {
        if (! $class instanceof TargetClassInterface) {
            return [];
        }

        return array_filter($class->getMethods(), function (Method $method) {
            return in_array($method->getName(), $this->mockMagicMethods, true);
        });
    }

    protected function renderTypeHint(Parameter $param)
    {
        $typeHint = $param->getTypeHint();

        return $typeHint === null ? '' : sprintf('%s ', $typeHint);
    }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /**
     * Applies type hints of magic methods from
     * class to the passed code.
     *
     * @param int $code
<<<<<<< HEAD
     * @param Method $method
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return string
     */
    private function applyMagicTypeHints($code, Method $method)
    {
        if ($this->isMethodWithinCode($code, $method)) {
<<<<<<< HEAD
            $namedParameters = $this->getOriginalParameters(
                $code,
                $method
            );
=======
            $namedParameters = $this->getOriginalParameters($code, $method);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $code = preg_replace(
                $this->getDeclarationRegex($method->getName()),
                $this->getMethodDeclaration($method, $namedParameters),
                $code
            );
        }
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $code;
    }

    /**
<<<<<<< HEAD
     * Checks if the method is declared within code.
     *
     * @param int $code
     * @param Method $method
     * @return boolean
     */
    private function isMethodWithinCode($code, Method $method)
    {
        return preg_match(
            $this->getDeclarationRegex($method->getName()),
            $code
        ) == 1;
    }

    /**
     * Returns the method original parameters, as they're
     * described in the $code string.
     *
     * @param int $code
     * @param Method $method
     * @return array
     */
    private function getOriginalParameters($code, Method $method)
    {
        $matches = [];
        $parameterMatches = [];

        preg_match(
            $this->getDeclarationRegex($method->getName()),
            $code,
            $matches
        );

        if (count($matches) > 0) {
            preg_match_all(
                '/(?<=\$)(\w+)+/i',
                $matches[0],
                $parameterMatches
            );
        }

        $groupMatches = end($parameterMatches);
        $parameterNames = is_array($groupMatches) ? $groupMatches : [$groupMatches];

        return $parameterNames;
=======
     * Returns a regex string used to match the
     * declaration of some method.
     *
     * @param string $methodName
     *
     * @return string
     */
    private function getDeclarationRegex($methodName)
    {
        return sprintf('/public\s+(?:static\s+)?function\s+%s\s*\(.*\)\s*(?=\{)/i', $methodName);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Gets the declaration code, as a string, for the passed method.
     *
<<<<<<< HEAD
     * @param Method $method
     * @param array  $namedParameters
     * @return string
     */
    private function getMethodDeclaration(
        Method $method,
        array $namedParameters
    ) {
=======
     * @param array $namedParameters
     *
     * @return string
     */
    private function getMethodDeclaration(Method $method, array $namedParameters)
    {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $declaration = 'public';
        $declaration .= $method->isStatic() ? ' static' : '';
        $declaration .= ' function ' . $method->getName() . '(';

        foreach ($method->getParameters() as $index => $parameter) {
            $declaration .= $this->renderTypeHint($parameter);
<<<<<<< HEAD
            $name = isset($namedParameters[$index]) ? $namedParameters[$index] : $parameter->getName();
            $declaration .= '$' . $name;
            $declaration .= ',';
        }
=======
            $name = $namedParameters[$index] ?? $parameter->getName();
            $declaration .= '$' . $name;
            $declaration .= ',';
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $declaration = rtrim($declaration, ',');
        $declaration .= ') ';

        $returnType = $method->getReturnType();
        if ($returnType !== null) {
            $declaration .= sprintf(': %s', $returnType);
        }

        return $declaration;
    }

<<<<<<< HEAD
    protected function renderTypeHint(Parameter $param)
    {
        $typeHint = $param->getTypeHint();

        return $typeHint === null ? '' : sprintf('%s ', $typeHint);
    }

    /**
     * Returns a regex string used to match the
     * declaration of some method.
     *
     * @param string $methodName
     * @return string
     */
    private function getDeclarationRegex($methodName)
    {
        return "/public\s+(?:static\s+)?function\s+$methodName\s*\(.*\)\s*(?=\{)/i";
=======
    /**
     * Returns the method original parameters, as they're
     * described in the $code string.
     *
     * @param int $code
     *
     * @return array
     */
    private function getOriginalParameters($code, Method $method)
    {
        $matches = [];
        $parameterMatches = [];

        preg_match($this->getDeclarationRegex($method->getName()), $code, $matches);

        if ($matches !== []) {
            preg_match_all('/(?<=\$)(\w+)+/i', $matches[0], $parameterMatches);
        }

        $groupMatches = end($parameterMatches);

        return is_array($groupMatches) ? $groupMatches : [$groupMatches];
    }

    /**
     * Checks if the method is declared within code.
     *
     * @param int $code
     *
     * @return bool
     */
    private function isMethodWithinCode($code, Method $method)
    {
        return preg_match($this->getDeclarationRegex($method->getName()), $code) === 1;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
