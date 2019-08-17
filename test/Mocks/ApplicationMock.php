<?php
namespace Lmn\ComposerUpdateManager\Test\Mocks;

use Lmn\ComposerUpdateManager\Application\ApplicationInterface;

final class ApplicationMock implements ApplicationInterface
{
    protected $outdated = "";

    public function setOutdated($outdated)
    {
        $this->outdated = $outdated;
    }

    public function listOutdated(): string
    {
        return $this->outdated;
    }

    public function update(string $package): void
    {

    }

}