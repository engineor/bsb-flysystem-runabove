# Bridge for Flysystem Adapter for ~~Runabove~~ **OVH** Object Storage on BsbFlysystem (ZF2).

[![Author](http://img.shields.io/badge/author-@tdutrion-blue.svg?style=flat-square)](https://twitter.com/tdutrion)
[![Build Status](https://img.shields.io/travis/engineor/bsb-flysystem-runabove/master.svg?style=flat-square)](https://travis-ci.org/engineor/bsb-flysystem-runabove)
[![Coverage Status](https://coveralls.io/repos/engineor/bsb-flysystem-runabove/badge.svg?branch=master&service=github&style=flat-square)](https://coveralls.io/github/engineor/bsb-flysystem-runabove?branch=master)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/engineor/bsb-flysystem-runabove.svg?style=flat-square)](https://packagist.org/packages/engineor/bsb-flysystem-runabove)
[![Total Downloads](https://img.shields.io/packagist/dt/engineor/bsb-flysystem-runabove.svg?style=flat-square)](https://packagist.org/packages/engineor/bsb-flysystem-runabove)


## Installation

```bash
composer require engineor/bsb-flysystem-runabove
```

Add the module to your `application.config.php`:

```php
return [
    'modules' => [
        ...
        'BsbFlysystem',
        'Engineor\\Flysystem', // ADD THIS LINE
        'Application',
        ...
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
```

## Usage

**See configuration section on [flysystem-runabove](https://github.com/engineor/flysystem-runabove) for credential details.**

```php
<?php

use Engineor\Flysystem\Runabove;

return [
    'bsb_flysystem' => [
        'adapters' => [
            'runabove'     => [
                'type'    => 'runabove',
                'options' => [
                    'username'  => ':username',
                    'password'  => ':password',
                    'tenantId'  => ':tenantId',
                    'container' => 'flysystem',
                    'region'    => Runabove::REGION_EUROPE, // optional
                    'identity_endpoint' => Runabove::IDENTITY_ENDPOINT, // optional
                ],
            ],
        ],
        'filesystems' => [
        'default' => [
            'adapter' => 'runabove',
            'plugins' => [
                'League\Flysystem\Plugin\ListFiles',
            ],
        ],
    ],
];
```

**Because of a service migration, the Object Storage should now be used on OVH public cloud.**
Please use `https://auth.cloud.ovh.net/v2.0` as `identity_endpoint` values. Your `region` should be either `SBG1`, `GRA1` or `BHS1`.
