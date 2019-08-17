<?php

namespace Lmn\ComposerUpdateManager\Application;

interface ApplicationInterface {
    public function listOutdated(): string;
    public function update(string $package): void;
}