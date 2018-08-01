<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 18:34
 */

namespace App\Tests\Repository;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{
    /**
     * @var
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }


    public function testFindAllProduct()
    {
        $this->assertGreaterThan(0,
            $this->getProductRepository()
                ->findAllProduct()
        );
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testFindProductWithId()
    {
        $product = $this->getProductRepository()
            ->findProductWithId(1)
        ;

        $this->assertSame('coca-cola light cannette 33cl', $product->getModel());
    }


    /**
     * @return ProductRepository
     */
    private function getProductRepository(): ProductRepository
    {
        return $this->em
            ->getRepository(Product::class)
            ;
    }
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
}