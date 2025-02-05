<?php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
public function load(ObjectManager $manager): void
{
$faker = Factory::create();

for ($i = 0; $i < 10; $i++) {
$product = new Product();
$product->setName($faker->word)
->setDescription($faker->sentence)
->setPrice($faker->randomFloat(2, 10, 200))
->setImage('https://via.placeholder.com/150')
->setCreatedAt(new \DateTime());

$manager->persist($product);
}

$manager->flush();
}
}
