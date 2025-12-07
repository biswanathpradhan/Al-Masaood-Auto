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
use PhpParser\Node\Expr\Yield_;
use PhpParser\Node\FunctionLike;
use Psy\Exception\FatalErrorException;

class FunctionContextPass extends CodeCleanerPass
{
<<<<<<< HEAD
    /** @var int */
    private $functionDepth;
=======
    private int $functionDepth = 0;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * @param array $nodes
     *
     * @return Node[]|null Array of nodes
     */
    public function beforeTraverse(array $nodes)
    {
        $this->functionDepth = 0;
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * @return int|Node|null Replacement node (or special return value)
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof FunctionLike) {
            $this->functionDepth++;

<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        // node is inside function context
        if ($this->functionDepth !== 0) {
<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        // It causes fatal error.
        if ($node instanceof Yield_) {
            $msg = 'The "yield" expression can only be used inside a function';
<<<<<<< HEAD
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getLine());
        }
=======
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getStartLine());
        }

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * @param \PhpParser\Node $node
     *
     * @return int|Node|Node[]|null Replacement node (or special return value)
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof FunctionLike) {
            $this->functionDepth--;
        }
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
