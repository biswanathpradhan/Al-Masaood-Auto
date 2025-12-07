<?php declare(strict_types=1);

namespace PhpParser\Node\Name;

<<<<<<< HEAD
class FullyQualified extends \PhpParser\Node\Name
{
=======
class FullyQualified extends \PhpParser\Node\Name {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /**
     * Checks whether the name is unqualified. (E.g. Name)
     *
     * @return bool Whether the name is unqualified
     */
<<<<<<< HEAD
    public function isUnqualified() : bool {
=======
    public function isUnqualified(): bool {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return false;
    }

    /**
     * Checks whether the name is qualified. (E.g. Name\Name)
     *
     * @return bool Whether the name is qualified
     */
<<<<<<< HEAD
    public function isQualified() : bool {
=======
    public function isQualified(): bool {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return false;
    }

    /**
     * Checks whether the name is fully qualified. (E.g. \Name)
     *
     * @return bool Whether the name is fully qualified
     */
<<<<<<< HEAD
    public function isFullyQualified() : bool {
=======
    public function isFullyQualified(): bool {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return true;
    }

    /**
     * Checks whether the name is explicitly relative to the current namespace. (E.g. namespace\Name)
     *
     * @return bool Whether the name is relative
     */
<<<<<<< HEAD
    public function isRelative() : bool {
        return false;
    }

    public function toCodeString() : string {
        return '\\' . $this->toString();
    }
    
    public function getType() : string {
=======
    public function isRelative(): bool {
        return false;
    }

    public function toCodeString(): string {
        return '\\' . $this->toString();
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Name_FullyQualified';
    }
}
