<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828170728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $products =  $schema->createTable('products');
        $products->addColumn('id', 'integer', ['autoincrement' => true]);
        $products->addColumn('name','string');
        $products->addColumn('price','float');
        $products->setPrimaryKey(['id']);

        $coupons =  $schema->createTable('coupons');
        $coupons->addColumn('id', 'integer', ['autoincrement' => true]);
        $coupons ->addColumn('code','string');
        $coupons->addColumn('type','boolean');
        $coupons->addColumn('val','float');
        $coupons->setPrimaryKey(['id']);

        $country = $schema->createTable('countriestaxes');
        $country->addColumn('id', 'integer', ['autoincrement' => true]);
        $country->addColumn('name','string');
        $country->addColumn('code','string');
        $country->addColumn('xpart','integer');
        $country->addColumn('ypart','integer');
        $country->addColumn('taxval','float');
        $country->setPrimaryKey(['id']);

        $paymentProcess = $schema->createTable('paymentProcessor');
        $paymentProcess->addColumn('id', 'integer', ['autoincrement' => true]);
        $paymentProcess->addColumn('name','string');
        $paymentProcess->setPrimaryKey(['id']);

        $transaction =  $schema->createTable('transactions');
        $transaction->addColumn('id', 'integer', ['autoincrement' => true]);
        $transaction->addColumn('productid','integer');
        $transaction->addColumn('countrytaxid','integer');
        $transaction->addColumn('couponid','integer');
        $transaction->addColumn('paymentProcessorid','integer');
        $transaction->setPrimaryKey(['id']);
        $transaction->addForeignKeyConstraint('products',['productid'],['id']);
        $transaction->addForeignKeyConstraint('countriestaxes',['countrytaxid'],['id']);
        $transaction->addForeignKeyConstraint('coupons',['couponid'],['id']);
        $transaction->addForeignKeyConstraint('paymentProcessor',['paymentProcessorid'],['id']);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
