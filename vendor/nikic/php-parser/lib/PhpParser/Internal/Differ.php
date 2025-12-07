<?php declare(strict_types=1);

namespace PhpParser\Internal;

/**
 * Implements the Myers diff algorithm.
 *
 * Myers, Eugene W. "An O (ND) difference algorithm and its variations."
 * Algorithmica 1.1 (1986): 251-266.
 *
<<<<<<< HEAD
 * @internal
 */
class Differ
{
=======
 * @template T
 * @internal
 */
class Differ {
    /** @var callable(T, T): bool */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    private $isEqual;

    /**
     * Create differ over the given equality relation.
     *
<<<<<<< HEAD
     * @param callable $isEqual Equality relation with signature function($a, $b) : bool
=======
     * @param callable(T, T): bool $isEqual Equality relation
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(callable $isEqual) {
        $this->isEqual = $isEqual;
    }

    /**
     * Calculate diff (edit script) from $old to $new.
     *
<<<<<<< HEAD
     * @param array $old Original array
     * @param array $new New array
     *
     * @return DiffElem[] Diff (edit script)
     */
    public function diff(array $old, array $new) {
=======
     * @param T[] $old Original array
     * @param T[] $new New array
     *
     * @return DiffElem[] Diff (edit script)
     */
    public function diff(array $old, array $new): array {
        $old = \array_values($old);
        $new = \array_values($new);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        list($trace, $x, $y) = $this->calculateTrace($old, $new);
        return $this->extractDiff($trace, $x, $y, $old, $new);
    }

    /**
     * Calculate diff, including "replace" operations.
     *
     * If a sequence of remove operations is followed by the same number of add operations, these
     * will be coalesced into replace operations.
     *
<<<<<<< HEAD
     * @param array $old Original array
     * @param array $new New array
     *
     * @return DiffElem[] Diff (edit script), including replace operations
     */
    public function diffWithReplacements(array $old, array $new) {
        return $this->coalesceReplacements($this->diff($old, $new));
    }

    private function calculateTrace(array $a, array $b) {
        $n = \count($a);
        $m = \count($b);
=======
     * @param T[] $old Original array
     * @param T[] $new New array
     *
     * @return DiffElem[] Diff (edit script), including replace operations
     */
    public function diffWithReplacements(array $old, array $new): array {
        return $this->coalesceReplacements($this->diff($old, $new));
    }

    /**
     * @param T[] $old
     * @param T[] $new
     * @return array{array<int, array<int, int>>, int, int}
     */
    private function calculateTrace(array $old, array $new): array {
        $n = \count($old);
        $m = \count($new);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $max = $n + $m;
        $v = [1 => 0];
        $trace = [];
        for ($d = 0; $d <= $max; $d++) {
            $trace[] = $v;
            for ($k = -$d; $k <= $d; $k += 2) {
<<<<<<< HEAD
                if ($k === -$d || ($k !== $d && $v[$k-1] < $v[$k+1])) {
                    $x = $v[$k+1];
                } else {
                    $x = $v[$k-1] + 1;
                }

                $y = $x - $k;
                while ($x < $n && $y < $m && ($this->isEqual)($a[$x], $b[$y])) {
=======
                if ($k === -$d || ($k !== $d && $v[$k - 1] < $v[$k + 1])) {
                    $x = $v[$k + 1];
                } else {
                    $x = $v[$k - 1] + 1;
                }

                $y = $x - $k;
                while ($x < $n && $y < $m && ($this->isEqual)($old[$x], $new[$y])) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                    $x++;
                    $y++;
                }

                $v[$k] = $x;
                if ($x >= $n && $y >= $m) {
                    return [$trace, $x, $y];
                }
            }
        }
        throw new \Exception('Should not happen');
    }

<<<<<<< HEAD
    private function extractDiff(array $trace, int $x, int $y, array $a, array $b) {
=======
    /**
     * @param array<int, array<int, int>> $trace
     * @param T[] $old
     * @param T[] $new
     * @return DiffElem[]
     */
    private function extractDiff(array $trace, int $x, int $y, array $old, array $new): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $result = [];
        for ($d = \count($trace) - 1; $d >= 0; $d--) {
            $v = $trace[$d];
            $k = $x - $y;

<<<<<<< HEAD
            if ($k === -$d || ($k !== $d && $v[$k-1] < $v[$k+1])) {
=======
            if ($k === -$d || ($k !== $d && $v[$k - 1] < $v[$k + 1])) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $prevK = $k + 1;
            } else {
                $prevK = $k - 1;
            }

            $prevX = $v[$prevK];
            $prevY = $prevX - $prevK;

            while ($x > $prevX && $y > $prevY) {
<<<<<<< HEAD
                $result[] = new DiffElem(DiffElem::TYPE_KEEP, $a[$x-1], $b[$y-1]);
=======
                $result[] = new DiffElem(DiffElem::TYPE_KEEP, $old[$x - 1], $new[$y - 1]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $x--;
                $y--;
            }

            if ($d === 0) {
                break;
            }

            while ($x > $prevX) {
<<<<<<< HEAD
                $result[] = new DiffElem(DiffElem::TYPE_REMOVE, $a[$x-1], null);
=======
                $result[] = new DiffElem(DiffElem::TYPE_REMOVE, $old[$x - 1], null);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $x--;
            }

            while ($y > $prevY) {
<<<<<<< HEAD
                $result[] = new DiffElem(DiffElem::TYPE_ADD, null, $b[$y-1]);
=======
                $result[] = new DiffElem(DiffElem::TYPE_ADD, null, $new[$y - 1]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $y--;
            }
        }
        return array_reverse($result);
    }

    /**
     * Coalesce equal-length sequences of remove+add into a replace operation.
     *
     * @param DiffElem[] $diff
     * @return DiffElem[]
     */
<<<<<<< HEAD
    private function coalesceReplacements(array $diff) {
=======
    private function coalesceReplacements(array $diff): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $newDiff = [];
        $c = \count($diff);
        for ($i = 0; $i < $c; $i++) {
            $diffType = $diff[$i]->type;
            if ($diffType !== DiffElem::TYPE_REMOVE) {
                $newDiff[] = $diff[$i];
                continue;
            }

            $j = $i;
            while ($j < $c && $diff[$j]->type === DiffElem::TYPE_REMOVE) {
                $j++;
            }

            $k = $j;
            while ($k < $c && $diff[$k]->type === DiffElem::TYPE_ADD) {
                $k++;
            }

            if ($j - $i === $k - $j) {
                $len = $j - $i;
                for ($n = 0; $n < $len; $n++) {
                    $newDiff[] = new DiffElem(
                        DiffElem::TYPE_REPLACE, $diff[$i + $n]->old, $diff[$j + $n]->new
                    );
                }
            } else {
                for (; $i < $k; $i++) {
                    $newDiff[] = $diff[$i];
                }
            }
            $i = $k - 1;
        }
        return $newDiff;
    }
}
