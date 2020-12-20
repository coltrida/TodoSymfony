<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220205400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE citizen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citizen_city (citizen_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_605EC735A63C3C2E (citizen_id), INDEX IDX_605EC7358BAC62AF (city_id), PRIMARY KEY(citizen_id, city_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE citizen_city ADD CONSTRAINT FK_605EC735A63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE citizen_city ADD CONSTRAINT FK_605EC7358BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citizen_city DROP FOREIGN KEY FK_605EC735A63C3C2E');
        $this->addSql('ALTER TABLE citizen_city DROP FOREIGN KEY FK_605EC7358BAC62AF');
        $this->addSql('DROP TABLE citizen');
        $this->addSql('DROP TABLE citizen_city');
        $this->addSql('DROP TABLE city');
    }
}
