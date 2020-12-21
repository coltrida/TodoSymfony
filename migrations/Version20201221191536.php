<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221191536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citizen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citizen_city (citizen_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_605EC735A63C3C2E (citizen_id), INDEX IDX_605EC7358BAC62AF (city_id), PRIMARY KEY(citizen_id, city_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, priority VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT \'1970-01-02\' NOT NULL, date_due DATETIME DEFAULT \'1970-01-02\' NOT NULL, description VARCHAR(255) DEFAULT \'prova\' NOT NULL, user VARCHAR(255) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, todo VARCHAR(255) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE citizen_city ADD CONSTRAINT FK_605EC735A63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE citizen_city ADD CONSTRAINT FK_605EC7358BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE citizen_city DROP FOREIGN KEY FK_605EC735A63C3C2E');
        $this->addSql('ALTER TABLE citizen_city DROP FOREIGN KEY FK_605EC7358BAC62AF');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE citizen');
        $this->addSql('DROP TABLE citizen_city');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE user');
    }
}
