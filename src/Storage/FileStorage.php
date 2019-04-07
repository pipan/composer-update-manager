<?php

namespace Lmn\ComposerUpdateManager\Storage;

class FileStorage implements StorageInterface {
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config;

        if (empty($config['file_path'])) {
            throw new \Exception("File path is not set in gonfig value 'file_path'.");
        }
    }

    public function write($value)
    {
        $file = \fopen($this->getFileName(), "w");
        if ($file === false) {
            throw new \Exception("File cannot be opened in '" . $this->getFileName() ."'");
        }
        \fwrite($file, $value);
        \fclose($file);
    }

    public function read()
    {
        return \file_get_contents($this->getFileName());
    }

    protected function getFileName()
    {
        return $this->config['file_path'];
    }
}