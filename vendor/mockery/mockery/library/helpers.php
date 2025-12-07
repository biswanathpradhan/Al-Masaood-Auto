<?php

<<<<<<< HEAD
use Mockery\Matcher\AndAnyOtherArgs;
use Mockery\Matcher\AnyArgs;

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
 * @copyright  Copyright (c) 2016 Dave Marshall
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

if (!function_exists("mock")) {
=======
/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
 */

use Mockery\LegacyMockInterface;
use Mockery\Matcher\AndAnyOtherArgs;
use Mockery\Matcher\AnyArgs;
use Mockery\MockInterface;

if (! \function_exists('mock')) {
    /**
     * @template TMock of object
     *
     * @param array<class-string<TMock>|TMock|Closure(LegacyMockInterface&MockInterface&TMock):LegacyMockInterface&MockInterface&TMock|array<TMock>> $args
     *
     * @return LegacyMockInterface&MockInterface&TMock
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    function mock(...$args)
    {
        return Mockery::mock(...$args);
    }
}

<<<<<<< HEAD
if (!function_exists("spy")) {
=======
if (! \function_exists('spy')) {
    /**
     * @template TSpy of object
     *
     * @param array<class-string<TSpy>|TSpy|Closure(LegacyMockInterface&MockInterface&TSpy):LegacyMockInterface&MockInterface&TSpy|array<TSpy>> $args
     *
     * @return LegacyMockInterface&MockInterface&TSpy
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    function spy(...$args)
    {
        return Mockery::spy(...$args);
    }
}

<<<<<<< HEAD
if (!function_exists("namedMock")) {
=======
if (! \function_exists('namedMock')) {
    /**
     * @template TNamedMock of object
     *
     * @param array<class-string<TNamedMock>|TNamedMock|array<TNamedMock>> $args
     *
     * @return LegacyMockInterface&MockInterface&TNamedMock
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    function namedMock(...$args)
    {
        return Mockery::namedMock(...$args);
    }
}

<<<<<<< HEAD
if (!function_exists("anyArgs")) {
    function anyArgs()
=======
if (! \function_exists('anyArgs')) {
    function anyArgs(): AnyArgs
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        return new AnyArgs();
    }
}

<<<<<<< HEAD
if (!function_exists("andAnyOtherArgs")) {
    function andAnyOtherArgs()
=======
if (! \function_exists('andAnyOtherArgs')) {
    function andAnyOtherArgs(): AndAnyOtherArgs
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        return new AndAnyOtherArgs();
    }
}

<<<<<<< HEAD
if (!function_exists("andAnyOthers")) {
    function andAnyOthers()
=======
if (! \function_exists('andAnyOthers')) {
    function andAnyOthers(): AndAnyOtherArgs
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        return new AndAnyOtherArgs();
    }
}
