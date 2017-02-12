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

namespace Install\File\Installer;

/**
 * Class InstallerFactory
 *
 * @package Install\File\Installer
 * @author  Benjamin Carl <opensource@clickalicious.de>
 */
class InstallerFactory
{
    /**
     * @var string
     */
    protected $operatingSystem;

    /**
     * Used for OS detection linux.
     *
     * @var string
     */
    const OS_LINUX = 'linux';

    /**
     * InstallerFactory constructor.
     *
     * @param string $operatingSystem
     */
    public function __construct($operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * Creates and returns operating specific installer instance.
     *
     * @author Benjamin Carl <opensource@clickalicious.de>
     *
     * @return InstallerInterface
     *
     * @throws InstallerNotAvailableException
     */
    public function create()
    {
        switch ($this->operatingSystem) {
            case self::OS_LINUX:
                $installer = new LinuxInstaller();
                break;

            default:
                throw new InstallerNotAvailableException(
                    sprintf('The operating system "%s" is currently not supported.', $this->operatingSystem)
                );
                break;
        }

        return $installer;
    }
}
