<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Rng.
 *
 * Demo.php - Random number generator for PHP
 * Fallback mechanism implementation based on current best practice.
 *
 *
 * PHP versions 5.3
 *
 * LICENSE:
 * Rng - Random number generator for PHP
 *
 * Copyright (c) 2015, Benjamin Carl
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * - Neither the name of Rng nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * Please feel free to contact us via e-mail: opensource@clickalicious.de
 *
 * @category  Clickalicious
 *
 * @author    Benjamin Carl <opensource@clickalicious.de>
 * @copyright 2015 Benjamin Carl
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 *
 * @version   Git: $Id$
 *
 * @link      https://github.com/clickalicious/Rng
 */

/**
 * THE FOLLOWING REQUIRE IS ONLY REQUIRED AND RECOMMENDED IN DEVELOPMENT/FOR DEVELOPMENT OF Rng
 * IT DOES NOT ONLY INSTALL AN ADDITIONAL AUTOLOADER (IN ADDITION TO COMPOSER) IT ALSO ADJUST
 * THE DEBUG SETTINGS, ERROR-REPORTING AND THINGS LIKE THAT! SO DO NOT BOOTSTRAP IN PRODUCTION!
 */
require_once 'src/Clickalicious/Rng/Bootstrap.php';

/*
 * Default random number generating easily.
 * Generate a random number with best rng available
 * between 1 and 10:
 */
$generator = new Clickalicious\Rng\Generator();
$number    = $generator->generate(1, 10);
echo $number.PHP_EOL;


/*
 * Random number generating easily.
 * Generate a random number with PHP's default rng
 * between 1 and 10:
 */
$generator = new Clickalicious\Rng\Generator(Clickalicious\Rng\Generator::MODE_PHP_DEFAULT);
$number    = $generator->generate(1, 10);
echo $number.PHP_EOL;


/*
 * Random number generating easily.
 * Generate a random number with PHP's mersenne twister rng
 * between 1 and 10:
 */
$generator = new Clickalicious\Rng\Generator(Clickalicious\Rng\Generator::MODE_PHP_MERSENNE_TWISTER);
$number    = $generator->generate(1, 10);
echo $number.PHP_EOL;
