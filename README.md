## Simple Auth
[![Latest Version](https://img.shields.io/github/v/release/ryodevz/simple-auth.svg?style=flat-square)](https://github.com/ryodevz/simple-auth/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/ryodevz/simple-auth.svg?style=flat-square)](https://packagist.org/packages/ryodevz/simple-auth)

## Requirements

- PHP ^7.3

## Features

- Login (customization)

## Installing simple-auth

The recommended way to install simple-auth is through
[Composer](https://getcomposer.org/).

```bash
composer require ryodevz/simple-auth
```

# Config

**config/simpleauth.php**
```
return [
    'auth' => [
        'login' => [
            'base' => '/login.php',
            'fields' => [
                'btnLogin' => 'btn-login',
                'username' => 'username',
                'password' => 'password'
            ],
            'redirect' => [
                'success' => '/',
            ],
            'password_hash' => false
        ]
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => null,
        'database' => 'root',
        'users_table' => [
            'table' => 'users',
            'username' => 'email',
            'password' => 'password',
        ]
    ],
];
```