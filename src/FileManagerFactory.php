<?php
namespace Lmn\ComposerUpdateManager;

use Lmn\ComposerUpdateManager\Storage\FileStorage;
use Lmn\ComposerUpdateManager\Application\Composer;

class FileManagerFactory implements ManagerFactory
{
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config + [
            'fileStorage' => [
                'dir' => './storage/tmp/',
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
            new FileStorage([
                'file_path' => $this->config['fileStorage']['dir'] . 'outdated_output.json'
            ]), 
            new Composer($this->config['composer'])
        );
    }
}
