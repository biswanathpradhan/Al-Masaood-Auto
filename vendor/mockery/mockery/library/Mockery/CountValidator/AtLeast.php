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

namespace Mockery\CountValidator;

<<<<<<< HEAD
use Mockery;
=======
use Mockery\Exception\InvalidCountException;

use const PHP_EOL;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

class AtLeast extends CountValidatorAbstract
{
    /**
     * Checks if the validator can accept an additional nth call
     *
     * @param int $n
<<<<<<< HEAD
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return bool
     */
    public function isEligible($n)
    {
        return true;
    }

    /**
     * Validate the call count against this validator
     *
     * @param int $n
<<<<<<< HEAD
=======
     *
     * @throws InvalidCountException
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return bool
     */
    public function validate($n)
    {
        if ($this->_limit > $n) {
<<<<<<< HEAD
            $exception = new Mockery\Exception\InvalidCountException(
=======
            $exception = new InvalidCountException(
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                'Method ' . (string) $this->_expectation
                . ' from ' . $this->_expectation->getMock()->mockery_getName()
                . ' should be called' . PHP_EOL
                . ' at least ' . $this->_limit . ' times but called ' . $n
                . ' times.'
            );
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $exception->setMock($this->_expectation->getMock())
                ->setMethodName((string) $this->_expectation)
                ->setExpectedCountComparative('>=')
                ->setExpectedCount($this->_limit)
                ->setActualCount($n);
            throw $exception;
        }
    }
}
