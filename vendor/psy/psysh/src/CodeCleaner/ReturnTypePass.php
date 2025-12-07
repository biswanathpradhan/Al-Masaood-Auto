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
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Identifier;
<<<<<<< HEAD
=======
use PhpParser\Node\IntersectionType;
use PhpParser\Node\Name;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Node\NullableType;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\UnionType;
use Psy\Exception\FatalErrorException;

/**
 * Add runtime validation for return types.
 */
class ReturnTypePass extends CodeCleanerPass
{
    const MESSAGE = 'A function with return type must return a value';
    const NULLABLE_MESSAGE = 'A function with return type must return a value (did you mean "return null;" instead of "return;"?)';
    const VOID_MESSAGE = 'A void function must not return a value';
    const VOID_NULL_MESSAGE = 'A void function must not return a value (did you mean "return;" instead of "return null;"?)';
    const NULLABLE_VOID_MESSAGE = 'Void type cannot be nullable';

<<<<<<< HEAD
    private $atLeastPhp71;
    private $returnTypeStack = [];

    public function __construct()
    {
        $this->atLeastPhp71 = \version_compare(\PHP_VERSION, '7.1', '>=');
    }
=======
    private array $returnTypeStack = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * {@inheritdoc}
     *
     * @return int|Node|null Replacement node (or special return value)
     */
    public function enterNode(Node $node)
    {
<<<<<<< HEAD
        if (!$this->atLeastPhp71) {
            return; // @codeCoverageIgnore
        }

        if ($this->isFunctionNode($node)) {
            $this->returnTypeStack[] = $node->returnType;

            return;
=======
        if ($this->isFunctionNode($node)) {
            $this->returnTypeStack[] = \property_exists($node, 'returnType') ? $node->returnType : null;

            return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        if (!empty($this->returnTypeStack) && $node instanceof Return_) {
            $expectedType = \end($this->returnTypeStack);
            if ($expectedType === null) {
<<<<<<< HEAD
                return;
=======
                return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }

            $msg = null;

            if ($this->typeName($expectedType) === 'void') {
                // Void functions
                if ($expectedType instanceof NullableType) {
                    $msg = self::NULLABLE_VOID_MESSAGE;
                } elseif ($node->expr instanceof ConstFetch && \strtolower($node->expr->name) === 'null') {
                    $msg = self::VOID_NULL_MESSAGE;
                } elseif ($node->expr !== null) {
                    $msg = self::VOID_MESSAGE;
                }
            } else {
                // Everything else
                if ($node->expr === null) {
                    $msg = $expectedType instanceof NullableType ? self::NULLABLE_MESSAGE : self::MESSAGE;
                }
            }

            if ($msg !== null) {
<<<<<<< HEAD
                throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getLine());
            }
        }
=======
                throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getStartLine());
            }
        }

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * {@inheritdoc}
     *
     * @return int|Node|Node[]|null Replacement node (or special return value)
     */
    public function leaveNode(Node $node)
    {
<<<<<<< HEAD
        if (!$this->atLeastPhp71) {
            return; // @codeCoverageIgnore
        }

        if (!empty($this->returnTypeStack) && $this->isFunctionNode($node)) {
            \array_pop($this->returnTypeStack);
        }
=======
        if (!empty($this->returnTypeStack) && $this->isFunctionNode($node)) {
            \array_pop($this->returnTypeStack);
        }

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    private function isFunctionNode(Node $node): bool
    {
        return $node instanceof Function_ || $node instanceof Closure;
    }

    private function typeName(Node $node): string
    {
        if ($node instanceof UnionType) {
            return \implode('|', \array_map([$this, 'typeName'], $node->types));
        }

<<<<<<< HEAD
        if ($node instanceof NullableType) {
            return \strtolower($node->type->name);
        }

        if ($node instanceof Identifier) {
            return \strtolower($node->name);
=======
        if ($node instanceof IntersectionType) {
            return \implode('&', \array_map([$this, 'typeName'], $node->types));
        }

        if ($node instanceof NullableType) {
            return $this->typeName($node->type);
        }

        if ($node instanceof Identifier || $node instanceof Name) {
            return $node->toLowerString();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        throw new \InvalidArgumentException('Unable to find type name');
    }
}
