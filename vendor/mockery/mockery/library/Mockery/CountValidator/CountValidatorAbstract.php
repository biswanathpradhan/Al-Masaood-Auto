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
abstract class CountValidatorAbstract
=======
use Mockery\Expectation;

abstract class CountValidatorAbstract implements CountValidatorInterface
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
{
    /**
     * Expectation for which this validator is assigned
     *
<<<<<<< HEAD
     * @var \Mockery\Expectation
=======
     * @var Expectation
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    protected $_expectation = null;

    /**
     * Call count limit
     *
     * @var int
     */
    protected $_limit = null;

    /**
     * Set Expectation object and upper call limit
     *
<<<<<<< HEAD
     * @param \Mockery\Expectation $expectation
     * @param int $limit
     */
    public function __construct(\Mockery\Expectation $expectation, $limit)
=======
     * @param int $limit
     */
    public function __construct(Expectation $expectation, $limit)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->_expectation = $expectation;
        $this->_limit = $limit;
    }

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
<<<<<<< HEAD
        return ($n < $this->_limit);
=======
        return $n < $this->_limit;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Validate the call count against this validator
     *
     * @param int $n
<<<<<<< HEAD
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return bool
     */
    abstract public function validate($n);
}
