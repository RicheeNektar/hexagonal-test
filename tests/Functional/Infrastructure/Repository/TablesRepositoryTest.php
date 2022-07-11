<?php

namespace App\Tests\Functional\Infrastructure\Repository;

use App\Domain\ListTables\TableRequest;
use App\Infrastructure\Repository\TablesRepository;
use App\Tests\Functional\FunctionalTestCase;

class TablesRepositoryTest extends FunctionalTestCase
{
    private TablesRepository $tablesRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tablesRepository = self::getService(TablesRepository::class);
    }

    private function createRequest(string $tableName): TableRequest
    {
        return new TableRequest($tableName);
    }

    public function testWithoutEntries(): void
    {
        $response = $this->tablesRepository->countEntries($this->createRequest('users'));
        $this->assertEquals($response->entries(), 0);
    }

    public function testWithEntry(): void
    {
        $this->loadFixture('test_user.sql');
        $response = $this->tablesRepository->countEntries($this->createRequest('users'));
        $this->assertEquals($response->entries(), 1);
    }
}