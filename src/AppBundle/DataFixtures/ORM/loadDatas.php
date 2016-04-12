<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/04/16
 * Time: 11:15
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Classe;
use AppBundle\Entity\Faculte;
use AppBundle\Entity\Filiere;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class loadDatas implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        for($i=0; $i<5; $i++){
            $faculte = new Faculte();
            $faculte->setNom($faker->name);
            $manager->persist($faculte);
            $this->createFilieres($manager, $faculte, $faker);
        }
        
        $manager->flush();
    }


    private function createFilieres(ObjectManager $manager, Faculte $faculte, \Faker\Generator $faker)
    {
        for($j=0; $j<5; $j++){
            $filiere = new Filiere();
            $filiere->setNom($faker->name);
            $filiere->setFaculte($faculte);
            $manager->persist($filiere);
            $this->createClasses($manager, $filiere, $faker);
        }
    }

    private function createClasses(ObjectManager $manager, Filiere $filiere, \Faker\Generator $faker)
    {
        for($j=0; $j<5; $j++){
            $classe = new Classe();
            $classe->setNom($faker->name);
            $classe->setFiliere($filiere);
            $manager->persist($classe);
        }
    }
}