<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser;
use PhpParser\BuilderHelpers;

<<<<<<< HEAD
abstract class Declaration implements PhpParser\Builder
{
    protected $attributes = [];

=======
abstract class Declaration implements PhpParser\Builder {
    /** @var array<string, mixed> */
    protected array $attributes = [];

    /**
     * Adds a statement.
     *
     * @param PhpParser\Node\Stmt|PhpParser\Builder $stmt The statement to add
     *
     * @return $this The builder instance (for fluid interface)
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    abstract public function addStmt($stmt);

    /**
     * Adds multiple statements.
     *
<<<<<<< HEAD
     * @param array $stmts The statements to add
=======
     * @param (PhpParser\Node\Stmt|PhpParser\Builder)[] $stmts The statements to add
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addStmts(array $stmts) {
        foreach ($stmts as $stmt) {
            $this->addStmt($stmt);
        }

        return $this;
    }

    /**
     * Sets doc comment for the declaration.
     *
     * @param PhpParser\Comment\Doc|string $docComment Doc comment to set
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDocComment($docComment) {
        $this->attributes['comments'] = [
            BuilderHelpers::normalizeDocComment($docComment)
        ];

        return $this;
    }
}
