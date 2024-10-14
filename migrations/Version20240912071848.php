<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240912071848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_allergene (produit_id INT NOT NULL, allergene_id INT NOT NULL, INDEX IDX_17B47409F347EFB (produit_id), INDEX IDX_17B474094646AB2 (allergene_id), PRIMARY KEY(produit_id, allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_allergene ADD CONSTRAINT FK_17B47409F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_allergene ADD CONSTRAINT FK_17B474094646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_produit DROP FOREIGN KEY FK_EA8E6AD54646AB2');
        $this->addSql('ALTER TABLE allergene_produit DROP FOREIGN KEY FK_EA8E6AD5F347EFB');
        $this->addSql('DROP TABLE allergene_produit');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene_produit (allergene_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_EA8E6AD54646AB2 (allergene_id), INDEX IDX_EA8E6AD5F347EFB (produit_id), PRIMARY KEY(allergene_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE allergene_produit ADD CONSTRAINT FK_EA8E6AD54646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_produit ADD CONSTRAINT FK_EA8E6AD5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_allergene DROP FOREIGN KEY FK_17B47409F347EFB');
        $this->addSql('ALTER TABLE produit_allergene DROP FOREIGN KEY FK_17B474094646AB2');
        $this->addSql('DROP TABLE produit_allergene');
    }
}
