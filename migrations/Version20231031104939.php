<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031104939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe ADD taille_id INT NOT NULL');
        $this->addSql('ALTER TABLE robe ADD CONSTRAINT FK_C9EAA7E4FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('CREATE INDEX IDX_C9EAA7E4FF25611A ON robe (taille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE robe DROP FOREIGN KEY FK_C9EAA7E4FF25611A');
        $this->addSql('DROP INDEX IDX_C9EAA7E4FF25611A ON robe');
        $this->addSql('ALTER TABLE robe DROP taille_id');
    }
}
