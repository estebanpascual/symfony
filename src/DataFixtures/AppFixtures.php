<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $article = new article();
        $article->setTitle("Le titre")
                ->setContent("<p>Son contenu</p>")
                ->setImage("http://placehold.ot/350x150")
                ->setCreatedAt( new \DateTime());
                
        $manager->persist($article);
        $manager->flush();
    }
}
