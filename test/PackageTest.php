<?php
namespace Lmn\ComposerUpdateManager\Test;

use PHPUnit\Framework\TestCase;
use Lmn\ComposerUpdateManager\Package;

final class PackageTest extends TestCase
{
    public function testPackageName()
    {
        $package = new Package([
            'name' => 'test/test'
        ]);
        $this->assertEquals('test/test', $package->getName());
    }

    public function testPackageVersion()
    {
        $package = new Package([
            'version' => '1.0.0'
        ]);
        $this->assertEquals('1.0.0', $package->getVersion());
    }

    public function testPackageLatestVersion()
    {
        $package = new Package([
            'latest' => '1.2.3'
        ]);
        $this->assertEquals('1.2.3', $package->getLatestVersion());
    }

    public function testPackageLatestStatus()
    {
        $package = new Package([
            'latest-status' => 'stable'
        ]);
        $this->assertEquals('stable', $package->getLatestStatus());
    }

    public function testPackageDescription()
    {
        $package = new Package([
            'description' => 'package description'
        ]);
        $this->assertEquals('package description', $package->getDescription());
    }
}
