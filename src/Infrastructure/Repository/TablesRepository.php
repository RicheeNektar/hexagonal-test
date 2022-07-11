<?php

namespace App\Infrastructure\Repository;

use App\Domain\ListTables\TableRequest;
use App\Domain\ListTables\TableResponse;
use App\Domain\ListTables\ITablesRepository;
use Doctrine\DBAL\Connection;

class TablesRepository implements ITablesRepository
{
    public function __construct(
        private Connection $connection
    ) {
    }

    function countEntries(TableRequest $request): TableResponse
    {
        $count = $this->connection->createQueryBuilder()->addSelect('COUNT(1)')->from($request->tableName())->executeQuery()->fetchOne();

        return new TableResponse($request->tableName(), $count);
    }
}