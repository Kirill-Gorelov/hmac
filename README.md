# hmac
Класс для создания подписи массива и проверки отправителя

## composer
composer require hmac/hmac

## Как использовать

Пример в папке `example`

```php
require_once __DIR__.'/../src/php/hmac.php';
// use kirill\hmac;

$hmac = new kirill\hmac\Hmac;
// var_dump($hmac);

define('PUBLIC_KEY','test_key');
define('PRIVATE_KEY','test_key_private');

$arr = array('login'=>'My_login',
             'password'=>'My_pass',
             'email'=>'My_email');

$signature = $hmac->make_data_hmac($arr, PRIVATE_KEY);
var_dump($signature);
var_dump($hmac->check_data_hmac($arr, PRIVATE_KEY,$signature));
```
`make_data_hmac` - создает подпись, принимаю массив и закрытый ключ.  
`check_data_hmac`- проверят подпись, принимая массив, закрытый ключ и сгенерированную подпись для проверки.


## Пример на Python

Так же написан класс на python. Что бы можно было обмениваться подписями на двух языках. Пример и сак класс в папке `python/`

### пример

```python
hmac_p = Hmac()
r = hmac_p.make_data_hmac(arr,key)
print(r)

rez = hmac_p.check_data_hmac(arr,key,r)
print(rez)
```
