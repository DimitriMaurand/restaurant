<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240913124725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson_allergene (boisson_id INT NOT NULL, allergene_id INT NOT NULL, INDEX IDX_19B0A558734B8089 (boisson_id), INDEX IDX_19B0A5584646AB2 (allergene_id), PRIMARY KEY(boisson_id, allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson_allergene ADD CONSTRAINT FK_19B0A558734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_allergene ADD CONSTRAINT FK_19B0A5584646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson_allergene DROP FOREIGN KEY FK_19B0A558734B8089');
        $this->addSql('ALTER TABLE boisson_allergene DROP FOREIGN KEY FK_19B0A5584646AB2');
        $this->addSql('DROP TABLE boisson_allergene');
    }
}
