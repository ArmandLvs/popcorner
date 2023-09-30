<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930143549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, watched, rating, review FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, library_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, imdb_id INTEGER NOT NULL, watched BOOLEAN NOT NULL, rating SMALLINT DEFAULT NULL, review CLOB DEFAULT NULL, CONSTRAINT FK_1D5EF26FFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, watched, rating, review) SELECT id, title, imdb_id, watched, rating, review FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26FFE2541D7 ON movie (library_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, watched, rating, review FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, imdb_id INTEGER NOT NULL, watched BOOLEAN NOT NULL, rating SMALLINT DEFAULT NULL, review CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, watched, rating, review) SELECT id, title, imdb_id, watched, rating, review FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
    }
}
