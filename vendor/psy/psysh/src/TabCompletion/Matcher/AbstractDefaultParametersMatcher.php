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

namespace Psy\TabCompletion\Matcher;

abstract class AbstractDefaultParametersMatcher extends AbstractContextAwareMatcher
{
    /**
     * @param \ReflectionParameter[] $reflectionParameters
     *
     * @return array
     */
    public function getDefaultParameterCompletion(array $reflectionParameters): array
    {
        $parametersProcessed = [];

        foreach ($reflectionParameters as $parameter) {
            if (!$parameter->isDefaultValueAvailable()) {
                return [];
            }

            $defaultValue = $this->valueToShortString($parameter->getDefaultValue());

            $parametersProcessed[] = \sprintf('$%s = %s', $parameter->getName(), $defaultValue);
        }

        if (empty($parametersProcessed)) {
            return [];
        }

        return [\implode(', ', $parametersProcessed).')'];
    }

    /**
     * Takes in the default value of a parameter and turns it into a
     *  string representation that fits inline.
     * This is not 100% true to the original (newlines are inlined, for example).
     *
     * @param mixed $value
     */
    private function valueToShortString($value): string
    {
        if (!\is_array($value)) {
            return \json_encode($value);
        }

        $chunks = [];
        $chunksSequential = [];

        $allSequential = true;

        foreach ($value as $key => $item) {
            $allSequential = $allSequential && \is_numeric($key) && $key === \count($chunksSequential);

            $keyString = $this->valueToShortString($key);
            $itemString = $this->valueToShortString($item);

            $chunks[] = "{$keyString} => {$itemString}";
            $chunksSequential[] = $itemString;
        }

        $chunksToImplode = $allSequential ? $chunksSequential : $chunks;

        return '['.\implode(', ', $chunksToImplode).']';
    }
}
