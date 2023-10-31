<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031105113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE robe_couleur (robe_id INT NOT NULL, couleur_id INT NOT NULL, INDEX IDX_9E0912AD69339CCD (robe_id), INDEX IDX_9E0912ADC31BA576 (couleur_id), PRIMARY KEY(robe_id, couleur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE robe_couleur ADD CONSTRAINT FK_9E0912AD69339CCD FOREIGN KEY (robe_id) REFERENCES robe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE robe_couleur ADD CONSTRAINT FK_9E0912ADC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe_couleur DROP FOREIGN KEY FK_9E0912AD69339CCD');
        $this->addSql('ALTER TABLE robe_couleur DROP FOREIGN KEY FK_9E0912ADC31BA576');
        $this->addSql('DROP TABLE robe_couleur');
    }
}
