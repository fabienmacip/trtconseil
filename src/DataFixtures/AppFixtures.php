<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Recruteur;
use App\Entity\Candidat;
use App\Entity\Annonce;
use App\Entity\Candidature;


//use Faker\Factory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // ********** ADMIN
        $admin = new User();
        $admin->setUsername("fabien.macip@gmail.com")
            ->setPassword("tttttttt")
            ->setRoles(['ROLE_ADMIN'])
            ->setNom("MACIP")
            ->setPrenom("Fabien")
            ->setRole("admin");
        $manager->persist($admin);


        // ********** CONSULTANTS (USERS)
        for($i = 1; $i <= 15; $i++) {
            $user = new User();
            $user->setUsername($faker->email)
                ->setPassword($faker->password)
                ->setRoles(['ROLE_CONSULTANT'])
                /* ->setNom("DURAND".$i) */
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setRole("consultant");
            $manager->persist($user);

            // ********** CANDIDATS
            $user2 = new User();
            $user2->setUsername($faker->email)
                ->setPassword($faker->password)
                ->setRoles(['ROLE_CANDIDAT'])
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setRole("candidat_tovalid");
            $manager->persist($user2);
            
            $candidat = new Candidat();
            $candidat->setUser($user2);
            $manager->persist($candidat);

            // ********** RECRUTEUR
            $user3 = new User();
            $user3->setUsername($faker->email)
            ->setPassword($faker->password)
                ->setRoles(['ROLE_RECRUTEUR'])
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setRole("recruteur_tovalid");
            $manager->persist($user3);
            
            $recruteur = new Recruteur();
            $recruteur->setUser($user3)
                      ->setEntrepriseNom($faker->company)
                      ->setEntrepriseAdresse($faker->address)
                      ->setEntrepriseCodePostal($faker->postcode)
                      ->setEntrepriseVille($faker->city);
            $manager->persist($recruteur);

            // ********** ANNONCES
            $annonce = new Annonce();
            $annonce->setIntitule($faker->sentence)
                ->setPoste($faker->jobTitle)
                ->setVille($faker->city)
                ->setDescription($faker->paragraph(10))
                /* ->setDate(new \DateTime()) */
                ->setDate($faker->dateTime("- 6 months"))
                ->setValidation("0")
                ->setRecruteur($recruteur)
                ->setConsultant($user); // Ici, le USER doit être un consultant (voir rôle)
            $manager->persist($annonce);

            // ********** CANDIDATURES
            $candidature = new Candidature();
            $candidature->setAnnonce($annonce)
                        ->setCandidat($candidat);
            $manager->persist($candidature);

        } // END FOR

        $manager->flush();
    }

}
