<?php declare(strict_types=1);

namespace PhpParser\NodeVisitor;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

/**
 * Visitor cloning all nodes and linking to the original nodes using an attribute.
 *
 * This visitor is required to perform format-preserving pretty prints.
 */
<<<<<<< HEAD
class CloningVisitor extends NodeVisitorAbstract
{
=======
class CloningVisitor extends NodeVisitorAbstract {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function enterNode(Node $origNode) {
        $node = clone $origNode;
        $node->setAttribute('origNode', $origNode);
        return $node;
    }
}
