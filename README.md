# PlaceIt - a simple placeholding service app

[![Code Climate](https://codeclimate.com/github/CodeBrauer/PlaceIt/badges/gpa.svg)](https://codeclimate.com/github/CodeBrauer/PlaceIt)

![bildschirmfoto 2016-11-16 um 14 46 47](https://cloud.githubusercontent.com/assets/2059754/20349643/9a2550a0-ac0b-11e6-97ab-1825eb5eae58.png)

# Installation

1. `git clone https://github.com/CodeBrauer/PlaceIt.git`
2. `cd PlaceIt && git checkout 1.0`
3. `composer install`
4. Ready to go!

Note: On nginx you need to define something like [this](http://stackoverflow.com/a/12931128/1990745)

# Usage

As seen on the screenshot there are multiple routes you can call so the script renders you the image you requested.

You can also edit the `config/config.php`, where the constans and comments should explain itself.


# Powered by:

* [Slim](http://www.slimframework.com/) by Josh Lockhart (codeguy)
* [Slim-Views](https://github.com/codeguy/Slim-Views) by Josh Lockhart (codeguy)
* [Twig](http://twig.sensiolabs.org/) by the Twig Team
