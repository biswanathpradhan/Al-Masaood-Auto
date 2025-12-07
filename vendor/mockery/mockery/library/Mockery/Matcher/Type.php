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

namespace Mockery\Matcher;

<<<<<<< HEAD
class Type extends MatcherAbstract
{
    /**
     * Check if the actual value matches the expected.
     *
     * @param mixed $actual
     * @return bool
     */
    public function match(&$actual)
    {
        if ($this->_expected == 'real') {
            $function = 'is_float';
        } else {
            $function = 'is_' . strtolower($this->_expected);
        }
        if (function_exists($function)) {
            return $function($actual);
        } elseif (is_string($this->_expected)
        && (class_exists($this->_expected) || interface_exists($this->_expected))) {
            return $actual instanceof $this->_expected;
        }
        return false;
    }

    /**
=======
use function class_exists;
use function function_exists;
use function interface_exists;
use function is_string;
use function strtolower;
use function ucfirst;

class Type extends MatcherAbstract
{
    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Return a string representation of this Matcher
     *
     * @return string
     */
    public function __toString()
    {
        return '<' . ucfirst($this->_expected) . '>';
    }
<<<<<<< HEAD
=======

    /**
     * Check if the actual value matches the expected.
     *
     * @template TMixed
     *
     * @param TMixed $actual
     *
     * @return bool
     */
    public function match(&$actual)
    {
        $function = $this->_expected === 'real' ? 'is_float' : 'is_' . strtolower($this->_expected);

        if (function_exists($function)) {
            return $function($actual);
        }

        if (! is_string($this->_expected)) {
            return false;
        }

        if (class_exists($this->_expected) || interface_exists($this->_expected)) {
            return $actual instanceof $this->_expected;
        }

        return false;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
