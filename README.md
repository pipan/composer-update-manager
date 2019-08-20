# Composer Update Manager

[![Build Status](https://travis-ci.com/pipan/composer-update-manager.svg?branch=master)](https://travis-ci.com/pipan/composer-update-manager)

Check if your composer.lock is up to date. This class will produce a file of outdated packeges and provide number of outdated packages. You can also update specific packages

> I do not recomment updating packages in production

## Create Manager

This package comes with predefined factory for ComposerUpdateManager. This factory will create manager with file storage. Default settings are set for linux users.

```php
<?php
$managerFactory = new Lmn\ComposerUpdateManager\FileManagerFactory();
$manager = $managerFactory->createComposerUpdateManager();
```

## Get outdated packages for updates

Default file storage acts as a form of cache, so you can always ask for packages that are outdated. This list is not automaticaly refreshed. To refresh this list call `checkAvailableUpdates` method. Method `getAvailableUpdates` returns list of `Lmn\ComposerUpdateManager\Package`.

```php
<?php
$managerFactory = new Lmn\ComposerUpdateManager\FileManagerFactory();
$manager = $managerFactory->createComposerUpdateManager();

$available = $manager->getAvailableUpdates();
```

## Check for updates

To run packages check you have to call `->checkAvailableUpdates()` method. This will actually run `composer outdated --direct` if You use `Composer` as `ApplicationInterface`. This proces is a little bit time consuing, it can run for several minutes, so we recommend to run it in some kind of queue / background process.

```php
<?php
$managerFactory = new Lmn\ComposerUpdateManager\FileManagerFactory();
$manager = $managerFactory->createComposerUpdateManager();

$available = $manager->checkAvailableUpdates();
```

> Also worth to note, you may need to increase your `memory_limit` to `256M`

## Get outdated count

```php
<?php
$managerFactory = new Lmn\ComposerUpdateManager\FileManagerFactory();
$manager = $managerFactory->createComposerUpdateManager();

$available = $manager->getOutdatedCount();
```

## Create ComposerUpdateManager

To create the instance you have to provide a way of storing information about outdated packages. 

1. **StorageInterface** - We provide `FileStorage` that accepts config array with a `file_path`. This `file_path` is a file that will be used to store output of outdated packages. 
2. **ApplicationInterface** - the application that will chcek for outdated packages. We have `Composer` class as only option. This class requires 2 config values `home`, that is a variable for coposer command and `root_path`, that is a path to composer.json file.

> `home` is usualy set to `__DIR__ . '/vendor/bin/composer'`

### Example

```php
<?php
$manager = new Lmn\ComposerUpdateManager\ComposerUpdateManager(
    new Lmn\ComposerUpdateManager\Storage\FileStorage([
        'file_path' => './storage/tmp/outdated_output.txt'
    ]), 
    new Lmn\ComposerUpdateManager\Application\Composer([
        'home' => __DIR__ . '/vendor/bin/composer',
        'root_path' => '../'
    ])
);
?>
```