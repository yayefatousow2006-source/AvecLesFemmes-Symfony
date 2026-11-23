<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261123161920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, groupement_id INTEGER NOT NULL, CONSTRAINT FK_E418C74DE66695CE FOREIGN KEY (groupement_id) REFERENCES groupement (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E418C74DE66695CE ON exercice (groupement_id)');
        $this->addSql('ALTER TABLE groupement ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE groupement ADD COLUMN updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE exercice');
        $this->addSql('CREATE TEMPORARY TABLE __temp__groupement AS SELECT id, nom, adresse, telephone FROM groupement');
        $this->addSql('DROP TABLE groupement');
        $this->addSql('CREATE TABLE groupement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL)');
        $this->addSql('INSERT INTO groupement (id, nom, adresse, telephone) SELECT id, nom, adresse, telephone FROM __temp__groupement');
        $this->addSql('DROP TABLE __temp__groupement');
    }
}
