<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261026215946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campagne (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, date_debut_at DATE NOT NULL, date_fin_at DATE DEFAULT NULL, montant INTEGER NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, type_campagne_id INTEGER NOT NULL, CONSTRAINT FK_539B5D165D3BA4E5 FOREIGN KEY (type_campagne_id) REFERENCES type_campagne (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_539B5D165D3BA4E5 ON campagne (type_campagne_id)');
        $this->addSql('CREATE TABLE groupement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_complet VARCHAR(150) NOT NULL)');
        $this->addSql('CREATE TABLE mode_cotisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, is_libre BOOLEAN NOT NULL, campagne_id INTEGER NOT NULL, membre_id INTEGER NOT NULL, CONSTRAINT FK_6BB9377E16227374 FOREIGN KEY (campagne_id) REFERENCES campagne (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6BB9377E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6BB9377E16227374 ON mode_cotisation (campagne_id)');
        $this->addSql('CREATE INDEX IDX_6BB9377E6A99F74A ON mode_cotisation (membre_id)');
        $this->addSql('CREATE TABLE role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE type_campagne (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE campagne');
        $this->addSql('DROP TABLE groupement');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE mode_cotisation');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE type_campagne');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
