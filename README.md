[![Build Status](https://travis-ci.org/MITLibraries/mitlib-courtyard.svg)](https://travis-ci.org/MITLibraries/mitlib-courtyard)
[![Code Climate](https://codeclimate.com/github/MITLibraries/mitlib-courtyard/badges/gpa.svg)](https://codeclimate.com/github/MITLibraries/mitlib-courtyard)

Mitlib-Courtyard
======

Mitlib-Courtyard is a base WordPress theme for use on internal projects at the MIT Libraries. It has been created by [Matt Bernhardt](https://github.com/matt-bernhardt) from the [\_strap](https://github.com/ptbello/_strap) starter theme.

## A note for developers and contributors:

Pull requests are evaluated by Travis-CI for syntax errors and security flaws using relevant sections of the WordPress Coding Standards. They are also evaluated by CodeClimate using static code analysis and linting provided by PHPCS and PHPMD. We expect that contributors are running those tools locally, or otherwise ensuring that pull requests conform to those standards. We have included the `codesniffer.local.xml` configuration for local use, which is typically invoked by the following command:

```
phpcs -psvn . --standard=./codesniffer.local.xml --extensions=php --report=source --report=full
```
