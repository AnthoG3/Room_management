<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241206094249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_tag (room_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_10F0A9E54177093 (room_id), INDEX IDX_10F0A9EBAD26311 (tag_id), PRIMARY KEY(room_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_tag ADD CONSTRAINT FK_10F0A9E54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_tag ADD CONSTRAINT FK_10F0A9EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_tag DROP FOREIGN KEY FK_10F0A9E54177093');
        $this->addSql('ALTER TABLE room_tag DROP FOREIGN KEY FK_10F0A9EBAD26311');
        $this->addSql('DROP TABLE room_tag');
    }
}
