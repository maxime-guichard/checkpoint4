<?php

namespace App\DataFixtures;

use App\Entity\Seat;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SeatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $seat1 = new Seat();
        $seat1->setName('Corsair TC60');
        // phpcs:ignore
        $seat1->setImage('https://m.media-amazon.com/images/I/715jXHlZB2L._AC_SX466_.jpg');
        $seat1->setSize('Hauteur: 86cm, Largeur: 43.2cm, Profondeur: 57.7cm');
        $seat1->setWeight('120');
        $seat1->setDensity('55');
        // phpcs:ignore
        $seat1->setDescription('coussin appui-tête:non, coussin lombaire: non, accoudoirs:3D, verin: classe 3, garantie: 2ans');
        $seat1->setPrice(249);
        // $manager->persist($product);
        $manager->persist($seat1);

        // $product = new Product();
        $seat2 = new Seat();
        $seat2->setName('Azgenon Z300');
        // phpcs:ignore
        $seat2->setImage('https://www.azgenon.net/upload/image/siege-gamer-azgenon-z300-blanc-p-image-28530-grande.jpg');
        $seat2->setSize('Hauteur: 85cm, Largeur: 39cm, Profondeur: 52cm');
        $seat2->setWeight('150');
        $seat2->setDensity('50');
        // phpcs:ignore
        $seat2->setDescription('coussin appui-tête:oui, coussin lombaire: oui, accoudoirs:4D, verin: classe 3, garantie: 2ans');
        $seat2->setPrice(279);
        // $manager->persist($product);
        $manager->persist($seat2);

        $manager->flush();
    }
}
