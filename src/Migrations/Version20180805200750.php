<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180805200750 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADFAC7D83F');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC35E566A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCFBF73EB');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('CREATE TABLE ref_master (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL, added_on DATE NOT NULL, last_modification DATE DEFAULT NULL, UNIQUE INDEX UNIQ_5810CB2F5E237E06 (name), INDEX IDX_5810CB2F699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_detail (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, ref_detail INT DEFAULT NULL, name VARCHAR(25) NOT NULL, added_on DATE NOT NULL, last_modification DATE DEFAULT NULL, UNIQUE INDEX UNIQ_5B1F176A5E237E06 (name), INDEX IDX_5B1F176A699B6BAF (added_by), INDEX IDX_5B1F176A5B1F176A (ref_detail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_ref_detail (product_id INT NOT NULL, ref_detail_id INT NOT NULL, INDEX IDX_C87848414584665A (product_id), INDEX IDX_C8784841AB8A02FE (ref_detail_id), PRIMARY KEY(product_id, ref_detail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ref_master ADD CONSTRAINT FK_5810CB2F699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ref_detail ADD CONSTRAINT FK_5B1F176A699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ref_detail ADD CONSTRAINT FK_5B1F176A5B1F176A FOREIGN KEY (ref_detail) REFERENCES ref_master (id)');
        $this->addSql('ALTER TABLE product_ref_detail ADD CONSTRAINT FK_C87848414584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_ref_detail ADD CONSTRAINT FK_C8784841AB8A02FE FOREIGN KEY (ref_detail_id) REFERENCES ref_detail (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE designation');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE make');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE in_order_product CHANGE order_id order_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE delivered_on delivered_on DATE DEFAULT NULL, CHANGE payed_on payed_on DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE activated_on activated_on DATE DEFAULT NULL, CHANGE token token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person CHANGE user_id user_id INT DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D34A04ADC35E566A ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADCFBF73EB ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADFAC7D83F ON product');
        $this->addSql('ALTER TABLE product DROP family_id, DROP category_id, DROP make_id, DROP type_id, DROP designation_id, CHANGE last_modification last_modification DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE stock_validation CHANGE pending_validation_id pending_validation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE in_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE warehouse warehouse INT DEFAULT NULL, CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pending_validation_stock CHANGE validated validated TINYINT(1) DEFAULT NULL, CHANGE processed_on processed_on DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_detail DROP FOREIGN KEY FK_5B1F176A5B1F176A');
        $this->addSql('ALTER TABLE product_ref_detail DROP FOREIGN KEY FK_C8784841AB8A02FE');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, added_on DATE NOT NULL, last_modification DATE DEFAULT \'NULL\', UNIQUE INDEX UNIQ_64C19C15E237E06 (name), INDEX IDX_64C19C1699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE designation (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, added_on DATE NOT NULL, last_modification DATE DEFAULT \'NULL\', UNIQUE INDEX UNIQ_8947610D5E237E06 (name), INDEX IDX_8947610D699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, added_on DATE NOT NULL, last_modification DATE DEFAULT \'NULL\', UNIQUE INDEX UNIQ_A5E6215B5E237E06 (name), INDEX IDX_A5E6215B699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE make (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, added_on DATE NOT NULL, last_modification DATE DEFAULT \'NULL\', UNIQUE INDEX UNIQ_1ACC766E5E237E06 (name), INDEX IDX_1ACC766E699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, added_by INT DEFAULT NULL, name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, added_on DATE NOT NULL, last_modification DATE DEFAULT \'NULL\', UNIQUE INDEX UNIQ_8CDE57295E237E06 (name), INDEX IDX_8CDE5729699B6BAF (added_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE designation ADD CONSTRAINT FK_8947610D699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE make ADD CONSTRAINT FK_1ACC766E699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729699B6BAF FOREIGN KEY (added_by) REFERENCES user (id)');
        $this->addSql('DROP TABLE ref_master');
        $this->addSql('DROP TABLE ref_detail');
        $this->addSql('DROP TABLE product_ref_detail');
        $this->addSql('ALTER TABLE in_order_product CHANGE order_id order_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE in_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE warehouse warehouse INT DEFAULT NULL, CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE delivered_on delivered_on DATE DEFAULT \'NULL\', CHANGE payed_on payed_on DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE pending_validation_stock CHANGE validated validated TINYINT(1) DEFAULT \'NULL\', CHANGE processed_on processed_on DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE person CHANGE user_id user_id INT DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product ADD family_id INT NOT NULL, ADD category_id INT NOT NULL, ADD make_id INT NOT NULL, ADD type_id INT NOT NULL, ADD designation_id INT NOT NULL, CHANGE last_modification last_modification DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCFBF73EB FOREIGN KEY (make_id) REFERENCES make (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADFAC7D83F FOREIGN KEY (designation_id) REFERENCES designation (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC35E566A ON product (family_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCFBF73EB ON product (make_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADFAC7D83F ON product (designation_id)');
        $this->addSql('ALTER TABLE stock_validation CHANGE pending_validation_id pending_validation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE activated_on activated_on DATE DEFAULT \'NULL\', CHANGE token token VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
