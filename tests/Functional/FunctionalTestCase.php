<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FunctionalTestCase extends KernelTestCase
{
    private const FIXTURE_DIRECTORY = __DIR__ . '/Fixtures/';

    protected static ?EntityManager $entityManager = null;

    protected function setUp(): void
    {
        if (self::$entityManager === null) {
            self::$entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        }
        self::$entityManager->beginTransaction();
    }

    protected function tearDown(): void
    {
        self::$entityManager->rollback();
    }

    protected function loadFixture(string $fixture): void
    {
        $file = self::FIXTURE_DIRECTORY . "$fixture";

        if (!file_exists($file)) {
            throw new FileNotFoundException("File does not exist: $file");
        }

        foreach(file($file) as $line) {
            self::$entityManager->getConnection()->executeQuery($line);
        }
        self::$entityManager->clear();
    }

    protected function getService(string $service): ?object
    {
        return self::getContainer()->get($service);
    }
}