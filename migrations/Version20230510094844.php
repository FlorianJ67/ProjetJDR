<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510094844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_stats ADD info JSON NOT NULL, ADD caracteristique JSON DEFAULT NULL, ADD competence JSON DEFAULT NULL, ADD inventaire JSON DEFAULT NULL, ADD stats_additionnel JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_stats DROP info, DROP caracteristique, DROP competence, DROP inventaire, DROP stats_additionnel');
        $this->addSql('ALTER TABLE `user` DROP pseudo');
    }
}
