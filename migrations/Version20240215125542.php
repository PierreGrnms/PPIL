<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215125542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE element');
        $this->addSql('ALTER TABLE disponibilites ADD COLUMN id_dispo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message ADD COLUMN id_mess VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD COLUMN id_offre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD COLUMN id_photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD COLUMN id_reservation VARCHAR(255) NOT NULL');
    }
}
