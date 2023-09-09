<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909143318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `products` (`id`, `name`, `price`) VALUES
        (1, 'Iphone ', 100),
        (2, 'Headphones', 200),
        (3, 'Case ', 10);");
        $this->addSql("INSERT INTO `coupons` (`id`, `code`, `type`, `val`) VALUES
        (1, 'D15', 0, 2),
        (2, 'D16', 1, 10);");
        $this->addSql("INSERT INTO `countriestaxes` (`id`, `name`, `code`, `xpart`, `ypart`, `taxval`) VALUES
        (1, 'Germany', 'DE', 9, 0, 19),
        (2, 'Italy', 'IT', 11, 0, 22),
        (3, 'France', 'FR', 9, 2, 20),
        (4, 'Greece', 'GR', 9, 0, 24);");
        $this->addSql("INSERT INTO `paymentprocessor` (`id`, `name`) VALUES
        (1, 'paypal'),
        (2, 'stripe');");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
