<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830083310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_language ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_345695B59D86650F ON user_language (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_language DROP FOREIGN KEY FK_345695B59D86650F');
        $this->addSql('DROP INDEX IDX_345695B59D86650F ON user_language');
        $this->addSql('ALTER TABLE user_language DROP user_id_id');
    }
}
