<?php

namespace Lmn\ComposerUpdateManager;

use Lmn\ComposerUpdateManager\Storage\StorageInterface;
use Lmn\ComposerUpdateManager\Application\ApplicationInterface;

class ComposerUpdateManager {
    protected $storage;
    protected $application;
    protected $config;

    public function __construct(StorageInterface $storage, ApplicationInterface $application)
    {
        $this->storage = $storage;
        $this->application = $application;
    }

    public function check()
    {
        $output = $this->application->run();
        $this->storage->write($output);
    }

    public function getOutdatedCount()
    {
        $outdatedContent = $this->storage->read();
        return \substr_count($outdatedContent, PHP_EOL);
    }
}