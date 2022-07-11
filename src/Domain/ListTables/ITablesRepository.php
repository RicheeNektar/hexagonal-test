<?php

namespace App\Domain\ListTables;

interface ITablesRepository {
    function countEntries(TableRequest $request): TableResponse;
}