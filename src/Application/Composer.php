<?php

namespace Lmn\ComposerUpdateManager\Application;

use Composer\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class Composer implements ApplicationInterface {
    protected $application;

    public function __construct($config = [])
    {
        if (empty($config['home'])) {
            throw new \Exception("To run composer update manager, you have to set 'home' config variable");
        }
        putenv('COMPOSER_HOME=' . $config['home']);
        if (!empty($config['root_path'])) {
            chdir($config['root_path']);
        }

        $this->application = new Application();
        $this->application->setAutoExit(false);
    }

    public function listOutdated()
    {
        $input = new ArrayInput([
            'command' => 'outdated',
            '--direct' => true,
            '-f' => 'json'
        ]);
        $output = new BufferedOutput();
        $this->application->run($input, $output);
        return $output->fetch();
    }

    public function update(string $package)
    {
        $input = new ArrayInput([
            'command' => 'require',
            'packages' => [$package]
        ]);
        $output = new BufferedOutput();
        $result = $this->application->run($input, $output);
        if ($result !== 0) {
            throw new \Exception("update failed: " . $output->fetch());
        }
    }
}