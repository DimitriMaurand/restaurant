<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240917071926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergene_boisson DROP FOREIGN KEY FK_48BC4EBF4646AB2');
        $this->addSql('ALTER TABLE allergene_boisson DROP FOREIGN KEY FK_48BC4EBF734B8089');
        $this->addSql('DROP TABLE allergene_boisson');
        $this->addSql('ALTER TABLE reservation ADD reservation_asatatu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557A56B3FD FOREIGN KEY (reservation_asatatu_id) REFERENCES statut_reservation (id)');
        $this->addSql('CREATE INDEX IDX_42C849557A56B3FD ON reservation (reservation_asatatu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene_boisson (allergene_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_48BC4EBF4646AB2 (allergene_id), INDEX IDX_48BC4EBF734B8089 (boisson_id), PRIMARY KEY(allergene_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE allergene_boisson ADD CONSTRAINT FK_48BC4EBF4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergene_boisson ADD CONSTRAINT FK_48BC4EBF734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557A56B3FD');
        $this->addSql('DROP INDEX IDX_42C849557A56B3FD ON reservation');
        $this->addSql('ALTER TABLE reservation DROP reservation_asatatu_id');
    }
}
