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

namespace Install\Composer;

use PHPUnit\Framework\TestCase;

/**
 * Class ScriptHandlerTest
 *
 * @package Install\Composer
 * @author  Benjamin Carl <opensource@clickalicious.de>
 */
class ScriptHandlerTest extends TestCase
{
    /**
     * @var \Composer\Script\Event
     */
    private $event;

    /**
     * @var \Composer\IO\IOInterface
     */
    private $io;

    /**
     * @var \Composer\Package\PackageInterface
     */
    private $package;

    protected function setUp()
    {
        parent::setUp();

        $this->event = $this->prophesize('Composer\Script\Event');
        $this->io = $this->prophesize('Composer\IO\IOInterface');
        $this->package = $this->prophesize('Composer\Package\PackageInterface');
        /* @var $composer \Composer\Composer */
        $composer = $this->prophesize('Composer\Composer');

        $composer->getPackage()->willReturn($this->package);
        $this->event->getComposer()->willReturn($composer);
        $this->event->getIO()->willReturn($this->io);
    }

    /**
     * @dataProvider provideInvalidConfiguration
     */
    public function testInvalidConfiguration(array $extras, $exceptionMessage)
    {
        $this->package->getExtra()->willReturn($extras);

        chdir(__DIR__);

        $this->setExpectedException('InvalidArgumentException', $exceptionMessage);

        ScriptHandler::install($this->event->reveal());
    }

    public function provideInvalidConfiguration()
    {
        return array(
            'no extra' => array(
                array(),
                'The parameter handler needs to be configured through the extra.incenteev-parameters setting.',
            ),
            'invalid type' => array(
                array('incenteev-parameters' => 'not an array'),
                'The extra.incenteev-parameters setting must be an array or a configuration object.',
            ),
            'invalid type for multiple file' => array(
                array('incenteev-parameters' => array('not an array')),
                'The extra.incenteev-parameters setting must be an array of configuration objects.',
            ),
            'no file' => array(
                array('incenteev-parameters' => array()),
                'The extra.incenteev-parameters.file setting is required to use this script handler.',
            ),
        );
    }
}
