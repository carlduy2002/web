<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013020658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cart_detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE orders_detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, username_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7ED766068 ON cart (username_id)');
        $this->addSql('CREATE TABLE cart_detail (id INT NOT NULL, cart_id_id INT NOT NULL, product_id_id INT NOT NULL, qty_pro INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20821DCC20AEF35F ON cart_detail (cart_id_id)');
        $this->addSql('CREATE INDEX IDX_20821DCCDE18E50B ON cart_detail (product_id_id)');
        $this->addSql('CREATE TABLE orders (id INT NOT NULL, username_id INT NOT NULL, order_date DATE NOT NULL, delivery_date DATE NOT NULL, payment BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEED766068 ON orders (username_id)');
        $this->addSql('CREATE TABLE orders_detail (id INT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, qty_pro INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F964642FCDAEAAA ON orders_detail (order_id_id)');
        $this->addSql('CREATE INDEX IDX_8F964642DE18E50B ON orders_detail (product_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, address VARCHAR(255) NOT NULL, gender VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7ED766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_detail ADD CONSTRAINT FK_20821DCC20AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_detail ADD CONSTRAINT FK_20821DCCDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEED766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders_detail ADD CONSTRAINT FK_8F964642FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders_detail ADD CONSTRAINT FK_8F964642DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA heroku_ext');
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cart_detail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE orders_detail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B7ED766068');
        $this->addSql('ALTER TABLE cart_detail DROP CONSTRAINT FK_20821DCC20AEF35F');
        $this->addSql('ALTER TABLE cart_detail DROP CONSTRAINT FK_20821DCCDE18E50B');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEED766068');
        $this->addSql('ALTER TABLE orders_detail DROP CONSTRAINT FK_8F964642FCDAEAAA');
        $this->addSql('ALTER TABLE orders_detail DROP CONSTRAINT FK_8F964642DE18E50B');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_detail');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_detail');
        $this->addSql('DROP TABLE "user"');
    }
}
