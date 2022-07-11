<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220711114721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Base';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE users (
                `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `username` VARCHAR(255) UNIQUE NOT NULL,
                `password` VARCHAR(255) NOT NULL
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
