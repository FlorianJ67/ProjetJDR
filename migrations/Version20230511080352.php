<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511080352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4C1151A13 FOREIGN KEY (game_master_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4C1151A13 ON session (game_master_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C1151A13');
        $this->addSql('DROP INDEX IDX_D044D5D4C1151A13 ON session');
    }
}
