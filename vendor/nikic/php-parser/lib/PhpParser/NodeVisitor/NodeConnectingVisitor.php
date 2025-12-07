<?php declare(strict_types=1);

namespace PhpParser\NodeVisitor;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

/**
 * Visitor that connects a child node to its parent node
 * as well as its sibling nodes.
 *
<<<<<<< HEAD
 * On the child node, the parent node can be accessed through
 * <code>$node->getAttribute('parent')</code>, the previous
 * node can be accessed through <code>$node->getAttribute('previous')</code>,
 * and the next node can be accessed through <code>$node->getAttribute('next')</code>.
 */
final class NodeConnectingVisitor extends NodeVisitorAbstract
{
    /**
     * @var Node[]
     */
    private $stack = [];
=======
 * With <code>$weakReferences=false</code> on the child node, the parent node can be accessed through
 * <code>$node->getAttribute('parent')</code>, the previous
 * node can be accessed through <code>$node->getAttribute('previous')</code>,
 * and the next node can be accessed through <code>$node->getAttribute('next')</code>.
 *
 * With <code>$weakReferences=true</code> attribute names are prefixed by "weak_", e.g. "weak_parent".
 */
final class NodeConnectingVisitor extends NodeVisitorAbstract {
    /**
     * @var Node[]
     */
    private array $stack = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * @var ?Node
     */
    private $previous;

<<<<<<< HEAD
=======
    private bool $weakReferences;

    public function __construct(bool $weakReferences = false) {
        $this->weakReferences = $weakReferences;
    }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function beforeTraverse(array $nodes) {
        $this->stack    = [];
        $this->previous = null;
    }

    public function enterNode(Node $node) {
        if (!empty($this->stack)) {
<<<<<<< HEAD
            $node->setAttribute('parent', $this->stack[count($this->stack) - 1]);
        }

        if ($this->previous !== null && $this->previous->getAttribute('parent') === $node->getAttribute('parent')) {
            $node->setAttribute('previous', $this->previous);
            $this->previous->setAttribute('next', $node);
=======
            $parent = $this->stack[count($this->stack) - 1];
            if ($this->weakReferences) {
                $node->setAttribute('weak_parent', \WeakReference::create($parent));
            } else {
                $node->setAttribute('parent', $parent);
            }
        }

        if ($this->previous !== null) {
            if (
                $this->weakReferences
            ) {
                if ($this->previous->getAttribute('weak_parent') === $node->getAttribute('weak_parent')) {
                    $node->setAttribute('weak_previous', \WeakReference::create($this->previous));
                    $this->previous->setAttribute('weak_next', \WeakReference::create($node));
                }
            } elseif ($this->previous->getAttribute('parent') === $node->getAttribute('parent')) {
                $node->setAttribute('previous', $this->previous);
                $this->previous->setAttribute('next', $node);
            }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        $this->stack[] = $node;
    }

    public function leaveNode(Node $node) {
        $this->previous = $node;

        array_pop($this->stack);
    }
}
