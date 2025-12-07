<?php declare(strict_types=1);

namespace PhpParser\NodeVisitor;

use PhpParser\Node;
<<<<<<< HEAD
use PhpParser\NodeTraverser;
=======
use PhpParser\NodeVisitor;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\NodeVisitorAbstract;

/**
 * This visitor can be used to find the first node satisfying some criterion determined by
 * a filter callback.
 */
<<<<<<< HEAD
class FirstFindingVisitor extends NodeVisitorAbstract
{
    /** @var callable Filter callback */
    protected $filterCallback;
    /** @var null|Node Found node */
    protected $foundNode;
=======
class FirstFindingVisitor extends NodeVisitorAbstract {
    /** @var callable Filter callback */
    protected $filterCallback;
    /** @var null|Node Found node */
    protected ?Node $foundNode;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function __construct(callable $filterCallback) {
        $this->filterCallback = $filterCallback;
    }

    /**
     * Get found node satisfying the filter callback.
     *
     * Returns null if no node satisfies the filter callback.
     *
     * @return null|Node Found node (or null if not found)
     */
<<<<<<< HEAD
    public function getFoundNode() {
        return $this->foundNode;
    }

    public function beforeTraverse(array $nodes) {
=======
    public function getFoundNode(): ?Node {
        return $this->foundNode;
    }

    public function beforeTraverse(array $nodes): ?array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->foundNode = null;

        return null;
    }

    public function enterNode(Node $node) {
        $filterCallback = $this->filterCallback;
        if ($filterCallback($node)) {
            $this->foundNode = $node;
<<<<<<< HEAD
            return NodeTraverser::STOP_TRAVERSAL;
=======
            return NodeVisitor::STOP_TRAVERSAL;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return null;
    }
}
