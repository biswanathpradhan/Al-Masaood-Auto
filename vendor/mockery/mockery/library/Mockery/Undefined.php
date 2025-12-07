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
=======
use function spl_object_hash;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
class Undefined
{
    /**
     * Call capturing to merely return this same object.
     *
     * @param string $method
<<<<<<< HEAD
     * @param array $args
=======
     * @param array  $args
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return self
     */
    public function __call($method, array $args)
    {
        return $this;
    }

    /**
<<<<<<< HEAD
     * Return a string, avoiding E_RECOVERABLE_ERROR
=======
     * Return a string, avoiding E_RECOVERABLE_ERROR.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return string
     */
    public function __toString()
    {
<<<<<<< HEAD
        return __CLASS__ . ":" . spl_object_hash($this);
=======
        return self::class . ':' . spl_object_hash($this);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
