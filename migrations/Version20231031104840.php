<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031104840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE robe ADD CONSTRAINT FK_C9EAA7E4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_C9EAA7E4BCF5E72D ON robe (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe DROP FOREIGN KEY FK_C9EAA7E4BCF5E72D');
        $this->addSql('DROP INDEX IDX_C9EAA7E4BCF5E72D ON robe');
        $this->addSql('ALTER TABLE robe DROP categorie_id');
    }
}
