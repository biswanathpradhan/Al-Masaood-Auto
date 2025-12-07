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
use PhpParser\Node\Identifier;
=======
use PhpParser\Node\Name;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Namespace_;
use Psy\Exception\FatalErrorException;

/**
 * Validate that the constructor method is not static, and does not have a
 * return type.
 *
 * Checks both explicit __construct methods as well as old-style constructor
 * methods with the same name as the class (for non-namespaced classes).
 *
 * As of PHP 5.3.3, methods with the same name as the last element of a
 * namespaced class name will no longer be treated as constructor. This change
 * doesn't affect non-namespaced classes.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class ValidConstructorPass extends CodeCleanerPass
{
<<<<<<< HEAD
    private $namespace;
=======
    private array $namespace = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * @return Node[]|null Array of nodes
     */
    public function beforeTraverse(array $nodes)
    {
        $this->namespace = [];
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Validate that the constructor is not static and does not have a return type.
     *
     * @throws FatalErrorException the constructor function is static
     * @throws FatalErrorException the constructor function has a return type
     *
     * @param Node $node
     *
     * @return int|Node|null Replacement node (or special return value)
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Namespace_) {
<<<<<<< HEAD
            $this->namespace = isset($node->name) ? $node->name->parts : [];
=======
            $this->namespace = isset($node->name) ? $this->getParts($node->name) : [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        } elseif ($node instanceof Class_) {
            $constructor = null;
            foreach ($node->stmts as $stmt) {
                if ($stmt instanceof ClassMethod) {
                    // If we find a new-style constructor, no need to look for the old-style
<<<<<<< HEAD
                    if ('__construct' === \strtolower($stmt->name)) {
                        $this->validateConstructor($stmt, $node);

                        return;
                    }

                    // We found a possible old-style constructor (unless there is also a __construct method)
                    if (empty($this->namespace) && \strtolower($node->name) === \strtolower($stmt->name)) {
=======
                    if (\property_exists($stmt, 'name') && \strtolower($stmt->name) === '__construct') {
                        $this->validateConstructor($stmt, $node);

                        return null;
                    }

                    // We found a possible old-style constructor (unless there is also a __construct method)
                    if (empty($this->namespace) && $node->name !== null && \property_exists($stmt, 'name') && \strtolower($node->name) === \strtolower($stmt->name)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                        $constructor = $stmt;
                    }
                }
            }

            if ($constructor) {
                $this->validateConstructor($constructor, $node);
            }
        }
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * @throws FatalErrorException the constructor function is static
     * @throws FatalErrorException the constructor function has a return type
     *
     * @param Node $constructor
     * @param Node $classNode
     */
    private function validateConstructor(Node $constructor, Node $classNode)
    {
<<<<<<< HEAD
        if ($constructor->isStatic()) {
            // For PHP Parser 4.x
            $className = $classNode->name instanceof Identifier ? $classNode->name->toString() : $classNode->name;

            $msg = \sprintf(
                'Constructor %s::%s() cannot be static',
                \implode('\\', \array_merge($this->namespace, (array) $className)),
                $constructor->name
            );
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $classNode->getLine());
        }

        if (\method_exists($constructor, 'getReturnType') && $constructor->getReturnType()) {
            // For PHP Parser 4.x
            $className = $classNode->name instanceof Identifier ? $classNode->name->toString() : $classNode->name;

            $msg = \sprintf(
                'Constructor %s::%s() cannot declare a return type',
                \implode('\\', \array_merge($this->namespace, (array) $className)),
                $constructor->name
            );
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $classNode->getLine());
        }
    }
=======
        if (\method_exists($constructor, 'isStatic') && $constructor->isStatic()) {
            $msg = \sprintf(
                'Constructor %s::%s() cannot be static',
                \implode('\\', \array_merge($this->namespace, (array) $classNode->name->toString())),
                \property_exists($constructor, 'name') ? $constructor->name : '__construct'
            );
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $classNode->getStartLine());
        }

        if (\method_exists($constructor, 'getReturnType') && $constructor->getReturnType()) {
            $msg = \sprintf(
                'Constructor %s::%s() cannot declare a return type',
                \implode('\\', \array_merge($this->namespace, (array) $classNode->name->toString())),
                \property_exists($constructor, 'name') ? $constructor->name : '__construct'
            );
            throw new FatalErrorException($msg, 0, \E_ERROR, null, $classNode->getStartLine());
        }
    }

    /**
     * Backwards compatibility shim for PHP-Parser 4.x.
     *
     * At some point we might want to make $namespace a plain string, to match how Name works?
     */
    protected function getParts(Name $name): array
    {
        return \method_exists($name, 'getParts') ? $name->getParts() : $name->parts;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
