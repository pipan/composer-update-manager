<?php
namespace Lmn\ComposerUpdateManager;

class Package
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getVersion(): string
    {
        return $this->data['version'];
    }

    public function getLatestVersion(): string
    {
        return $this->data['latest'];
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getDescription(): string
    {
        return $this->data['description'];
    }

    public function getLatestStatus(): string
    {
        return $this->data['latest-status'];
    }
}
