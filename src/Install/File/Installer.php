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

use Install\File\Installer\InstallerFactory;

/**
 * Class Installer
 *
 * @package Install\File
 * @author  Benjamin Carl <opensource@clickalicious.de>
 */
class Installer
{
    /**
     * @var \Install\File\Installer\InstallerFactory
     */
    protected $installerFactory;

    /**
     * Installer constructor.
     *
     * @param \Install\File\Installer\InstallerFactory $installerFactory
     */
    public function __construct(InstallerFactory $installerFactory)
    {
        $this->installerFactory = $installerFactory;
    }

    /**
     * Installs a file by delegating install action to an OS dependent
     *
     * @param string $filename Name and path of the file being installed.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @return bool|string TRUE on success, otherwise string containing error message.
     */
    public function install($filename)
    {
        try {
            $osDependentInstaller = $this->installerFactory->create();
            $result = $osDependentInstaller->install($filename);

        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }
}
