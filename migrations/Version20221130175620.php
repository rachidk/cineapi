<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130175620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_people (id INT AUTO_INCREMENT NOT NULL, movie_id INT NOT NULL, people_id INT NOT NULL, role VARCHAR(255) NOT NULL, significance VARCHAR(255) NOT NULL, INDEX IDX_D1D1F7538F93B6FC (movie_id), INDEX IDX_D1D1F7533147C936 (people_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_people ADD CONSTRAINT FK_D1D1F7538F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_people ADD CONSTRAINT FK_D1D1F7533147C936 FOREIGN KEY (people_id) REFERENCES people (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE movie_people');
    }
}
