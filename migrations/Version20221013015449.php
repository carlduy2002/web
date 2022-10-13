<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013015449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, category_id_id INT NOT NULL, supplier_id_id INT NOT NULL, shop_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, original_price BIGINT NOT NULL, sale_price BIGINT NOT NULL, pro_image VARCHAR(255) NOT NULL, status VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD9777D11E ON product (category_id_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA65F9C7D ON product (supplier_id_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADB852C405 ON product (shop_id_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA65F9C7D FOREIGN KEY (supplier_id_id) REFERENCES supplier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB852C405 FOREIGN KEY (shop_id_id) REFERENCES shop (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA heroku_ext');
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD9777D11E');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADA65F9C7D');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADB852C405');
        $this->addSql('DROP TABLE product');
    }
}
