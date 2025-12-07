<?php

/**
<<<<<<< HEAD
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
 * @copyright  Copyright (c) 2017 Dave Marshall https://github.com/davedevelopment
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 */

namespace Mockery;

<<<<<<< HEAD
use Mockery\Matcher\Closure;
=======
use Closure;

use function func_get_args;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

/**
 * @internal
 */
class ClosureWrapper
{
    private $closure;

<<<<<<< HEAD
    public function __construct(\Closure $closure)
=======
    public function __construct(Closure $closure)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->closure = $closure;
    }

<<<<<<< HEAD
    public function __invoke()
    {
        return call_user_func_array($this->closure, func_get_args());
=======
    /**
     * @return mixed
     */
    public function __invoke()
    {
        return ($this->closure)(...func_get_args());
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
