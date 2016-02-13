<?php
namespace BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'Jeux vidéos',
      'Projets',
      'Ecoles',
      'Divers',
    );
    foreach ($names as $name) {
      $category = new Category();
      $category->setName($name);
      $manager->persist($category);
    }
    $manager->flush();
  }
}