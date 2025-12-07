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
class MockDefinition
{
    protected $config;
    protected $code;

    public function __construct(MockConfiguration $config, $code)
    {
        if (!$config->getName()) {
            throw new \InvalidArgumentException("MockConfiguration must contain a name");
        }
=======
use InvalidArgumentException;

class MockDefinition
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var MockConfiguration
     */
    protected $config;

    /**
     * @param  string                   $code
     * @throws InvalidArgumentException
     */
    public function __construct(MockConfiguration $config, $code)
    {
        if (! $config->getName()) {
            throw new InvalidArgumentException('MockConfiguration must contain a name');
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->config = $config;
        $this->code = $code;
    }

<<<<<<< HEAD
    public function getConfig()
    {
        return $this->config;
    }

=======
    /**
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getClassName()
    {
        return $this->config->getName();
    }

<<<<<<< HEAD
=======
    /**
     * @return string
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getCode()
    {
        return $this->code;
    }
<<<<<<< HEAD
=======

    /**
     * @return MockConfiguration
     */
    public function getConfig()
    {
        return $this->config;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
