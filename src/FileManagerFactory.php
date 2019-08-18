<?php
namespace Lmn\ComposerUpdateManager;

use Lmn\ComposerUpdateManager\Storage\FileStorage;
use Lmn\ComposerUpdateManager\Application\Composer;

class FileManagerFactory
{
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config + [
            'fileStorage' => [
                'file_path' => './storage/tmp/outdated_output.json',
            ],
            'composer' => [
                'home' => '~/.composer',
                'root_path' => '../'
            ]
        ];
    }

    public function createComposerUpdateManager()
    {
        return new ComposerUpdateManager(
            new FileStorage($this->config['fileStorage']), 
            new Composer($this->config['composer'])
        );
    }
}
