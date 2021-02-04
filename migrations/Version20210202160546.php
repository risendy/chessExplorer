<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202160546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE move ADD next_move_id INT DEFAULT NULL, ADD fen VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE move ADD CONSTRAINT FK_EF3E3778AF4B6B0A FOREIGN KEY (next_move_id) REFERENCES move (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF3E3778AF4B6B0A ON move (next_move_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE move DROP FOREIGN KEY FK_EF3E3778AF4B6B0A');
        $this->addSql('DROP INDEX UNIQ_EF3E3778AF4B6B0A ON move');
        $this->addSql('ALTER TABLE move DROP next_move_id, DROP fen');
    }
}
