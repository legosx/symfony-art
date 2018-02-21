# Symfony Art

This project can output ASCII trees and stars both in the browser and in the command line

## Requirements

- Composer
- PHP 7.0
- PDO SQLite extension for PHP
- ZIP extension for PHP (only for tests)

## To Run:

~~~
composer install
~~~

During installation you will be asked about database and token.

You can keep these fields blank if default parameters are ok for you.

```
> Incenteev\ParameterHandler\ScriptHandler::buildParameters
Creating the "app/config/parameters.yml" file
Some parameters are missing. Please provide them.
database_path ('%kernel.project_dir%/var/data/data.sqlite'):
secret (ThisTokenIsNotSoSecretChangeIt):
```

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

Open http://localhost:8000 . Website will be working in dev environment.

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

To output a shape right in the browser open the main page:

http://localhost:8000

By default random shape is outputted.

If you want to output other shapes, use request parameters.

type - 1 or 2

size - 1, 2 or 3

For example, this url will output Large Tree:

http://localhost:8000/?type=2&size=3

### Command Line

To output a shape in command line just run the following command:

```
> php bin/console shape
   +
   X
+XXXXX+
   X
   +
``` 

By default random shape is outputted.

Another way to output a shape is to define parameters. You will see the shape immediately.
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

## List of my own files and modifications

Configuration files:

```
app/config/config.yml
app/config/parameters.yml.dist
app/AppKernel.php
composer.json
```

Views (twig format):

```
app/Resources/views/default/index.html.twig
app/Resources/views/base.html.twig
```

Models and Controllers:

```
src/AppBundle/Command/ShapeCommand.php
src/AppBundle/Controller/ShapeController.php
src/AppBundle/DataFixtures/ShapeFixtures.php
src/AppBundle/Entity/Shape.php
src/AppBundle/Repository/ShapeRepository.php
```

Tests (PHPUnit):

```
tests/AppBundle/Command/ShapeCommandTest.php
tests/AppBundle/Controller/ShapeControllerTest.php
```

Styles (CSS):

```
web/static/style.css
```
