<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221195510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo DROP user, CHANGE date_creation date_creation DATETIME DEFAULT \'1970-01-02\' NOT NULL, CHANGE date_due date_due DATETIME DEFAULT \'1970-01-02\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo ADD user VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'0\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_creation date_creation DATETIME DEFAULT \'1970-01-02 00:00:00\' NOT NULL, CHANGE date_due date_due DATETIME DEFAULT \'1970-01-02 00:00:00\' NOT NULL');
    }
}
