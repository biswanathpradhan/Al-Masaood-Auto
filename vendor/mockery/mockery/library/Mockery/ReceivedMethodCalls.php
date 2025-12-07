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

class ReceivedMethodCalls
{
<<<<<<< HEAD
    private $methodCalls = array();
=======
    private $methodCalls = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function push(MethodCall $methodCall)
    {
        $this->methodCalls[] = $methodCall;
    }

    public function verify(Expectation $expectation)
    {
        foreach ($this->methodCalls as $methodCall) {
            if ($methodCall->getMethod() !== $expectation->getName()) {
                continue;
            }

<<<<<<< HEAD
            if (!$expectation->matchArgs($methodCall->getArgs())) {
=======
            if (! $expectation->matchArgs($methodCall->getArgs())) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                continue;
            }

            $expectation->verifyCall($methodCall->getArgs());
        }

        $expectation->verify();
    }
}
