<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2023 Justin Hileman
=======
 * (c) 2012-2025 Justin Hileman
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Exception;

class UnexpectedTargetException extends RuntimeException
{
<<<<<<< HEAD
=======
    /** @var mixed */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    private $target;

    /**
     * @param mixed           $target
     * @param string          $message  (default: "")
     * @param int             $code     (default: 0)
     * @param \Throwable|null $previous (default: null)
     */
<<<<<<< HEAD
    public function __construct($target, string $message = '', int $code = 0, \Throwable $previous = null)
=======
    public function __construct($target, string $message = '', int $code = 0, ?\Throwable $previous = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->target = $target;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }
}
