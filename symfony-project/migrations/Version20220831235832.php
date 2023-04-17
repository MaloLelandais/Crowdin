<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831235832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE traduction ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CF8C03A8A76ED395 ON traduction (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A8A76ED395');
        $this->addSql('DROP INDEX IDX_CF8C03A8A76ED395 ON traduction');
        $this->addSql('ALTER TABLE traduction DROP user_id');
    }
}
