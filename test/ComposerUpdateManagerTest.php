<?php
namespace Lmn\ComposerUpdateManager\Test;

use PHPUnit\Framework\TestCase;
use Lmn\ComposerUpdateManager\ComposerUpdateManager;
use Lmn\ComposerUpdateManager\Test\Mocks\StorageMock;
use Lmn\ComposerUpdateManager\Test\Mocks\ApplicationMock;
use Lmn\ComposerUpdateManager\Package;

final class ComposerUpdateManagerTest extends TestCase
{
    protected $updateManager;
    protected $application;
    protected $storage;

    public function setUp()
    {
        $this->storage = new StorageMock();
        $this->application = new ApplicationMock();
        $this->updateManager = new ComposerUpdateManager($this->storage, $this->application);
    }

    public function testCheckingForUpdateWritesOutputToFile()
    {
        $this->application->setOutdated('{"test": "value"}');
        $this->updateManager->checkAvailableUpdates();
        $this->assertEquals('{"test": "value"}', $this->storage->read());
    }

    public function testCheckingForUpdateFailesIfOutputIsNotJson()
    {
        $this->expectException(\Exception::class);

        $this->application->setOutdated('Not Json');
        $this->updateManager->checkAvailableUpdates();
    }

    public function testGetAvailableUpdates()
    {
        $this->application->setOutdated(json_encode([
            'installed' => [
                [
                    'name' => 'test/test',
                    'version' => '1.0.0',
                    'latest' => '1.2.3',
                    'latest-status' => 'stable',
                    'description' => 'test description'
                ]
            ]
        ]));
        $this->updateManager->checkAvailableUpdates();
        $this->assertEquals(1, $this->updateManager->getOutdatedCount());
        $this->assertCount(1, $this->updateManager->getAvailableUpdates());
        $this->assertCount(1, $this->updateManager->getAvailableUpdates());
        $packages = $this->updateManager->getAvailableUpdates();
        $this->assertInstanceOf(Package::class, $packages[0]);
        $this->assertPackage([
            'name' => 'test/test',
            'version' => '1.0.0',
            'latest' => '1.2.3',
            'latest-status' => 'stable',
            'description' => 'test description'
        ], $packages[0]);
    }

    private function assertPackage($data, $package)
    {
        $this->assertEquals($data['name'], $package->getName());
        $this->assertEquals($data['version'], $package->getVersion());
        $this->assertEquals($data['latest'], $package->getLatestVersion());
        $this->assertEquals($data['latest-status'], $package->getLatestStatus());
        $this->assertEquals($data['description'], $package->getDescription());
    }
}
