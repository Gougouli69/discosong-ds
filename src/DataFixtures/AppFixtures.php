<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        for($i=0; $i < 10; $i++){
            $style = new Style();
            $style->setName($faker->name);
            $manager->persist($style);

            for($j=0; $j < 20; $j++){

                $artist = new Artist();
                $artist->setName($faker->name)
                    ->setStyle($style)
                    ->setPicture($faker->imageUrl(200,200));
                $manager->persist($artist);

                for($k=0; $k < rand(10,15); $k++){
                    $album = new Album();
                    $album->setName($faker->name)
                        ->setArtist($artist)
                        ->setCover($faker->imageUrl(200,200))
                        ->setReleaseYear($faker->year($max = 'now'));
                    $manager->persist($album);
                }
            }

        }

        $user = new User();
        $user->setEmail("admin@mail.fr")
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->passwordEncoder->encodePassword($user, 'password')
            );
        $manager->persist($user);

        $user = new User();
        $user->setEmail("nonadmin@mail.fr")
            ->setRoles(['ROLE_USER'])
            ->setPassword(
                $this->passwordEncoder->encodePassword($user, 'password')
            );
        $manager->persist($user);
        $manager->flush();
    }
}
