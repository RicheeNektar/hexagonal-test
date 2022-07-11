<?php

namespace App\Domain\ListTables;

class TableRequest
{
    public function __construct(
        private string $tableName
    ) {
    }

    public function tableName(): string
    {
        return $this->tableName;
    }
}