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
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\ArrayItem;
=======
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayDimFetch;
// @todo Drop PhpParser\Node\Expr\ArrayItem once we drop support for PHP-Parser 4.x
use PhpParser\Node\Expr\ArrayItem as LegacyArrayItem;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\List_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use Psy\Exception\ParseErrorException;

/**
 * Validate that the list assignment.
 */
class ListPass extends CodeCleanerPass
{
<<<<<<< HEAD
    private $atLeastPhp71;

    public function __construct()
    {
        $this->atLeastPhp71 = \version_compare(\PHP_VERSION, '7.1', '>=');
    }

=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /**
     * Validate use of list assignment.
     *
     * @throws ParseErrorException if the user used empty with anything but a variable
     *
     * @param Node $node
     *
     * @return int|Node|null Replacement node (or special return value)
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Assign) {
<<<<<<< HEAD
            return;
        }

        if (!$node->var instanceof Array_ && !$node->var instanceof List_) {
            return;
        }

        if (!$this->atLeastPhp71 && $node->var instanceof Array_) {
            $msg = "syntax error, unexpected '='";
            throw new ParseErrorException($msg, $node->expr->getLine());
        }

        // Polyfill for PHP-Parser 2.x
        $items = isset($node->var->items) ? $node->var->items : $node->var->vars;

        if ($items === [] || $items === [null]) {
            throw new ParseErrorException('Cannot use empty list', $node->var->getLine());
=======
            return null;
        }

        if (!$node->var instanceof Array_ && !$node->var instanceof List_) {
            return null;
        }

        // Polyfill for PHP-Parser 2.x
        $items = isset($node->var->items) ? $node->var->items : (\property_exists($node->var, 'vars') ? $node->var->vars : []);

        if ($items === [] || $items === [null]) {
            throw new ParseErrorException('Cannot use empty list', ['startLine' => $node->var->getStartLine(), 'endLine' => $node->var->getEndLine()]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        $itemFound = false;
        foreach ($items as $item) {
            if ($item === null) {
                continue;
            }

            $itemFound = true;

<<<<<<< HEAD
            // List_->$vars in PHP-Parser 2.x is Variable instead of ArrayItem.
            if (!$this->atLeastPhp71 && $item instanceof ArrayItem && $item->key !== null) {
                $msg = 'Syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting \',\' or \')\'';
                throw new ParseErrorException($msg, $item->key->getLine());
            }

            if (!self::isValidArrayItem($item)) {
                $msg = 'Assignments can only happen to writable values';
                throw new ParseErrorException($msg, $item->getLine());
=======
            if (!self::isValidArrayItem($item)) {
                $msg = 'Assignments can only happen to writable values';
                throw new ParseErrorException($msg, ['startLine' => $item->getStartLine(), 'endLine' => $item->getEndLine()]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }
        }

        if (!$itemFound) {
            throw new ParseErrorException('Cannot use empty list');
        }
<<<<<<< HEAD
=======

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Validate whether a given item in an array is valid for short assignment.
     *
<<<<<<< HEAD
     * @param Expr $item
     */
    private static function isValidArrayItem(Expr $item): bool
    {
        $value = ($item instanceof ArrayItem) ? $item->value : $item;
=======
     * @param Node $item
     */
    private static function isValidArrayItem(Node $item): bool
    {
        $value = ($item instanceof ArrayItem || $item instanceof LegacyArrayItem) ? $item->value : $item;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        while ($value instanceof ArrayDimFetch || $value instanceof PropertyFetch) {
            $value = $value->var;
        }

        // We just kind of give up if it's a method call. We can't tell if it's
        // valid via static analysis.
        return $value instanceof Variable || $value instanceof MethodCall || $value instanceof FuncCall;
    }
}
