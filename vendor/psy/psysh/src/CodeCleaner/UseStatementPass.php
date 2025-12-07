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
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\NodeTraverser;
=======
use PhpParser\Node\Identifier;
use PhpParser\Node\Name; // @phan-suppress-current-line PhanUnreferencedUseNormal - used for type checks
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseItem;
use PhpParser\Node\Stmt\UseUse;
use Psy\Exception\FatalErrorException;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

/**
 * Provide implicit use statements for subsequent execution.
 *
 * The use statement pass remembers the last use statement line encountered:
 *
 *     use Foo\Bar as Baz;
 *
 * ... which it then applies implicitly to all future evaluated code, until the
 * current namespace is replaced by another namespace.
<<<<<<< HEAD
 */
class UseStatementPass extends CodeCleanerPass
{
    private $aliases = [];
    private $lastAliases = [];
    private $lastNamespace = null;

    /**
     * Re-load the last set of use statements on re-entering a namespace.
     *
     * This isn't how namespaces normally work, but because PsySH has to spin
     * up a new namespace for every line of code, we do this to make things
     * work like you'd expect.
     *
     * @param Node $node
     *
     * @return int|Node|null Replacement node (or special return value)
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Namespace_) {
            // If this is the same namespace as last namespace, let's do ourselves
            // a favor and reload all the aliases...
            if (\strtolower($node->name ?: '') === \strtolower($this->lastNamespace ?: '')) {
                $this->aliases = $this->lastAliases;
            }
        }
    }

    /**
     * If this statement is a namespace, forget all the aliases we had.
     *
     * If it's a use statement, remember the alias for later. Otherwise, apply
     * remembered aliases to the code.
     *
     * @param Node $node
     *
     * @return int|Node|Node[]|null Replacement node (or special return value)
     */
    public function leaveNode(Node $node)
    {
        // Store a reference to every "use" statement, because we'll need them in a bit.
        if ($node instanceof Use_) {
            foreach ($node->uses as $use) {
                $alias = $use->alias ?: \end($use->name->parts);
                $this->aliases[\strtolower($alias)] = $use->name;
            }

            return NodeTraverser::REMOVE_NODE;
        }

        // Expand every "use" statement in the group into a full, standalone "use" and store 'em with the others.
        if ($node instanceof GroupUse) {
            foreach ($node->uses as $use) {
                $alias = $use->alias ?: \end($use->name->parts);
                $this->aliases[\strtolower($alias)] = Name::concat($node->prefix, $use->name, [
                    'startLine' => $node->prefix->getAttribute('startLine'),
                    'endLine'   => $use->name->getAttribute('endLine'),
                ]);
            }

            return NodeTraverser::REMOVE_NODE;
        }

        // Start fresh, since we're done with this namespace.
        if ($node instanceof Namespace_) {
            $this->lastNamespace = $node->name;
            $this->lastAliases = $this->aliases;
            $this->aliases = [];

            return;
        }

        // Do nothing with UseUse; this an entry in the list of uses in the use statement.
        if ($node instanceof UseUse) {
            return;
        }

        // For everything else, we'll implicitly thunk all aliases into fully-qualified names.
        foreach ($node as $name => $subNode) {
            if ($subNode instanceof Name) {
                if ($replacement = $this->findAlias($subNode)) {
                    $node->$name = $replacement;
                }
            }
        }

        return $node;
    }

    /**
     * Find class/namespace aliases.
     *
     * @param Name $name
     *
     * @return FullyQualifiedName|null
     */
    private function findAlias(Name $name)
    {
        $that = \strtolower($name);
        foreach ($this->aliases as $alias => $prefix) {
            if ($that === $alias) {
                return new FullyQualifiedName($prefix->toString());
            } elseif (\substr($that, 0, \strlen($alias) + 1) === $alias.'\\') {
                return new FullyQualifiedName($prefix->toString().\substr($name, \strlen($alias)));
            }
        }
    }
=======
 *
 * Extends NamespaceAwarePass to leverage shared alias tracking.
 */
class UseStatementPass extends NamespaceAwarePass
{
    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        // Check for use statement conflicts BEFORE parent adds it to aliases
        // Skip re-injected use statements (marked with 'psyshReinjected' attribute)
        if ($node instanceof Use_ && !$node->getAttribute('psyshReinjected')) {
            $this->validateUseStatement($node);
        }

        return parent::enterNode($node);
    }

    /**
     * Re-inject use statements from previous inputs.
     *
     * Each REPL input is evaluated separately; re-injecting use statements matches PHP behavior for
     * namespaces and use statements in a file.
     *
     * @return Node[]|null Array of nodes
     */
    public function beforeTraverse(array $nodes)
    {
        parent::beforeTraverse($nodes);

        if (!$this->cleaner) {
            return null;
        }

        // Check for namespace declarations in the input
        foreach ($nodes as $node) {
            if ($node instanceof Namespace_) {
                // Only re-inject use statements if this is a wrapper created by NamespacePass.
                // This matches PHP behavior: explicit namespace declaration clears use statements.
                if ($node->getAttribute('psyshReinjected')) {
                    $aliases = $this->cleaner->getAliasesForNamespace($node->name);
                    if (!empty($aliases)) {
                        $useStatements = $this->createUseStatements($aliases);
                        $node->stmts = \array_merge($useStatements, $node->stmts ?? []);
                    }
                }

                // Don't process other nodes or return modified nodes
                return null;
            }
        }

        // No namespace declaration in input, or re-applied by NamespacePass; re-inject use
        // statements for the empty namespace.
        $aliases = $this->cleaner->getAliasesForNamespace(null);
        if (!empty($aliases)) {
            $useStatements = $this->createUseStatements($aliases);
            $nodes = \array_merge($useStatements, $nodes);
        }

        return $nodes;
    }

    /**
     * If we have aliases but didn't leave a namespace (global namespace case), persist them to
     * CodeCleaner for the next traversal.
     *
     * {@inheritdoc}
     */
    public function afterTraverse(array $nodes)
    {
        if (!$this->cleaner) {
            return null;
        }

        // Persist aliases if they're at the global level (not inside any namespace)
        if (!empty($this->aliases)) {
            $this->cleaner->setAliasesForNamespace(null, $this->aliases);
        }

        return null;
    }

    /**
     * Validate that a use statement doesn't conflict with existing aliases.
     *
     * @throws FatalErrorException if the alias is already in use
     *
     * @param Use_ $stmt The use statement node
     */
    private function validateUseStatement(Use_ $stmt): void
    {
        foreach ($stmt->uses as $useItem) {
            $alias = \strtolower($useItem->getAlias());

            if (isset($this->aliases[$alias])) {
                throw new FatalErrorException(\sprintf('Cannot use %s as %s because the name is already in use', $useItem->name->toString(), $useItem->getAlias()), 0, \E_ERROR, null, $stmt->getStartLine());
            }
        }
    }

    /**
     * Create use statement nodes from stored aliases.
     *
     * @param array $aliases Map of lowercase alias names to Name nodes
     *
     * @return Use_[] Array of use statement nodes
     */
    private function createUseStatements(array $aliases): array
    {
        $useStatements = [];
        foreach ($aliases as $alias => $name) {
            // Create UseItem (PHP-Parser 5.x) or UseUse (PHP-Parser 4.x)
            $useItem = \class_exists(UseItem::class)
                ? new UseItem($name, new Identifier($alias))
                : new UseUse($name, $alias);
            // Mark as re-injected so we don't validate it
            $useStatements[] = new Use_([$useItem], Use_::TYPE_NORMAL, ['psyshReinjected' => true]);
        }

        return $useStatements;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
