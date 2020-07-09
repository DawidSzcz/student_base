<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709232146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('DROP INDEX UNIQ_B723AF33C9A4E480');
        $this->addSql('DROP INDEX UNIQ_B723AF3336B82C7');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33C9A4E480 ON student (user_id, album_no)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF3336B82C7 ON student (user_id, card_uid)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_B723AF33C9A4E480');
        $this->addSql('DROP INDEX INDEX UNIQ_B723AF3336B82C7');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33C9A4E480 ON student (album_no)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF3336B82C7 ON student (card_uid)');
    }
}
