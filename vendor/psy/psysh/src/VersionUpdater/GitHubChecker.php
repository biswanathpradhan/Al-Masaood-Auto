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

namespace Psy\VersionUpdater;

use Psy\Shell;

class GitHubChecker implements Checker
{
    const URL = 'https://api.github.com/repos/bobthecow/psysh/releases/latest';

<<<<<<< HEAD
    private $latest;
=======
    private ?string $latest = null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function isLatest(): bool
    {
        // version_compare doesn't handle semver completely;
        // strip pre-release and build metadata before comparing
        $version = \preg_replace('/[+-]\w+/', '', Shell::VERSION);

        return \version_compare($version, $this->getLatest(), '>=');
    }

    public function getLatest(): string
    {
        if (!isset($this->latest)) {
            $this->setLatest($this->getVersionFromTag());
        }

        return $this->latest;
    }

<<<<<<< HEAD
    /**
     * @param string $version
     */
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function setLatest(string $version)
    {
        $this->latest = $version;
    }

<<<<<<< HEAD
    /**
     * @return string|null
     */
    private function getVersionFromTag()
=======
    private function getVersionFromTag(): ?string
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $contents = $this->fetchLatestRelease();
        if (!$contents || !isset($contents->tag_name)) {
            throw new \InvalidArgumentException('Unable to check for updates');
        }
        $this->setLatest($contents->tag_name);

        return $this->getLatest();
    }

    /**
     * Set to public to make testing easier.
     *
     * @return mixed
     */
    public function fetchLatestRelease()
    {
        $context = \stream_context_create([
            'http' => [
                'user_agent' => 'PsySH/'.Shell::VERSION,
                'timeout'    => 1.0,
            ],
        ]);

        \set_error_handler(function () {
            // Just ignore all errors with this. The checker will throw an exception
            // if it doesn't work :)
        });

        $result = @\file_get_contents(self::URL, false, $context);

        \restore_error_handler();

        return \json_decode($result);
    }
}
