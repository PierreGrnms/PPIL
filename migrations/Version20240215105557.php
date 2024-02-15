<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215105557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, roles, password, nom, prenom, numero_rue, nom_de_la_rue, numero_telephone, porte_monnaie, email, code_postal FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_rue VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) NOT NULL, porte_monnaie DOUBLE PRECISION NOT NULL, email VARCHAR(180) NOT NULL, code_postal INTEGER NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, roles, password, nom, prenom, numero_rue, nom_de_la_rue, numero_telephone, porte_monnaie, email, code_postal) SELECT id, roles, password, nom, prenom, numero_rue, nom_de_la_rue, numero_telephone, porte_monnaie, email, code_postal FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, email, roles, password, nom, prenom, nom_de_la_rue, numero_rue, code_postal, numero_telephone, porte_monnaie FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) NOT NULL, numero_rue VARCHAR(255) NOT NULL, code_postal INTEGER NOT NULL, numero_telephone VARCHAR(255) NOT NULL, porte_monnaie DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, email, roles, password, nom, prenom, nom_de_la_rue, numero_rue, code_postal, numero_telephone, porte_monnaie) SELECT id, email, roles, password, nom, prenom, nom_de_la_rue, numero_rue, code_postal, numero_telephone, porte_monnaie FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }
}
