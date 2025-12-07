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

use Symfony\Component\Console\Output\StreamOutput;

/**
 * A passthrough pager is a no-op. It simply wraps a StreamOutput's stream and
 * does nothing when the pager is closed.
 */
class PassthruPager extends StreamOutput implements OutputPager
{
    /**
     * Constructor.
     *
     * @param StreamOutput $output
     */
    public function __construct(StreamOutput $output)
    {
        parent::__construct($output->getStream());
    }

    /**
<<<<<<< HEAD
=======
     * Writes a message to the output.
     *
     * @param string $message A message to write to the output
     * @param bool   $newline Whether to add a newline or not
     */
    public function doWrite($message, $newline): void
    {
        parent::doWrite($message, $newline);
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Close the current pager process.
     */
    public function close()
    {
        // nothing to do here
    }
}
