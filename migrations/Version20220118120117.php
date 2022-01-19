<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118120117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id_article INT AUTO_INCREMENT NOT NULL, id_employe INT DEFAULT NULL, id_rubrique INT DEFAULT NULL, titre TEXT NOT NULL, contenu TEXT NOT NULL, date_creation_article DATE NOT NULL, INDEX fkIdx_136 (id_employe), INDEX fkIdx_139 (id_rubrique), PRIMARY KEY(id_article)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id_categorie INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(45) NOT NULL, description_categorie TEXT DEFAULT NULL, activation TINYINT(1) DEFAULT \'1\', import TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id_client INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(45) NOT NULL, prenom_client VARCHAR(45) NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, mail_client VARCHAR(50) NOT NULL, lib_rue_client VARCHAR(45) NOT NULL, CP_client VARCHAR(45) NOT NULL, ville_client VARCHAR(45) NOT NULL, tel_client VARCHAR(45) NOT NULL, abonnement_newsletter VARBINARY(255) NOT NULL, UNIQUE INDEX UNIQ_C74404551A7DBB3E (mail_client), PRIMARY KEY(id_client)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id_commande INT AUTO_INCREMENT NOT NULL, id_employe INT DEFAULT NULL, id_statut INT DEFAULT NULL, date_commande DATETIME NOT NULL, no_table INT NOT NULL, INDEX fkIdx_110 (id_employe), INDEX fkIdx_53 (id_statut), PRIMARY KEY(id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id_commentaire INT AUTO_INCREMENT NOT NULL, id_client INT DEFAULT NULL, id_produit INT DEFAULT NULL, titre TEXT NOT NULL, description TEXT NOT NULL, date DATETIME NOT NULL, INDEX fkIdx_22 (id_client), INDEX fkIdx_25 (id_produit), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE declinaison (id_declinaison INT AUTO_INCREMENT NOT NULL, libelle_declinaison TEXT NOT NULL, description_declinaison TEXT DEFAULT NULL, PRIMARY KEY(id_declinaison)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE declinaison_produit (id_declinaison_produit INT NOT NULL, id_declinaison INT NOT NULL, id_produit INT NOT NULL, INDEX fkIdx_156 (id_declinaison), INDEX fkIdx_159 (id_produit), PRIMARY KEY(id_declinaison_produit, id_declinaison, id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id_employe INT AUTO_INCREMENT NOT NULL, id_role INT DEFAULT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, lib_rue TEXT NOT NULL, CP_ville VARCHAR(45) NOT NULL, ville VARCHAR(45) NOT NULL, tel VARCHAR(45) NOT NULL, date_embauche DATETIME NOT NULL, role_JWT JSON NOT NULL, UNIQUE INDEX UNIQ_F804D3B95126AC48 (mail), INDEX fkIdx_45 (id_role), PRIMARY KEY(id_employe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id_produit INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, id_tva INT DEFAULT NULL, libelle_produit VARCHAR(45) NOT NULL, description_produit TEXT DEFAULT NULL, prix_unitaire_HT DOUBLE PRECISION NOT NULL, image TEXT DEFAULT NULL, activation TINYINT(1) DEFAULT \'1\', import TINYINT(1) DEFAULT NULL, INDEX fkIdx_13 (id_categorie), INDEX fkIdx_95 (id_tva), PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commande (id_produit INT NOT NULL, id_commande INT NOT NULL, id_declinaison_produit INT DEFAULT NULL, quantité_produit INT NOT NULL, prix_HT DOUBLE PRECISION NOT NULL, montant_TVA DOUBLE PRECISION NOT NULL, INDEX fkIdx_182 (id_declinaison_produit), INDEX fkIdx_32 (id_commande), PRIMARY KEY(id_produit, id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id_role INT AUTO_INCREMENT NOT NULL, libelle_role VARCHAR(45) NOT NULL, PRIMARY KEY(id_role)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (id_rubrique INT AUTO_INCREMENT NOT NULL, titre TEXT NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id_rubrique)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_commande (id_statut INT AUTO_INCREMENT NOT NULL, libelle_statut VARCHAR(45) NOT NULL, description_statut TEXT NOT NULL, PRIMARY KEY(id_statut)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva (id_tva INT AUTO_INCREMENT NOT NULL, pourcentageTVA NUMERIC(10, 1) NOT NULL, PRIMARY KEY(id_tva)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6626997AC9 FOREIGN KEY (id_employe) REFERENCES employe (id_employe)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DF7FE5E9 FOREIGN KEY (id_rubrique) REFERENCES rubrique (id_rubrique)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D26997AC9 FOREIGN KEY (id_employe) REFERENCES employe (id_employe)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC3534552 FOREIGN KEY (id_statut) REFERENCES statut_commande (id_statut)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCE173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE declinaison_produit ADD CONSTRAINT FK_1B179BAE96883256 FOREIGN KEY (id_declinaison) REFERENCES declinaison (id_declinaison)');
        $this->addSql('ALTER TABLE declinaison_produit ADD CONSTRAINT FK_1B179BAEF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9DC499668 FOREIGN KEY (id_role) REFERENCES role (id_role)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2771CD7E7A FOREIGN KEY (id_tva) REFERENCES tva (id_tva)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E5DFD0765 FOREIGN KEY (id_declinaison_produit) REFERENCES declinaison_produit (id_declinaison_produit)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E3E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C9486A13');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCE173B1B8');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E3E314AE8');
        $this->addSql('ALTER TABLE declinaison_produit DROP FOREIGN KEY FK_1B179BAE96883256');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E5DFD0765');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6626997AC9');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D26997AC9');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF7384557');
        $this->addSql('ALTER TABLE declinaison_produit DROP FOREIGN KEY FK_1B179BAEF7384557');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9DC499668');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DF7FE5E9');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC3534552');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2771CD7E7A');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE declinaison');
        $this->addSql('DROP TABLE declinaison_produit');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE statut_commande');
        $this->addSql('DROP TABLE tva');
    }
}
