<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180805202042 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE in_order_product CHANGE order_id order_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_master CHANGE added_by added_by INT DEFAULT NULL, CHANGE last_modification last_modification DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_detail CHANGE added_by added_by INT DEFAULT NULL, CHANGE ref_master ref_master INT DEFAULT NULL, CHANGE last_modification last_modification DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE delivered_on delivered_on DATE DEFAULT NULL, CHANGE payed_on payed_on DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE activated_on activated_on DATE DEFAULT NULL, CHANGE token token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person CHANGE user_id user_id INT DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE last_modification last_modification DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE stock_validation CHANGE pending_validation_id pending_validation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE in_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE warehouse warehouse INT DEFAULT NULL, CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pending_validation_stock CHANGE validated validated TINYINT(1) DEFAULT NULL, CHANGE processed_on processed_on DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE in_order_product CHANGE order_id order_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE in_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE warehouse warehouse INT DEFAULT NULL, CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE delivered_on delivered_on DATE DEFAULT \'NULL\', CHANGE payed_on payed_on DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE pending_validation_stock CHANGE validated validated TINYINT(1) DEFAULT \'NULL\', CHANGE processed_on processed_on DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE person CHANGE user_id user_id INT DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product CHANGE last_modification last_modification DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ref_detail CHANGE added_by added_by INT DEFAULT NULL, CHANGE ref_master ref_master INT DEFAULT NULL, CHANGE last_modification last_modification DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ref_master CHANGE added_by added_by INT DEFAULT NULL, CHANGE last_modification last_modification DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE stock_validation CHANGE pending_validation_id pending_validation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE activated_on activated_on DATE DEFAULT \'NULL\', CHANGE token token VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
