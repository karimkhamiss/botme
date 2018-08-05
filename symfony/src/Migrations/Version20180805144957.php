<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180805144957 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_cart_product (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, cart_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_999A6EAB19EB6921 (client_id), INDEX IDX_999A6EAB1AD5CDBF (cart_id), INDEX IDX_999A6EAB4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_cart_product ADD CONSTRAINT FK_999A6EAB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_cart_product ADD CONSTRAINT FK_999A6EAB1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE client_cart_product ADD CONSTRAINT FK_999A6EAB4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client_cart_product');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}
