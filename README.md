# PHP Autoloaders: A Deep Dive

## Lesson 0: Using `spl_autoload_register`

In this example, we will use the PHP function `spl_autoload_register` to require
files from the local path.

## Lesson 1: Using `spl_autoload_register` with namespaces

In this example, we will use the same function with a little more nuance.

## Lesson 2: Using `spl_autoload_register` selectively

In this example, we will set up an autoloader to load from our own namespace and only
our own namespace, providing an independent autoloader that can exist alongside others.

## Lesson 3: Using `spl_autoload_register` with Composer dependencies

In this example, we will set up two autoloading functions for two specific dependencies,
which have been added to our project using Composer.

## Lesson 4: Writing our own PSR-4 compliant Composer autoloader

In this example, we will set up two autoloading functions for any depdencies that support
PSR-4 autoloading.

### [the PSR-4 spec](https://www.php-fig.org/psr/psr-4/)

The specification, as written:

> 1. The term “class” refers to classes, interfaces, traits, and other similar structures.
> 1. A fully qualified class name has the following form:
>    `\<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>`
>    1. The fully qualified class name MUST have a top-level namespace name, also known as a “vendor namespace”.
>    1. The fully qualified class name MAY have one or more sub-namespace names.
>    1. The fully qualified class name MUST have a terminating class name.
>    1. Underscores have no special meaning in any portion of the fully qualified class name.
>    1. Alphabetic characters in the fully qualified class name MAY be any combination of lower case and upper case.
>    1. All class names MUST be referenced in a case-sensitive fashion.
> 1. When loading a file that corresponds to a fully qualified class name …
>    1. A contiguous series of one or more leading namespace and sub-namespace names, not including the leading namespace separator, in the fully qualified class name (a “namespace prefix”) corresponds to at least one “base directory”.
>    1. The contiguous sub-namespace names after the “namespace prefix” correspond to a subdirectory within a “base directory”, in which the namespace separators represent directory separators. The subdirectory name MUST match the case of the sub-namespace names.
>    1. The terminating class name corresponds to a file name ending in .php. The file name MUST match the case of the terminating class name.
> 1. Autoloader implementations MUST NOT throw exceptions, MUST NOT raise errors of any level, and SHOULD NOT return a value.

## Lesson 5: Understanding the Composer autoloader

Consider [`autoload_static.php`](./4-composer-class/vendor/composer/autoload_static.php).
This is a generated file with some prefix directories so that the autoloader doesn't
need to read from disk every time it loads.

```php
    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php73\\' =>
        [
            __DIR__ . '/..' . '/symfony/polyfill-php73'
        ],
        'Symfony\\Polyfill\\Mbstring\\' => [
            __DIR__ . '/..' . '/symfony/polyfill-mbstring'
        ],
        'Symfony\\Contracts\\Service\\' => [
            __DIR__ . '/..' . '/symfony/service-contracts'
        ],
        'Symfony\\Component\\Debug\\' => [
            __DIR__ . '/..' . '/symfony/debug',
        ],
        'Symfony\\Component\\Console\\' => [
            __DIR__ . '/..' . '/symfony/console',
        ],
        'Psr\\Log\\' => [
            __DIR__ . '/..' . '/psr/log/Psr/Log',
        ],
    );
```
