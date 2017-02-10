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
 *
 * @package    Install
 * @subpackage Install\Console
 */

namespace Install\Console\Helper;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class ProgressbarFactory
 *
 * @package Install\Console\Helper
 * @author  Benjamin Carl <opensource@clickalicious.de>
 */
class ProgressbarFactory
{
    /**
     * Creates callbacks for displaying a progressbar.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @return callable Progressbar callback
     */
    public function create(OutputInterface $output)
    {
        /**
         * @param int $downloadBytesTotal       Total number of bytes to transfer.
         * @param int $downloadBytesTransferred Number of bytes actually transferred.
         */
        return function (
            $downloadBytesTotal,
            $downloadBytesTransferred
        ) use ($output) {

            static $progressBar;

            if (null === $progressBar && $downloadBytesTotal > 0) {
                $progressBar = new ProgressBar($output, $downloadBytesTotal);
                $progressBar->start();

            } elseif (null !== $progressBar) {
                $progressBar->setProgress($downloadBytesTransferred);

                if ($downloadBytesTransferred >= $downloadBytesTotal) {
                    $progressBar->finish();
                }
            }
        };
    }
}
