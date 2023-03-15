<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308105506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, name, firstname, picture, date_of_birth, grade FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, date_of_birth DATE NOT NULL, grade VARCHAR(10) NOT NULL)');
        $this->addSql('INSERT INTO student (id, name, firstname, picture, date_of_birth, grade) SELECT id, name, firstname, picture, date_of_birth, grade FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, name, firstname, picture, date_of_birth, grade FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, grade VARCHAR(10) NOT NULL)');
        $this->addSql('INSERT INTO student (id, name, firstname, picture, date_of_birth, grade) SELECT id, name, firstname, picture, date_of_birth, grade FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
    }
}
