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

namespace Mockery\Generator\StringManipulation\Pass;

use Mockery\Generator\MockConfiguration;
<<<<<<< HEAD

class InstanceMockPass
{
    const INSTANCE_MOCK_CODE = <<<MOCK
=======
use function strrpos;
use function substr;

class InstanceMockPass implements Pass
{
    public const INSTANCE_MOCK_CODE = <<<MOCK
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    protected \$_mockery_ignoreVerification = true;

    public function __construct()
    {
        \$this->_mockery_ignoreVerification = false;
        \$associatedRealObject = \Mockery::fetchMock(__CLASS__);

        foreach (get_object_vars(\$this) as \$attr => \$val) {
            if (\$attr !== "_mockery_ignoreVerification" && \$attr !== "_mockery_expectations") {
                \$this->\$attr = \$associatedRealObject->\$attr;
            }
        }

        \$directors = \$associatedRealObject->mockery_getExpectations();
        foreach (\$directors as \$method=>\$director) {
            // get the director method needed
            \$existingDirector = \$this->mockery_getExpectationsFor(\$method);
            if (!\$existingDirector) {
                \$existingDirector = new \Mockery\ExpectationDirector(\$method, \$this);
                \$this->mockery_setExpectationsFor(\$method, \$existingDirector);
            }
            \$expectations = \$director->getExpectations();
            foreach (\$expectations as \$expectation) {
                \$clonedExpectation = clone \$expectation;
                \$existingDirector->addExpectation(\$clonedExpectation);
            }
            \$defaultExpectations = \$director->getDefaultExpectations();
            foreach (array_reverse(\$defaultExpectations) as \$expectation) {
                \$clonedExpectation = clone \$expectation;
                \$existingDirector->addExpectation(\$clonedExpectation);
                \$existingDirector->makeExpectationDefault(\$clonedExpectation);
            }
        }
        \Mockery::getContainer()->rememberMock(\$this);
<<<<<<< HEAD
        
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        \$this->_mockery_constructorCalled(func_get_args());
    }
MOCK;

<<<<<<< HEAD
    public function apply($code, MockConfiguration $config)
    {
        if ($config->isInstanceMock()) {
            $code = $this->appendToClass($code, static::INSTANCE_MOCK_CODE);
=======
    /**
     * @param  string $code
     * @return string
     */
    public function apply($code, MockConfiguration $config)
    {
        if ($config->isInstanceMock()) {
            return $this->appendToClass($code, static::INSTANCE_MOCK_CODE);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return $code;
    }

    protected function appendToClass($class, $code)
    {
<<<<<<< HEAD
        $lastBrace = strrpos($class, "}");
        $class = substr($class, 0, $lastBrace) . $code . "\n    }\n";
        return $class;
=======
        $lastBrace = strrpos($class, '}');
        return substr($class, 0, $lastBrace) . $code . "\n    }\n";
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
