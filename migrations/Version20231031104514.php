<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031104514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retouche ADD retoucheur_id INT NOT NULL');
        $this->addSql('ALTER TABLE retouche ADD CONSTRAINT FK_5F84D422660E4CFA FOREIGN KEY (retoucheur_id) REFERENCES retoucheur (id)');
        $this->addSql('CREATE INDEX IDX_5F84D422660E4CFA ON retouche (retoucheur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retouche DROP FOREIGN KEY FK_5F84D422660E4CFA');
        $this->addSql('DROP INDEX IDX_5F84D422660E4CFA ON retouche');
        $this->addSql('ALTER TABLE retouche DROP retoucheur_id');
    }
}
