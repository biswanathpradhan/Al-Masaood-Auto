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

namespace Psy\VersionUpdater\Downloader;

<<<<<<< HEAD
=======
use Psy\Exception\RuntimeException;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\VersionUpdater\Downloader;

class FileDownloader implements Downloader
{
<<<<<<< HEAD
    private $tempDir = null;
    private $outputFile = null;
=======
    private ?string $tempDir = null;
    private ?string $outputFile = null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /** {@inheritDoc} */
    public function setTempDir(string $tempDir)
    {
        $this->tempDir = $tempDir;
    }

    /** {@inheritDoc} */
    public function download(string $url): bool
    {
        $tempDir = $this->tempDir ?: \sys_get_temp_dir();
        $this->outputFile = \tempnam($tempDir, 'psysh-archive-');
        $targetName = $this->outputFile.'.tar.gz';

        if (!\rename($this->outputFile, $targetName)) {
            return false;
        }

        $this->outputFile = $targetName;

        return (bool) \file_put_contents($this->outputFile, \file_get_contents($url));
    }

    /** {@inheritDoc} */
    public function getFilename(): string
    {
<<<<<<< HEAD
=======
        if ($this->outputFile === null) {
            throw new RuntimeException('Call download() first');
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->outputFile;
    }

    /** {@inheritDoc} */
    public function cleanup()
    {
<<<<<<< HEAD
        if (\file_exists($this->outputFile)) {
=======
        if ($this->outputFile !== null && \file_exists($this->outputFile)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            \unlink($this->outputFile);
        }
    }
}
