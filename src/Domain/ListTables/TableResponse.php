<?php

namespace App\Domain\ListTables;

class TableResponse
{
    public function __construct(
        private string $tableName,
        private int $entries,
    ) {
    }

    public function tableName(): string
    {
        return $this->tableName;
    }

    public function  entries(): int
    {
        return $this->entries;
    }
}