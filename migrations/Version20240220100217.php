<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220100217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__disponibilites AS SELECT id, id_offre_id, debut, fin FROM disponibilites');
        $this->addSql('DROP TABLE disponibilites');
        $this->addSql('CREATE TABLE disponibilites (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, CONSTRAINT FK_B0F3489C1C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO disponibilites (id, id_offre_id, debut, fin) SELECT id, id_offre_id, debut, fin FROM __temp__disponibilites');
        $this->addSql('DROP TABLE __temp__disponibilites');
        $this->addSql('CREATE INDEX IDX_B0F3489C1C13BCCF ON disponibilites (id_offre_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__message AS SELECT id, id_utilisateur_id, id_conv_id, text, date_mess FROM message');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_utilisateur_id INTEGER NOT NULL, id_conv_id INTEGER DEFAULT NULL, text VARCHAR(255) NOT NULL, date_mess DATE NOT NULL, CONSTRAINT FK_B6BD307FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307FF15BB7B7 FOREIGN KEY (id_conv_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO message (id, id_utilisateur_id, id_conv_id, text, date_mess) SELECT id, id_utilisateur_id, id_conv_id, text, date_mess FROM __temp__message');
        $this->addSql('DROP TABLE __temp__message');
        $this->addSql('CREATE INDEX IDX_B6BD307FF15BB7B7 ON message (id_conv_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FC6EE5C49 ON message (id_utilisateur_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offre AS SELECT id, titre_offre, texte_offre, prix FROM offre');
        $this->addSql('DROP TABLE offre');
        $this->addSql('CREATE TABLE offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre_offre VARCHAR(255) NOT NULL, texte_offre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO offre (id, titre_offre, texte_offre, prix) SELECT id, titre_offre, texte_offre, prix FROM __temp__offre');
        $this->addSql('DROP TABLE __temp__offre');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, id_offre_id, nom FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_14B784181C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO photo (id, id_offre_id, nom) SELECT id, id_offre_id, nom FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784181C13BCCF ON photo (id_offre_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, id_user_id, id_offre_id, reserv_debut, reserv_fin FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_offre_id INTEGER NOT NULL, reserv_debut DATETIME NOT NULL, reserv_fin DATETIME NOT NULL, CONSTRAINT FK_42C8495579F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C849551C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reservation (id, id_user_id, id_offre_id, reserv_debut, reserv_fin) SELECT id, id_user_id, id_offre_id, reserv_debut, reserv_fin FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C849551C13BCCF ON reservation (id_offre_id)');
        $this->addSql('CREATE INDEX IDX_42C8495579F37AE5 ON reservation (id_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, id_user, roles, password, nom, prenom, adresse_mail, nom_de_la_rue, code_postal, numero_telephone, porte_monnaie FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_rue VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) NOT NULL, code_postal INTEGER NOT NULL, numero_telephone VARCHAR(255) NOT NULL, porte_monnaie DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, email, roles, password, nom, prenom, numero_rue, nom_de_la_rue, code_postal, numero_telephone, porte_monnaie) SELECT id, id_user, roles, password, nom, prenom, adresse_mail, nom_de_la_rue, code_postal, numero_telephone, porte_monnaie FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE disponibilites ADD COLUMN id_dispo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message ADD COLUMN id_mess VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD COLUMN id_offre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD COLUMN id_photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD COLUMN id_reservation VARCHAR(255) NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, email, roles, password, nom, prenom, nom_de_la_rue, numero_rue, code_postal, numero_telephone, porte_monnaie FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, inscription_annuelle_id INTEGER NOT NULL, id_user VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, nom_de_la_rue VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) NOT NULL, code_postal VARCHAR(255) DEFAULT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, porte_monnaie VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, code_de_carte_bancaire VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1D1C63B3DD11B9F9 FOREIGN KEY (inscription_annuelle_id) REFERENCES inscription_annuelle (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO utilisateur (id, id_user, roles, password, nom, prenom, nom_de_la_rue, adresse_mail, code_postal, numero_telephone, porte_monnaie) SELECT id, email, roles, password, nom, prenom, nom_de_la_rue, numero_rue, code_postal, numero_telephone, porte_monnaie FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE INDEX IDX_1D1C63B3DD11B9F9 ON utilisateur (inscription_annuelle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B36B3CA4B ON utilisateur (id_user)');
    }
}
