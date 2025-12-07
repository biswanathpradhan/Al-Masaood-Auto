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
use Psy\VersionUpdater\Downloader;

class Factory
{
    /**
     * @throws ErrorException If no downloaders can be used
     */
    public static function getDownloader(): Downloader
    {
        if (\extension_loaded('curl')) {
            return new CurlDownloader();
        } elseif (\ini_get('allow_url_fopen')) {
            return new FileDownloader();
        }
        throw new ErrorException('No downloader available.');
    }
}
