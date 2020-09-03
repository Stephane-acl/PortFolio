<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723165049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture RENAME INDEX idx_8f7c2fc01ede0f55 TO IDX_16DB4F89166D1F9C');
        $this->addSql('ALTER TABLE project ADD link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project RENAME INDEX idx_5c93b3a4ab014612 TO IDX_2FB3D0EE19EB6921');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture RENAME INDEX idx_16db4f89166d1f9c TO IDX_8F7C2FC01EDE0F55');
        $this->addSql('ALTER TABLE project DROP link');
        $this->addSql('ALTER TABLE project RENAME INDEX idx_2fb3d0ee19eb6921 TO IDX_5C93B3A4AB014612');
    }
}
