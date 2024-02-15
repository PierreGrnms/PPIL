<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215104917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, roles, password, nom, prenom, adresse_mail, nom_de_la_rue, numero_telephone, porte_monnaie FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_rue VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) NOT NULL, porte_monnaie DOUBLE PRECISION NOT NULL, email VARCHAR(180) NOT NULL, code_postal INTEGER NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, roles, password, nom, prenom, numero_rue, nom_de_la_rue, numero_telephone, porte_monnaie) SELECT id, roles, password, nom, prenom, adresse_mail, nom_de_la_rue, numero_telephone, porte_monnaie FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, roles, password, nom, prenom, nom_de_la_rue, numero_rue, numero_telephone, porte_monnaie FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, inscription_annuelle_id INTEGER DEFAULT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, nom_de_la_rue VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, porte_monnaie VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, code_de_carte_bancaire VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1D1C63B3DD11B9F9 FOREIGN KEY (inscription_annuelle_id) REFERENCES inscription_annuelle (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO utilisateur (id, roles, password, nom, prenom, nom_de_la_rue, adresse_mail, numero_telephone, porte_monnaie) SELECT id, roles, password, nom, prenom, nom_de_la_rue, numero_rue, numero_telephone, porte_monnaie FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3A1207B9E ON utilisateur (adresse_mail)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3DD11B9F9 ON utilisateur (inscription_annuelle_id)');
    }
}
