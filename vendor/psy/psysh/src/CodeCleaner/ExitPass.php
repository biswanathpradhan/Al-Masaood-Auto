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

namespace Psy\CodeCleaner;

use PhpParser\Node;
<<<<<<< HEAD
=======
use PhpParser\Node\Arg;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;
use Psy\Exception\BreakException;

class ExitPass extends CodeCleanerPass
{
    /**
     * Converts exit calls to BreakExceptions.
     *
     * @param \PhpParser\Node $node
     *
     * @return int|Node|Node[]|null Replacement node (or special return value)
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Exit_) {
<<<<<<< HEAD
            return new StaticCall(new FullyQualifiedName(BreakException::class), 'exitShell');
        }
=======
            $args = $node->expr ? [new Arg($node->expr)] : [];

            return new StaticCall(new FullyQualifiedName(BreakException::class), 'exitShell', $args);
        }

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
