<?php
namespace Lmn\ComposerUpdateManager\Test\Mocks;

use Lmn\ComposerUpdateManager\Storage\StorageInterface;

final class StorageMock implements StorageInterface
{
    protected $data;

    public function read()
    {
        return $this->data;
    }

    public function write($data)
    {
        $this->data = $data;
    }
}