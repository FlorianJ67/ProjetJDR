<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511144625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D428ABDD13');
        $this->addSql('ALTER TABLE character_stats_user DROP FOREIGN KEY FK_7D73078F28ABDD13');
        $this->addSql('ALTER TABLE character_stats_user DROP FOREIGN KEY FK_7D73078FA76ED395');
        $this->addSql('DROP TABLE character_stats');
        $this->addSql('DROP TABLE character_stats_user');
        $this->addSql('DROP INDEX IDX_D044D5D428ABDD13 ON session');
        $this->addSql('ALTER TABLE session DROP character_stats_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_stats (id INT AUTO_INCREMENT NOT NULL, info JSON NOT NULL, caracteristique JSON DEFAULT NULL, competence JSON DEFAULT NULL, inventaire JSON DEFAULT NULL, stats_additionnel JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE character_stats_user (character_stats_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D73078FA76ED395 (user_id), INDEX IDX_7D73078F28ABDD13 (character_stats_id), PRIMARY KEY(character_stats_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE character_stats_user ADD CONSTRAINT FK_7D73078F28ABDD13 FOREIGN KEY (character_stats_id) REFERENCES character_stats (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_stats_user ADD CONSTRAINT FK_7D73078FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD character_stats_id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D428ABDD13 FOREIGN KEY (character_stats_id) REFERENCES character_stats (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D428ABDD13 ON session (character_stats_id)');
    }
}
