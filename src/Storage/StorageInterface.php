<?php

namespace Lmn\ComposerUpdateManager\Storage;

interface StorageInterface {
    public function write($value);
    public function read();
}