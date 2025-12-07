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

namespace Psy;

use PhpParser\Parser;
use PhpParser\ParserFactory as OriginalParserFactory;

/**
<<<<<<< HEAD
 * Parser factory to abstract over PHP parser library versions.
 */
class ParserFactory
{
    const ONLY_PHP5 = 'ONLY_PHP5';
    const ONLY_PHP7 = 'ONLY_PHP7';
    const PREFER_PHP5 = 'PREFER_PHP5';
    const PREFER_PHP7 = 'PREFER_PHP7';

    /**
     * Possible kinds of parsers for the factory, from PHP parser library.
     *
     * @return string[]
     */
    public static function getPossibleKinds(): array
    {
        return ['ONLY_PHP5', 'ONLY_PHP7', 'PREFER_PHP5', 'PREFER_PHP7'];
    }

    /**
     * Default kind (if supported, based on current interpreter's version).
     *
     * @return string|null
     */
    public function getDefaultKind()
    {
        return static::ONLY_PHP7;
    }

    /**
     * New parser instance with given kind.
     *
     * @param string|null $kind One of class constants (only for PHP parser 2.0 and above)
     */
    public function createParser($kind = null): Parser
    {
        $originalFactory = new OriginalParserFactory();

        $kind = $kind ?: $this->getDefaultKind();

        if (!\in_array($kind, static::getPossibleKinds())) {
            throw new \InvalidArgumentException('Unknown parser kind');
        }

        $parser = $originalFactory->create(\constant(OriginalParserFactory::class.'::'.$kind));

        return $parser;
=======
 * Parser factory to abstract over PHP Parser library versions.
 */
class ParserFactory
{
    /**
     * New parser instance.
     */
    public function createParser(): Parser
    {
        $factory = new OriginalParserFactory();

        if (!\method_exists($factory, 'createForHostVersion')) {
            return $factory->create(OriginalParserFactory::PREFER_PHP7);
        }

        return $factory->createForHostVersion();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
