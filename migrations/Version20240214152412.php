<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214152412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assurance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, num_assu VARCHAR(255) NOT NULL, nom_assu VARCHAR(255) NOT NULL, prix_assu DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE disponibilites (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, id_dispo VARCHAR(255) NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, CONSTRAINT FK_B0F3489C1C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B0F3489C1C13BCCF ON disponibilites (id_offre_id)');
        $this->addSql('CREATE TABLE emprunteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER DEFAULT NULL, CONSTRAINT FK_952067DE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_952067DE79F37AE5 ON emprunteur (id_user_id)');
        $this->addSql('CREATE TABLE evaluation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, note INTEGER NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1323A5751C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1323A5751C13BCCF ON evaluation (id_offre_id)');
        $this->addSql('CREATE TABLE inscription_annuelle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_expiration DATE NOT NULL)');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_utilisateur_id INTEGER NOT NULL, id_conv_id INTEGER DEFAULT NULL, id_mess VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, date_mess DATE NOT NULL, CONSTRAINT FK_B6BD307FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307FF15BB7B7 FOREIGN KEY (id_conv_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B6BD307FC6EE5C49 ON message (id_utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF15BB7B7 ON message (id_conv_id)');
        $this->addSql('CREATE TABLE offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre VARCHAR(255) NOT NULL, titre_offre VARCHAR(255) NOT NULL, texte_offre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, id_photo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_14B784181C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_14B784181C13BCCF ON photo (id_offre_id)');
        $this->addSql('CREATE TABLE preteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, en_sommeil BLOB NOT NULL, CONSTRAINT FK_203EF80179F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_203EF80179F37AE5 ON preteur (id_user_id)');
        $this->addSql('CREATE TABLE reclamation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_offre_id INTEGER NOT NULL, id_user_emetteur_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, id_user_receveur VARCHAR(255) NOT NULL, CONSTRAINT FK_CE6064041C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CE6064043378B2C8 FOREIGN KEY (id_user_emetteur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CE6064041C13BCCF ON reclamation (id_offre_id)');
        $this->addSql('CREATE INDEX IDX_CE6064043378B2C8 ON reclamation (id_user_emetteur_id)');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_offre_id INTEGER NOT NULL, id_reservation VARCHAR(255) NOT NULL, reserv_debut DATETIME NOT NULL, reserv_fin DATETIME NOT NULL, CONSTRAINT FK_42C8495579F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C849551C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_42C8495579F37AE5 ON reservation (id_user_id)');
        $this->addSql('CREATE INDEX IDX_42C849551C13BCCF ON reservation (id_offre_id)');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, inscription_annuelle_id INTEGER NOT NULL, id_user VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, porte_monnaie VARCHAR(255) DEFAULT NULL, code_de_carte_bancaire VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1D1C63B3DD11B9F9 FOREIGN KEY (inscription_annuelle_id) REFERENCES inscription_annuelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B36B3CA4B ON utilisateur (id_user)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3DD11B9F9 ON utilisateur (inscription_annuelle_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE disponibilites');
        $this->addSql('DROP TABLE emprunteur');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE inscription_annuelle');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE preteur');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
