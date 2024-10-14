<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240906091303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergene_produit (allergene_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_EA8E6AD54646AB2 (allergene_id), INDEX IDX_EA8E6AD5F347EFB (produit_id), PRIMARY KEY(allergene_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergene_boisson (allergene_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_48BC4EBF4646AB2 (allergene_id), INDEX IDX_48BC4EBF734B8089 (boisson_id), PRIMARY KEY(allergene_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, categorie_boisson_id INT DEFAULT NULL, nom VARCHAR(70) NOT NULL, appelation VARCHAR(70) DEFAULT NULL, annee INT DEFAULT NULL, composition VARCHAR(255) NOT NULL, volume INT NOT NULL, prix DOUBLE PRECISION NOT NULL, est_alcolisee TINYINT(1) NOT NULL, disponible TINYINT(1) NOT NULL, INDEX IDX_8B97C84DED824A25 (categorie_boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_boisson (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, prix DOUBLE PRECISION NOT NULL, disponible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_produit (menu_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_A17EF199CCD7E912 (menu_id), INDEX IDX_A17EF199F347EFB (produit_id), PRIMARY KEY(menu_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(70) NOT NULL, composition VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, disponible TINYINT(1) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, astatutrelation_id INT DEFAULT NULL, INDEX IDX_6289474982BB2C6B (astatutrelation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(70) DEFAULT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, message LONGTEXT NOT NULL, date_envoi DATETIME NOT NULL, rgpd DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_reservation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergene_produit ADD CONSTRAINT FK_EA8E6AD54646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_produit ADD CONSTRAINT FK_EA8E6AD5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_boisson ADD CONSTRAINT FK_48BC4EBF4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_boisson ADD CONSTRAINT FK_48BC4EBF734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DED824A25 FOREIGN KEY (categorie_boisson_id) REFERENCES categorie_boisson (id)');
        $this->addSql('ALTER TABLE menu_produit ADD CONSTRAINT FK_A17EF199CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_produit ADD CONSTRAINT FK_A17EF199F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_6289474982BB2C6B FOREIGN KEY (astatutrelation_id) REFERENCES statut_reservation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergene_produit DROP FOREIGN KEY FK_EA8E6AD54646AB2');
        $this->addSql('ALTER TABLE allergene_produit DROP FOREIGN KEY FK_EA8E6AD5F347EFB');
        $this->addSql('ALTER TABLE allergene_boisson DROP FOREIGN KEY FK_48BC4EBF4646AB2');
        $this->addSql('ALTER TABLE allergene_boisson DROP FOREIGN KEY FK_48BC4EBF734B8089');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DED824A25');
        $this->addSql('ALTER TABLE menu_produit DROP FOREIGN KEY FK_A17EF199CCD7E912');
        $this->addSql('ALTER TABLE menu_produit DROP FOREIGN KEY FK_A17EF199F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_6289474982BB2C6B');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE allergene_produit');
        $this->addSql('DROP TABLE allergene_boisson');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE categorie_boisson');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE statut_reservation');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
