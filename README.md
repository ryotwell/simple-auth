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
> composer require ryodevz/simple-auth
```

## Configuration

**config/simpleauth.php**
```
<?php

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

### Start session
```
Auth::sessionStart()
```

### Example usage
**login.php**
````
<?php

use Ryodevz\Auth;

include 'vendor/autoload.php';

Auth::sessionStart();
Auth::login();

if (Auth::user()->username) {
    return header('location: /');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <small style="color: red;"><?= Auth::error() ?></small>

    <form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" placeholder="Password"></td>
            </tr>
        </table>
        <button type="submit" name="btn-login" value="true">Login</button>
    </form>

</body>

</html>
````