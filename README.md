# Composer Update Manager

Check if your composer.lock is up to date. This class will produce a file of outdated packeges and provide number of outdated packages.

## Usage

## Create ComposerUpdateManager

To create the instance you have to provide a way of storing information about outdated packages. 

1. **StorageInterface** - We provide `FileStorage` that accepts config array with a `file_path`. This `file_path` is a file that will be used to store output of outdated packages. 
2. **ApplicationInterface** - the application that will chcek for outdated packages. We have `Composer` class as only option. This class requires 2 config values `home`, that is a variable for coposer command and `root_path`, that is a path to composer.json file.

> `home` is usualy set to `__DIR__ . '/vendor/bin/composer'`

### check

To run packages check you have to call `->check()` method. This will actually run `composer outdated --direct` if You use `Composer` as `ApplicationInterface`. This proces is a little bit time consuing, it can run for several tens of minutes, so we recommend to run it in some kind of queue.

> Also worth to note, you may need to increase your `memory_limit` to `256M`

### getOutdatedCount

To recieve the number of outdated packegas run `->getOutdatedCount()`. It will process reviously generated file and output the number of outdated packages.

> If this number is  not equal to actula outdated packages, than you shoul check file that is used to store outdated packages. It may contain some `warnings` produced by composer. Try to resolve those warnings and everything should be fine.

## Example

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