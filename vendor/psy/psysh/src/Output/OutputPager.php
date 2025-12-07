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

namespace Psy\Output;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * An output pager is much the same as a regular OutputInterface, but allows
 * the stream to be flushed to a pager periodically.
 */
interface OutputPager extends OutputInterface
{
<<<<<<< HEAD
=======
    // TODO: Add doWrite to the OutputPager interface.
    // /**
    //  * Writes a message to the output.
    //  *
    //  * @param string $message A message to write to the output
    //  * @param bool   $newline Whether to add a newline or not
    //  */
    // public function doWrite($message, $newline): void;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /**
     * Close the current pager process.
     */
    public function close();
}
