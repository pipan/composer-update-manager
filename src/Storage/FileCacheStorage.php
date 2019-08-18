<?php
namespace Lmn\ComposerUpdateManager;

use Lmn\ComposerUpdateManager\Storage;

class FileCacheStorage implements Storage
{
    protected $fileStorage;
    protected $config;

    public function __construct($fileStorage, $config = [])
    {
        $this->fileStorage = $fileStorage;
        $this->config = $config;

        if (empty($config['length'])) {
            throw new \Exception("Length is not set in gonfig value 'length'.");
        }
    }

    public function read()
    {
        $this->read();
    }

    public funtion write($data)
    {

    }
}