<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127181902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assurance (id INT AUTO_INCREMENT NOT NULL, num_assu VARCHAR(255) NOT NULL, nom_assu VARCHAR(255) NOT NULL, prix_assu DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibilites (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT NOT NULL, id_dispo VARCHAR(255) NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, INDEX IDX_B0F3489C1C13BCCF (id_offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, note INT NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_1323A5751C13BCCF (id_offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_annuelle (id INT AUTO_INCREMENT NOT NULL, date_expiration DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_conv_id INT DEFAULT NULL, id_mess VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, date_mess DATE NOT NULL, INDEX IDX_B6BD307FC6EE5C49 (id_utilisateur_id), INDEX IDX_B6BD307FF15BB7B7 (id_conv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, id_offre VARCHAR(255) NOT NULL, titre_offre VARCHAR(255) NOT NULL, texte_offre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT NOT NULL, id_photo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_14B784181C13BCCF (id_offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT NOT NULL, id_user_emetteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, id_user_receveur VARCHAR(255) NOT NULL, INDEX IDX_CE6064041C13BCCF (id_offre_id), INDEX IDX_CE6064043378B2C8 (id_user_emetteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_offre_id INT NOT NULL, id_reservation VARCHAR(255) NOT NULL, reserv_debut DATETIME NOT NULL, reserv_fin DATETIME NOT NULL, INDEX IDX_42C8495579F37AE5 (id_user_id), INDEX IDX_42C849551C13BCCF (id_offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, inscription_annuelle_id INT NOT NULL, id_user VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) NOT NULL, nom_de_la_rue VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, porte_monnaie VARCHAR(255) DEFAULT NULL, code_de_carte_bancaire VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B36B3CA4B (id_user), INDEX IDX_1D1C63B3DD11B9F9 (inscription_annuelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disponibilites ADD CONSTRAINT FK_B0F3489C1C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5751C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF15BB7B7 FOREIGN KEY (id_conv_id) REFERENCES conversation (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784181C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064041C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064043378B2C8 FOREIGN KEY (id_user_emetteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495579F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DD11B9F9 FOREIGN KEY (inscription_annuelle_id) REFERENCES inscription_annuelle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disponibilites DROP FOREIGN KEY FK_B0F3489C1C13BCCF');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5751C13BCCF');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC6EE5C49');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF15BB7B7');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784181C13BCCF');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064041C13BCCF');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064043378B2C8');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495579F37AE5');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551C13BCCF');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DD11B9F9');
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE disponibilites');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE inscription_annuelle');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
