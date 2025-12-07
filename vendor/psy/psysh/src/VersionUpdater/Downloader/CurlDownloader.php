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

use Psy\Exception\ErrorException;
<<<<<<< HEAD
=======
use Psy\Exception\RuntimeException;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\Shell;
use Psy\VersionUpdater\Downloader;

class CurlDownloader implements Downloader
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

        $outputHandle = \fopen($this->outputFile, 'w');
        if (!$outputHandle) {
            return false;
        }
        $curl = \curl_init();
        \curl_setopt_array($curl, [
            \CURLOPT_FAILONERROR    => true,
            \CURLOPT_HEADER         => 0,
            \CURLOPT_FOLLOWLOCATION => true,
            \CURLOPT_TIMEOUT        => 10,
            \CURLOPT_FILE           => $outputHandle,
            \CURLOPT_HTTPHEADER     => [
                'User-Agent' => 'PsySH/'.Shell::VERSION,
            ],
        ]);
        \curl_setopt($curl, \CURLOPT_URL, $url);
        $result = \curl_exec($curl);
        $error = \curl_error($curl);
<<<<<<< HEAD
        \curl_close($curl);
=======
        if (\PHP_VERSION_ID < 80000) {
            \curl_close($curl);
        }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        \fclose($outputHandle);

        if (!$result) {
            throw new ErrorException('cURL Error: '.$error);
        }

        return (bool) $result;
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
