<?php
namespace BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Tag;

class LoadTag implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'Console',
      'Marque',
      'Biscuit',
      'Voiture',
      'Espace',
    );
    foreach ($names as $name) {
      $tag = new Tag();
      $tag->setName($name);
      $manager->persist($tag);
    }
    $manager->flush();
  }
}