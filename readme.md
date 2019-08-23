# LaravelFortnite

[![StyleCI](https://github.styleci.io/repos/204002127/shield)](https://github.styleci.io/repos/204002127)
[![License](https://poser.pugx.org/elreco/laravelfortnite/license)](https://packagist.org/packages/elreco/laravelfortnite)
[![Monthly Downloads](https://poser.pugx.org/elreco/laravelfortnite/d/monthly)](https://packagist.org/packages/elreco/laravelfortnite)

This is a **Fortnite API** provider for **Laravel** using [FortniteAPI.com](https://fortniteapi.com). You can get user wins, kills, the latest news, fortnite server status and many more with this API.

Thanks to [samhoogantink](https://github.com/samhoogantink/Fortnite-API) for the PHP code.

## Installation

Via Composer

``` bash
$ composer require elreco/laravelfortnite
```

In your Laravel project root directory

## Usage

1) Add `'Elreco\LaravelFortnite\LaravelFortnite;'` to your Controller file

```
<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Elreco\LaravelFortnite\LaravelFortnite;
[...]
?>
```

2) Init a new LaravelFortnite object and set your api Key. You can have a key by rgistering on [FortniteAPI.com](https://fortniteapi.com)

```
<?php

$api = new LaravelFortnite;
$api->setKey("YOUR KEY");
?>
```

3) Get datas from the API

```
<?php
$api = new LaravelFortnite;
$api->setKey("YOUR KEY");

// get and user id
$data = $api->user->id('username');
?>
```
# Examples

You can build website like mine : [tracker.fortnitefrance.eu](https://tracker.fortnitefrance.eu)

1. Get an user id
```
<?php
$api = new LaravelFortnite;
$api->setKey("YOUR KEY");

$data = $api->user->id('username');

echo $data->uid;
echo $data->username;
?>
```

2. Get user stats **V2**
```
<?php
$api = new LaravelFortnite;
$api->setKey("YOUR KEY");

$api->user->uid = 'user_id';

$data = $api->user->stats('console', 'window');

dump($data);
?>
```

3. Get the daily store
```
<?php
$api = new LaravelFortnite;
$api->setKey("YOUR KEY");

$api = new FortniteClient;

$data = $api->items->store();

dump($data);
?>

```

4. Fortnite server status
```
<?php
$api = new LaravelFortnite;
$api->setKey("YOUR KEY");

$data = $api->status->fetch();

echo $data->status;
echo $data->message;
echo $data->version;
?>
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [elreco](https://github.com/elreco)
- [samhoogantink](https://github.com/samhoogantink)

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/elreco/laravelfortnite.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/elreco/laravelfortnite.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/elreco/laravelfortnite/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/elreco/laravelfortnite
[link-downloads]: https://packagist.org/packages/elreco/laravelfortnite
[link-travis]: https://travis-ci.org/elreco/laravelfortnite
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/elreco
[link-contributors]: ../../contributors
