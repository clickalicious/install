<img src="https://avatars2.githubusercontent.com/u/514566?v=3&u=4615dfc4970d93dea5d3eaf996b7903ee6e24e20&s=140" align="right" />
---

![Logo of Install](docs/logo-large.png)  

The deployment **installer** for binaries, phar's or shell and batch scripts.

| [![Build Status](https://travis-ci.org/clickalicious/Rng.svg?branch=master)](https://travis-ci.org/clickalicious/Rng) 	| [![Scrutinizer](https://img.shields.io/scrutinizer/g/clickalicious/Rng.svg)](https://scrutinizer-ci.com/g/clickalicious/Rng/) 	| [![Code Coverage](https://scrutinizer-ci.com/g/clickalicious/Rng/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/clickalicious/Rng/?branch=master) 	| [![clickalicious open source](https://img.shields.io/badge/clickalicious-open--source-green.svg?style=flat)](https://www.clickalicious.de/) 	|
|---	|---	|---	|---	|
| [![GitHub release](https://img.shields.io/github/release/clickalicious/Rng.svg?style=flat)](https://github.com/clickalicious/Rng/releases) 	| [![Waffle.io](https://img.shields.io/waffle/label/clickalicious/Rng/in%20progress.svg)](https://waffle.io/clickalicious/Rng)  	| [![SensioLabsInsight](https://insight.sensiolabs.com/projects/29d1f47a-0deb-47f0-9642-671bebb04795/mini.png)](https://insight.sensiolabs.com/projects/29d1f47a-0deb-47f0-9642-671bebb04795) 	| [![Packagist](https://img.shields.io/packagist/l/clickalicious/CachingMiddleware.svg?style=flat)](https://opensource.org/licenses/BSD-3-Clause)  	|


## Table of Contents

- [Features](#features)
- [Example](#example)
- [Requirements](#requirements)
- [Philosophy](#philosophy)
- [Versioning](#versioning)
- [Roadmap](#roadmap)
- [Security-Issues](#security-issues)  
- [License »](LICENSE)  


## Features

 - High performance (developed using a profiler)
 - Lightweight and high-quality codebase (following PSR standards e.g. `PSR-0,1,4`)
 - Secure `PRNG` implementation (64-Bit support)
 - OOP facade to PHP core functionality
 - PHP 7.0 & HHVM ready
 - Stable, clean + well documented code
 - Unit-tested with a good coverage


## Example

Generate random number between 1 and 10 with `OpenSSL` random bytes (library default):
```php
$generator = new Clickalicious\Rng\Generator();
$number    = $generator->generate(1, 10);
echo $number;
```

Generate random number between 1 and 10 with `MCrypt` random bytes:
```php
$generator = new Clickalicious\Rng\Generator(Clickalicious\Rng\Generator::MODE_MCRYPT);
$number    = $generator->generate(1, 10);
echo $number;
```

### Visualization

You can create a visualization of randomization (as you can see below but larger size) through `Visual.php` (the file is located in root).

![Logo of Rng](docs/visualization.png)  


## Requirements

 - `PHP >= 5.4` (compatible up to version 5.6 as well as 7.x and HHVM)


## Philosophy

This library provides a state of the art `PRNG` (**P**seudo **R**andom **N**umber **G**enerator) implementation to generate secure `Pseudo Random Numbers` with PHP. The generation is either based on `Open SSL` or `MCrypt` or as fallback on PHP's internal functionality. The library also provides a very good `Seed generator` on puplic API. If you are interested in the difference between real and pseduo randomness then you could start at [https://www.random.org/randomness/](https://www.random.org/randomness/ "https://www.random.org/randomness/").

[![Scott Adams](https://qph.is.quoracdn.net/main-qimg-1eb4e01051c9e28611ff9e9be84bef5d?convert_to_webp=true)](http://dilbert.com/strip/2001-10-25 "Copyright Universal Uclick / Scott Adams")


## Versioning

For a consistent versioning i decided to make use of `Semantic Versioning 2.0.0` http://semver.org. Its easy to understand, very common and known from many other software projects.


## Roadmap

- [x] Target stable release `1.0.0`
- [x] `>= 90%` test coverage
- [x] Better visualization
- [x] Integrate polyfill
- [ ] Security check through 3rd-Party (Please get in contact with me)

[![Throughput Graph](https://graphs.waffle.io/clickalicious/Rng/throughput.svg)](https://waffle.io/clickalicious/Rng/metrics)


## Security Issues

If you encounter a (potential) security issue don't hesitate to get in contact with us `opensource@clickalicious.de` before releasing it to the public. So i get a chance to prepare and release an update before the issue is getting shared. Thank you!


## Participate & Share

... yeah. If you're a code monkey too - maybe we can build a force ;) If you would like to participate in either **Code**, **Comments**, **Documentation**, **Wiki**, **Bug-Reports**, **Unit-Tests**, **Bug-Fixes**, **Feedback** and/or **Critic** then please let me know as well!
<a href="https://twitter.com/intent/tweet?hashtags=&original_referer=http%3A%2F%2Fgithub.com%2F&text=Rng%20-%20Random%20number%20generator%20for%20PHP%20%40phpfluesterer%20%23Rng%20%23php%20https%3A%2F%2Fgithub.com%2Fclickalicious%2FRng&tw_p=tweetbutton" target="_blank">
  <img src="http://jpillora.com/github-twitter-button/img/tweet.png"></img>
</a>

## Sponsors

Thanks to our sponsors and supporters:  

| JetBrains | Navicat |
|---|---|
| <a href="https://www.jetbrains.com/phpstorm/" title="PHP IDE :: JetBrains PhpStorm" target="_blank"><img src="https://resources.jetbrains.com/assets/media/open-graph/jetbrains_250x250.png" height="55"></img></a> | <a href="http://www.navicat.com/" title="Navicat GUI - DB GUI-Admin-Tool for MySQL, MariaDB, SQL Server, SQLite, Oracle & PostgreSQL" target="_blank"><img src="http://upload.wikimedia.org/wikipedia/en/9/90/PremiumSoft_Navicat_Premium_Logo.png" height="55" /></a>  |


###### Copyright
<div>Icons made by <a href="http://www.flaticon.com/authors/google" title="Google">Google</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
