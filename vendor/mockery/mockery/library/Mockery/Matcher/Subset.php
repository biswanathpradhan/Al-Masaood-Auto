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
class Subset extends MatcherAbstract
{
    private $expected;
=======
use function array_replace_recursive;
use function implode;
use function is_array;

class Subset extends MatcherAbstract
{
    private $expected;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    private $strict = true;

    /**
     * @param array $expected Expected subset of data
<<<<<<< HEAD
     * @param bool $strict Whether to run a strict or loose comparison
=======
     * @param bool  $strict   Whether to run a strict or loose comparison
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(array $expected, $strict = true)
    {
        $this->expected = $expected;
        $this->strict = $strict;
    }

    /**
<<<<<<< HEAD
     * @param array $expected Expected subset of data
     *
     * @return Subset
     */
    public static function strict(array $expected)
    {
        return new static($expected, true);
=======
     * Return a string representation of this Matcher
     *
     * @return string
     */
    public function __toString()
    {
        return '<Subset' . $this->formatArray($this->expected) . '>';
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * @param array $expected Expected subset of data
     *
     * @return Subset
     */
    public static function loose(array $expected)
    {
        return new static($expected, false);
    }

    /**
     * Check if the actual value matches the expected.
     *
<<<<<<< HEAD
     * @param mixed $actual
=======
     * @template TMixed
     *
     * @param TMixed $actual
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return bool
     */
    public function match(&$actual)
    {
<<<<<<< HEAD
        if (!is_array($actual)) {
=======
        if (! is_array($actual)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            return false;
        }

        if ($this->strict) {
            return $actual === array_replace_recursive($actual, $this->expected);
        }

        return $actual == array_replace_recursive($actual, $this->expected);
    }

    /**
<<<<<<< HEAD
     * Return a string representation of this Matcher
     *
     * @return string
     */
    public function __toString()
    {
        $return = '<Subset[';
        $elements = array();
        foreach ($this->expected as $k=>$v) {
            $elements[] = $k . '=' . (string) $v;
        }
        $return .= implode(', ', $elements) . ']>';
        return $return;
=======
     * @param array $expected Expected subset of data
     *
     * @return Subset
     */
    public static function strict(array $expected)
    {
        return new static($expected, true);
    }

    /**
     * Recursively format an array into the string representation for this matcher
     *
     * @return string
     */
    protected function formatArray(array $array)
    {
        $elements = [];
        foreach ($array as $k => $v) {
            $elements[] = $k . '=' . (is_array($v) ? $this->formatArray($v) : (string) $v);
        }

        return '[' . implode(', ', $elements) . ']';
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
