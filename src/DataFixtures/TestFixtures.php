<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Couleur;
use App\Entity\Fournisseur;
use App\Entity\Location;
use App\Entity\Retouche;
use App\Entity\Retoucheur;
use App\Entity\Robe;
use App\Entity\Taille;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Date;

class TestFixtures extends Fixture implements FixtureGroupInterface
{
    private $faker;
    private $hasher;
    private $manager;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = FakerFactory::create('fr_FR');
        $this->hasher = $hasher;
    }

    public static function getGroups(): array
    {
        return ['test'];
    }

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadClients();
        $this->loadFournisseurs();
        $this->loadRetoucheurs();
        $this->loadLocations();
        $this->loadTailles();
        $this->loadCouleurs();
        $this->loadCategories();
        $this->loadRobes();
        $this->loadRetouches();
    }

    public function loadClients(): void
    {
        //données statiques
        $datas = [
            [
                'email' => 'maryam@exemple.com',
                'roles' => ['ROLE_USER'],
                'password' => '123',

                'nom' => 'Maryam',
                'prenom' => 'ADDICHI',
                'tel' => '06.12.34.56.78',
                
            ],
            [
                'email' => 'nezha@exemple.com',
                'roles' => ['ROLE_USER'],
                'password' => '123',

                'nom' => 'Nezha',
                'prenom' => 'Hamouchi',
                'tel' => '06.21.36.56.77',
                
            ],
            [
                'email' => 'latifa@exemple.com',
                'roles' => ['ROLE_USER'],
                'password' => '123',

                'nom' => 'Latifa',
                'prenom' => 'Meskini',
                'tel' => '06.55.66.77.88',
                
            ],
        ];

        foreach ($datas as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $password = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $this->manager->persist($user);

            $client = new Client();

            $client->setNom($data['nom']);
            $client->setPrenom($data['prenom']);
            $client->setTel($data['tel']);

            $client->setUser($user);

            $this->manager->persist($client);

        }

        $this->manager->flush();

        // données dynamiques

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->unique()->safeEmail());
            $password = $this->hasher->hashPassword($user, '123');
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);

            $this->manager->persist($user);

            $client = new Client();
            $client->setNom($this->faker->lastName());
            $client->setPrenom($this->faker->firstName());
            $client->setTel($this->faker->phoneNumber());

            $client->setUser($user);

            $this->manager->persist($client);
        }

        $this->manager->flush();

    }

    public function loadFournisseurs(): void
    {
        //données statiques

        $datas = [
            [
                'nomEntreprise' => 'Fournisseur 1',
                'numeroSiret' => '12345678958934',
                'adresse' => '50 rue des fleurs, 75000 Paris',
                'tel' => '06.12.69.56.44',
                'email' => 'fournisseur1@exemple.com',
            ],
            [
                'nomEntreprise' => 'Fournisseur 2',
                'numeroSiret' => '85445678977834',
                'adresse' => '8 rue de marq en Baroeul, 62300 Lens',
                'tel' => '06.12.69.56.44',
                'email' => 'fournisseur2@exemple.com',
            ],
        ];

        foreach ($datas as $data) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomEntreprise($data['nomEntreprise']);
            $fournisseur->setNumeroSiret($data['numeroSiret']);
            $fournisseur->setAdresse($data['adresse']);
            $fournisseur->setTel($data['tel']);
            $fournisseur->setEmail($data['email']);

            $this->manager->persist($fournisseur);

        }
        
        $this->manager->flush();

        // données dynamiques

        for ($i = 0; $i < 3; $i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomEntreprise($this->faker->company());
            $fournisseur->setNumeroSiret($this->faker->numerify('##############'));
            $fournisseur->setAdresse($this->faker->address());
            $fournisseur->setTel($this->faker->phoneNumber());
            $fournisseur->setEmail($this->faker->email());

            $this->manager->persist($fournisseur);
        }

        $this->manager->flush();

    }

    public function loadRetoucheurs(): void
    {
        //données statiques

        $datas = [
            [
                'nomEntreprise' => 'Retoucheur3000',
                'numeroSiret' => '58967124958934',
                'adresse' => '50 rue des fleurs, 75000 Paris',
                'tel' => '06.12.69.56.44',
                'email' => 'Retoucheur3000@exemple.com',

            ]
        ];

        foreach ($datas as $data) {
            $retoucheur = new Retoucheur();
            $retoucheur->setNomEntreprise($data['nomEntreprise']);
            $retoucheur->setNumeroSiret($data['numeroSiret']);
            $retoucheur->setAdresse($data['adresse']);
            $retoucheur->setTel($data['tel']);
            $retoucheur->setEmail($data['email']);

            $this->manager->persist($retoucheur);
        }

        $this->manager->flush();

        // données dynamiques

        for ($i = 0; $i < 3; $i++) {
            $retoucheur = new Retoucheur();
            $retoucheur->setNomEntreprise($this->faker->company());
            $retoucheur->setNumeroSiret($this->faker->numerify('##############'));
            $retoucheur->setAdresse($this->faker->address());
            $retoucheur->setTel($this->faker->phoneNumber());
            $retoucheur->setEmail($this->faker->email());

            $this->manager->persist($retoucheur);
        }

        $this->manager->flush();

    }

    public function loadLocations(): void
    {
        $repositoryClient = $this->manager->getRepository(Client::class);
        $clients = $repositoryClient->findAll();
        $client1 = $repositoryClient->find(1);

        //données statiques

        $datas = [
            [
                'dateDebutLocation' => new DateTime('2022-01-01'),
                'dateFinLocation' => new DateTime ('2022-01-02'),
                'prixTotal' => 129.99,
                'client' => $client1,
            ],
        ];

        foreach ($datas as $data) {
            $location = new Location();
            $location->setDateDebutLocation($data['dateDebutLocation']);
            $location->setDateFinLocation($data['dateFinLocation']);
            $location->setPrixTotal($data['prixTotal']);
            $location->setClient($data['client']);

            $this->manager->persist($location);
    }

        $this->manager->flush();

        // données dynamiques

        for ($i = 0; $i < 20; $i++) {
            $location = new Location();

            $dateDebutLoaction = $this->faker->dateTimeBetween('-1 year', '-6 months');
            $location->setDateDebutLocation($dateDebutLoaction);

            $daFinLocation = $this->faker->optional(0.5)->dateTimeBetween('-6 months', 'now');
            $location->setDateFinLocation($daFinLocation);

            $location->setPrixTotal($this->faker->randomFloat(2, 70, 500));
            $location->setClient($this->faker->randomElement($clients));

            $this->manager->persist($location);
        }

        $this->manager->flush();

    }

    public function loadTailles(): void
    {
        //données statiques

        $datas = [
            [
                'taille' => 'XS',
            ],
            [
                'taille' => 'S',
            ],
            [
                'taille' => 'M',
            ],
            [
                'taille' => 'L',
            ],
            [
                'taille' => 'XL',
            ],
            [
                'taille' => 'XXL',
            ]
        ];

        foreach ($datas as $data) {
            $taille = new Taille();
            $taille->setNom($data['taille']);

            $this->manager->persist($taille);
        }

        $this->manager->flush();

    }

    public function loadCouleurs(): void
    {
        // données statiques

        $datas = [
            [
                'couleur' => 'noir',
            ],
            [
                'couleur' => 'blanc',
            ],
        ];

        foreach ($datas as $data) {
            $couleur = new Couleur();
            $couleur->setNom($data['couleur']);

            $this->manager->persist($couleur);
        }

        $this->manager->flush();

        // données dynamiques

        for ($i = 0; $i < 10; $i++) {
            $couleur = new Couleur();
            $couleur->setNom($this->faker->colorName());

            $this->manager->persist($couleur);
            
        }

        $this->manager->flush();

    }

    public function loadCategories(): void
    {
        // données statiques

        $datas = [
            [
                'nom' => 'Prestige',
            ],
            [
                'nom' => 'Beldi',
            ],
            [
                'nom' => 'Tlija',
            ],
            [
                'nom' => 'Karakou',
            ],
            [
                'nom' => 'Glam',
            ],
        ];

        foreach ($datas as $data) {
            $category = new Categorie();
            $category->setNom($data['nom']);

            $this->manager->persist($category);
        }

        $this->manager->flush();
    }

        public function loadRobes(): void
        {
            $repositoryTaille = $this->manager->getRepository(Taille::class);
            $tailles = $repositoryTaille->findAll();
            $taille1 = $repositoryTaille->find(1);

            $repositoryCouleur = $this->manager->getRepository(Couleur::class);
            $couleurs = $repositoryCouleur->findAll();
            $couleur1 = $repositoryCouleur->find(6);

            $repositoryCategorie = $this->manager->getRepository(Categorie::class);
            $categories = $repositoryCategorie->findAll();
            $categorie1 = $repositoryCategorie->find(3);

            $repositoryFournisseur = $this->manager->getRepository(Fournisseur::class);
            $fournisseurs = $repositoryFournisseur->findAll();
            $fournisseur1 = $repositoryFournisseur->find(2);

            $reposositoryLocation = $this->manager->getRepository(Location::class);
            $locations = $reposositoryLocation->findAll();
            $location1 = $reposositoryLocation->find(2);

            // données statiques

            $datas = [
                [
                    'nom' => 'Robe',
                    'description' => 'Robe',
                    'prix' => 100,
                    'taille' => $taille1,
                    'couleur' => $couleur1,
                    'fournisseur' => $fournisseur1,
                    'categorie' => $categorie1,
                    'location1' => $location1
                ]
            ];

            foreach ($datas as $data) {
                $robe = new Robe();
                $robe->setNomRobe($data['nom']);
                $robe->setDescription($data['description']);
                $robe->setPrix($data['prix']);
                $robe->setTaille($data['taille']);
                $robe->addCouleur($data['couleur']);
                $robe->setFournisseur($data['fournisseur']);
                $robe->setCategorie($data['categorie']);
                $robe->addLocation($data['location1']);

                $this->manager->persist($robe);
            }

            $this->manager->flush();

            // données dynamiques

            for ($i = 0; $i < 10; $i++) {
                $robe = new Robe();
                $robe->setNomRobe($this->faker->word());
                $robe->setDescription($this->faker->text());
                $robe->setPrix($this->faker->randomFloat(2, 70, 120));
                $robe->setTaille($this->faker->randomElement($tailles));

                $nbLocation = random_int(1, 3);
                $shortlist = $this->faker->randomElements($locations, $nbLocation);
                foreach ($shortlist as $location) {
                    $robe->addLocation($location);
                }

                $nbCouleur = random_int(1, 3);
                $shortlist = $this->faker->randomElements($couleurs, $nbCouleur);
                foreach ($shortlist as $couleur) {
                    $robe->addCouleur($couleur);
                }

                $robe->setFournisseur($this->faker->randomElement($fournisseurs));
                $robe->setCategorie($this->faker->randomElement($categories));

                $this->manager->persist($robe);
            }

            $this->manager->flush();

        }

    public function loadRetouches(): void
    {
        $repositoryRobe = $this->manager->getRepository(Robe::class);
        $Robes = $repositoryRobe->findAll();
        $Robe1 = $repositoryRobe->find(1);

        $repositoryRetoucheur = $this->manager->getRepository(Retoucheur::class);
        $Retoucheurs = $repositoryRetoucheur->findAll();
        $Retoucheur1 = $repositoryRetoucheur->find(1);
        //données statiques

        $datas = [
            [
                'dateRetouche' => new DateTime('2022-07-01'),
                'dateFinRetouche' => new DateTime('2022-07-15'),
                'retoucheur' => $Retoucheur1,
                'robe' => $Robe1,
            ],
        ];

        foreach ($datas as $data) {
            $retouche = new Retouche();
            $retouche->setDateRetouche($data['dateRetouche']);
            $retouche->setDateFinRetouche($data['dateFinRetouche']);
            $retouche->setRetoucheur($data['retoucheur']);
            $retouche->setRobe($data['robe']);

            $this->manager->persist($retouche);
        }

        $this->manager->flush();

        //données dynamiques

        for ($i = 0; $i < 10; $i++) {
            $retouche = new Retouche();

            $dateRetouche = $this->faker->dateTimeBetween('now', '+1 day');
            $retouche->setDateRetouche($dateRetouche);

            $dateFinRetouche = $this->faker->optional(0.5)->dateTimeBetween('2 days', '+5 days');
            $retouche->setRetoucheur($this->faker->randomElement($Retoucheurs));
            $retouche->setRobe($this->faker->randomElement($Robes));

            $this->manager->persist($retouche);
        }
        
        $this->manager->flush();

    }
}