<?php

namespace Lmn\ComposerUpdateManager\Application;

interface ApplicationInterface {
    public function listOutdated();
    public function update($package);
}