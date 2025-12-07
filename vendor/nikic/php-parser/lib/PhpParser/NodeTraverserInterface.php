<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
interface NodeTraverserInterface
{
=======
interface NodeTraverserInterface {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /**
     * Adds a visitor.
     *
     * @param NodeVisitor $visitor Visitor to add
     */
<<<<<<< HEAD
    public function addVisitor(NodeVisitor $visitor);

    /**
     * Removes an added visitor.
     *
     * @param NodeVisitor $visitor
     */
    public function removeVisitor(NodeVisitor $visitor);
=======
    public function addVisitor(NodeVisitor $visitor): void;

    /**
     * Removes an added visitor.
     */
    public function removeVisitor(NodeVisitor $visitor): void;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Traverses an array of nodes using the registered visitors.
     *
     * @param Node[] $nodes Array of nodes
     *
     * @return Node[] Traversed array of nodes
     */
<<<<<<< HEAD
    public function traverse(array $nodes) : array;
=======
    public function traverse(array $nodes): array;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
