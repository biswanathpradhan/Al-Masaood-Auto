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
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\MagicConst\Dir;
use PhpParser\Node\Scalar\MagicConst\File;
use PhpParser\Node\Scalar\String_;

/**
 * Swap out __DIR__ and __FILE__ magic constants with our best guess?
 */
class MagicConstantsPass extends CodeCleanerPass
{
    /**
     * Swap out __DIR__ and __FILE__ constants, because the default ones when
     * calling eval() don't make sense.
     *
     * @param Node $node
     *
     * @return FuncCall|String_|null
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Dir) {
            return new FuncCall(new Name('getcwd'), [], $node->getAttributes());
        } elseif ($node instanceof File) {
            return new String_('', $node->getAttributes());
        }
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
