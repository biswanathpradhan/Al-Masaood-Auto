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
class Contains extends MatcherAbstract
{
    /**
     * Check if the actual value matches the expected.
     *
     * @param mixed $actual
=======
use function array_values;
use function implode;

class Contains extends MatcherAbstract
{
    /**
     * Return a string representation of this Matcher
     *
     * @return string
     */
    public function __toString()
    {
        $elements = [];
        foreach ($this->_expected as $v) {
            $elements[] = (string) $v;
        }

        return '<Contains[' . implode(', ', $elements) . ']>';
    }

    /**
     * Check if the actual value matches the expected.
     *
     * @template TMixed
     *
     * @param TMixed $actual
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return bool
     */
    public function match(&$actual)
    {
        $values = array_values($actual);
        foreach ($this->_expected as $exp) {
            $match = false;
            foreach ($values as $val) {
                if ($exp === $val || $exp == $val) {
                    $match = true;
                    break;
                }
            }
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            if ($match === false) {
                return false;
            }
        }
<<<<<<< HEAD
        return true;
    }

    /**
     * Return a string representation of this Matcher
     *
     * @return string
     */
    public function __toString()
    {
        $return = '<Contains[';
        $elements = array();
        foreach ($this->_expected as $v) {
            $elements[] = (string) $v;
        }
        $return .= implode(', ', $elements) . ']>';
        return $return;
    }
=======

        return true;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
