<?php declare(strict_types=1);

namespace PhpParser\NodeVisitor;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

/**
 * This visitor can be used to find and collect all nodes satisfying some criterion determined by
 * a filter callback.
 */
<<<<<<< HEAD
class FindingVisitor extends NodeVisitorAbstract
{
    /** @var callable Filter callback */
    protected $filterCallback;
    /** @var Node[] Found nodes */
    protected $foundNodes;
=======
class FindingVisitor extends NodeVisitorAbstract {
    /** @var callable Filter callback */
    protected $filterCallback;
    /** @var list<Node> Found nodes */
    protected array $foundNodes;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function __construct(callable $filterCallback) {
        $this->filterCallback = $filterCallback;
    }

    /**
     * Get found nodes satisfying the filter callback.
     *
     * Nodes are returned in pre-order.
     *
<<<<<<< HEAD
     * @return Node[] Found nodes
     */
    public function getFoundNodes() : array {
        return $this->foundNodes;
    }

    public function beforeTraverse(array $nodes) {
=======
     * @return list<Node> Found nodes
     */
    public function getFoundNodes(): array {
        return $this->foundNodes;
    }

    public function beforeTraverse(array $nodes): ?array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->foundNodes = [];

        return null;
    }

    public function enterNode(Node $node) {
        $filterCallback = $this->filterCallback;
        if ($filterCallback($node)) {
            $this->foundNodes[] = $node;
        }

        return null;
    }
}
