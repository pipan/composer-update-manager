<?php
namespace Lmn\ComposerUpdateManager;

class Package
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getVersion()
    {
        return $this->data['version'];
    }

    public function getLatestVersion()
    {
        return $this->data['latest'];
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getLatestStatus()
    {
        return $this->data['latest-status'];
    }
}
