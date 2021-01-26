<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120091516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, event VARCHAR(255) DEFAULT NULL, site VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, round VARCHAR(255) DEFAULT NULL, white VARCHAR(255) DEFAULT NULL, black VARCHAR(255) DEFAULT NULL, result VARCHAR(255) DEFAULT NULL, white_elo DOUBLE PRECISION DEFAULT NULL, black_elo DOUBLE PRECISION DEFAULT NULL, eco VARCHAR(255) DEFAULT NULL, event_date DATE DEFAULT NULL, pgn LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move (id INT AUTO_INCREMENT NOT NULL, game_fk_id INT DEFAULT NULL, move_number INT DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, move_san VARCHAR(255) DEFAULT NULL, INDEX IDX_EF3E37789744605F (game_fk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE move ADD CONSTRAINT FK_EF3E37789744605F FOREIGN KEY (game_fk_id) REFERENCES game (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE move DROP FOREIGN KEY FK_EF3E37789744605F');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE move');
    }
}
