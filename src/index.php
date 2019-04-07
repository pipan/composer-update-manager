<?php

require_once '../vendor/autoload.php';

ini_set('memory_limit', '256M');
$manager = new Lmn\ComposerUpdateManager\ComposerUpdateManager(
    new Lmn\ComposerUpdateManager\Storage\FileStorage([
        'file_path' => './storage/tmp/outdated_output.txt'
    ]), 
    new Lmn\ComposerUpdateManager\Application\Composer([
        'home' => __DIR__ . '/vendor/bin/composer',
        'root_path' => '../'
    ])
);

$manager->check();
echo $manager->getOutdatedCount();