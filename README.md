# Symfony Art

This project can output ASCII trees and stars both in the browser and in the command line

## To Run:

~~~
composer install
~~~

Create DB:

~~~
php bin/console doctrine:database:create
~~~

Create tables:

~~~
php bin/console doctrine:schema:create
~~~

Import data:

~~~
php bin/console doctrine:fixtures:load
~~~

Run server:

~~~
php bin/console server:run
~~~

Open http://localhost:8000 . Blog will be working in dev environment.

If you want to run the project in production environment you should configure your web-server:
https://symfony.com/doc/3.4/setup/web_server_configuration.html

## Output

Two different type of shapes in three different sizes are provided.

Shapes:
1. Star.
2. Tree.

Sizes:
1. Small.
2. Medium.
3. Large.

### Browser

To output shape right in the browser open the main page:
http://localhost:8000

By default Medium Star is outputed.

If you want to output other shapes, use request parameters.

type - 1 or 2

size - 1, 2 or 3

For example, this url will output Large Tree:

http://localhost:8000

http://symfony-art/?type=2&size=3

### Command Line

#### Ask for input
Just execute following in the command line and command asks you about parameters:

```
php bin/console shape
```

For example it gives you following:

```
> php bin/console shape

 Type [Star]:
  [1] Star
  [2] Tree
 > 2

 Size [Medium]:
  [1] Small
  [2] Medium
  [3] Large
 > 2

     +
     X
    XXX
   XXXXX
  XXXXXXX
 XXXXXXXXX
XXXXXXXXXXX
```

#### Define parameters explicitly

Another way to show you a shape is define parameters. You will see the shape immediately.
For example:

```
> php bin/console shape --type=1 --size=1
   +
   X
+XXXXX+
   X
   +
```

## Tests

Execute this command to run tests:

```
./vendor/bin/simple-phpunit
```