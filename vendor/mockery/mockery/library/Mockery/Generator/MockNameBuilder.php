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
class MockNameBuilder
{
    protected static $mockCounter = 0;

    protected $parts = [];

=======
use function implode;
use function str_replace;

class MockNameBuilder
{
    /**
     * @var int
     */
    protected static $mockCounter = 0;

    /**
     * @var list<string>
     */
    protected $parts = [];

    /**
     * @param string $part
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function addPart($part)
    {
        $this->parts[] = $part;

        return $this;
    }

<<<<<<< HEAD
=======
    /**
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function build()
    {
        $parts = ['Mockery', static::$mockCounter++];

        foreach ($this->parts as $part) {
<<<<<<< HEAD
            $parts[] = str_replace("\\", "_", $part);
=======
            $parts[] = str_replace('\\', '_', $part);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return implode('_', $parts);
    }
}
