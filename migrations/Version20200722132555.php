<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722132555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE technos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technos_projects (technos_id INT NOT NULL, projects_id INT NOT NULL, INDEX IDX_B972ED7B25F7B143 (technos_id), INDEX IDX_B972ED7B1EDE0F55 (projects_id), PRIMARY KEY(technos_id, projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE technos_projects ADD CONSTRAINT FK_B972ED7B25F7B143 FOREIGN KEY (technos_id) REFERENCES technos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technos_projects ADD CONSTRAINT FK_B972ED7B1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE technos_projects DROP FOREIGN KEY FK_B972ED7B25F7B143');
        $this->addSql('DROP TABLE technos');
        $this->addSql('DROP TABLE technos_projects');
    }
}
