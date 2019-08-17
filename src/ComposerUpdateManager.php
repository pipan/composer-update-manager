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

    public function checkAvailableUpdates()
    {
        $output = $this->application->listOutdated();
        $jsonResult = \json_decode($output);
        if ($jsonResult == null) {
            throw new \Exception("Checking available updates failed: '" . $output . "'");
        }
        $this->storage->write($output);
    }

    public function getOutdatedCount()
    {
        return count($this->getAvailableUpdates());
    }

    public function getAvailableUpdates()
    {
        $composerCliOutput = json_decode($this->storage->read(), true);
        if ($composerCliOutput == null || empty($composerCliOutput['installed'])) {
            return [];
        }
        $packages = [];
        foreach ($composerCliOutput['installed'] as $packageData) {
            $packages[] = new Package($packageData);
        }        
         return $packages;
    }

    public function update($package)
    {
        $this->application->update($package);
    }

    public function updateVersion($package, $version)
    {
        $this->application->update($package . ":" . $version);
    }
}