<?php declare(strict_types=1);

namespace PhpParser;

/**
 * @codeCoverageIgnore
 */
<<<<<<< HEAD
class NodeVisitorAbstract implements NodeVisitor
{
=======
abstract class NodeVisitorAbstract implements NodeVisitor {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function beforeTraverse(array $nodes) {
        return null;
    }

    public function enterNode(Node $node) {
        return null;
    }

    public function leaveNode(Node $node) {
        return null;
    }

    public function afterTraverse(array $nodes) {
        return null;
    }
}
