<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705201632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33C9A4E480 ON student (album_no)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF3336B82C7 ON student (card_uid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('COMMENT ON COLUMN migration_versions.executed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP INDEX UNIQ_B723AF33C9A4E480');
        $this->addSql('DROP INDEX UNIQ_B723AF3336B82C7');
    }
}
