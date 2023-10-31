<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031105323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE robe_location (robe_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_263B44FC69339CCD (robe_id), INDEX IDX_263B44FC64D218E (location_id), PRIMARY KEY(robe_id, location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE robe_location ADD CONSTRAINT FK_263B44FC69339CCD FOREIGN KEY (robe_id) REFERENCES robe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE robe_location ADD CONSTRAINT FK_263B44FC64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe_location DROP FOREIGN KEY FK_263B44FC69339CCD');
        $this->addSql('ALTER TABLE robe_location DROP FOREIGN KEY FK_263B44FC64D218E');
        $this->addSql('DROP TABLE robe_location');
    }
}
