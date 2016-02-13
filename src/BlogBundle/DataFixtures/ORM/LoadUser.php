<?php
namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $listNames = array('Rémi', 'Axel', 'Batman');
    foreach ($listNames as $name) {
      $user = new User;
      $user->setUsername($name);
      $user->setPassword($name);
      $manager->persist($user);
    }
    $manager->flush();
  }
}