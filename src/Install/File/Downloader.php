<?php

/**
 * Install
 *
 * (The MIT license)
 * Copyright 2017 clickalicious UG, Benjamin Carl
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
 * BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Install\File;

use Assert\Assertion;
use GuzzleHttp\Client;

/**
 * Class Downloader
 *
 * @package Install\File
 * @author  Benjamin Carl <opensource@clickalicious.de>
 */
class Downloader
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Downloader constructor.
     *
     * @param bool $ignoreSslCertificate TRUE to ignore SSL cert warnings, otherwise FALSE to do not.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     */
    public function __construct($ignoreSslCertificate = false)
    {
        $this->client = new Client(
            [
                'defaults' => [
                    'verify' => !$ignoreSslCertificate
                ]
            ]
        );
    }

    /**
     * download downloads a file from an URL to local filesystem with given name.
     *
     * @param string   $url                  URL to download from.
     * @param string   $destinationDirectory Destination directory for the downloaded file.
     * @param string   $destinationFilename  Destination filename for the downloaded file.
     * @param string   $temporaryDirectory   Temporary directory to write temporary file to.
     * @param string   $temporaryFilename    Temporary filename to write downloaded bytes to.
     * @param callable $callback             Callback function being executed on download progress.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @return bool|string TRUE on success, otherwise string containing error.
     */
    public function download(
        $url,
        $destinationDirectory,
        $destinationFilename,
        $temporaryDirectory,
        $temporaryFilename,
        $callback = null
    )
    {
        // Validate the given input
        try {
            Assertion::url($url);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        // Get destination filename from uri if not deifned ...
        if (null === $destinationFilename) {
            $uriParts            = explode('/', $url);
            $destinationFilename = array_pop($uriParts);
        }

        try {
            // try to download file and move it to final location
            $this->downloadFile($url, $temporaryDirectory.DIRECTORY_SEPARATOR.$temporaryFilename, $callback);
            $this->moveFile(
                $temporaryDirectory.DIRECTORY_SEPARATOR.$temporaryFilename,
                $destinationDirectory.DIRECTORY_SEPARATOR.$destinationFilename
            );

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return true;
    }

    /**
     * Downloads a file from an URL to a local file.
     *
     * @param string   $uri              URL of file being downloaded.
     * @param string   $filename         Filename + path the downloaed bytes are written to.
     * @param callable $progressCallback Optional callback for showing progress.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @return bool|string TRUE on successful download, otherwise error as string
     */
    protected function downloadFile($uri, $filename, callable $progressCallback = null)
    {
        if (null === $progressCallback) {
            $progressCallback = function () {
            };
        }

        $response = $this->client->request(
            'GET',
            $uri,
            [
                'sink'     => $filename,
                'progress' => $progressCallback,
            ]
        );

        $result = true;

        if (200 !== $response->getStatusCode()) {
            $result = $response->getReasonPhrase();
        }

        return $result;
    }

    /**
     * Moves a file from one location to another.
     *
     * @param string $source      Source filename + path.
     * @param string $destination Destination filename + path for move.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @throws \RuntimeException On file move errors.
     *
     */
    protected function moveFile($source, $destination)
    {
        if (true !== copy($source, $destination)) {
            throw new \RuntimeException(
                sprintf('Error copying file from "%s" to "%s"', $source, $destination)
            );
        }

        if (true === file_exists($source) && true === is_file($source) && false === is_dir($source)) {
            unlink($source);
        }
    }
}
