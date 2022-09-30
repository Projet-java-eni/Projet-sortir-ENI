<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Groupe;
use App\Entity\Lieu;
use App\Entity\Photo;
use App\Entity\Sortie;
use App\Entity\Thematiques;
use App\Entity\User;
use App\Entity\Ville;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $dir_images = __DIR__. '/../../public/img/img_sorties';
        $dir_upload= __DIR__. '/../../public/uploads';
        if (!mkdir($dir_upload) && !is_dir($dir_upload)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir_upload));
        }
        @copy($dir_images.'/cinema1.gif', $dir_upload.'/cinema1.gif');
        @copy($dir_images.'/concert1.gif', $dir_upload.'/concert1.gif');
        @copy($dir_images.'/piscine1.gif', $dir_upload.'/piscine1.gif');
        @copy($dir_images.'/rando_mer1.gif', $dir_upload.'/rando_mer1.gif');
        @copy($dir_images.'/Restaurant1.gif', $dir_upload.'/Restaurant1.gif');
        @copy($dir_images.'/theatre1.gif', $dir_upload.'/theatre1.gif');
        @copy($dir_images.'/conference.jpg', $dir_upload.'/conference.jpg');
        @copy($dir_images.'/prehistoire.jpg', $dir_upload.'/prehistoire.jpg');
        @copy($dir_images.'/Chateau.jpg', $dir_upload.'/Chateau.jpg');


        //Thematique Fixtures
        $cinema = new Thematiques();
        $cinema->setTheme('Cinéma');
        $manager->persist($cinema);

        $theatre = new Thematiques();
        $theatre->setTheme('Théâtre');
        $manager->persist($theatre);

        $danse = new Thematiques();
        $danse->setTheme('Danse');
        $manager->persist($danse);

        $concert= new Thematiques();
        $concert->setTheme('Concert');
        $manager->persist($concert);

        $exposition= new Thematiques();
        $exposition->setTheme('Exposition');
        $manager->persist($exposition);

        $conference= new Thematiques();
        $conference->setTheme('Conférence');
        $manager->persist($conference);

        $sport= new Thematiques();
        $sport->setTheme('Sport');
        $manager->persist($sport);

        $autres= new Thematiques();
        $autres->setTheme('Autres');
        $manager->persist($autres);


        //Ville Fixtures
        $nantes = new Ville();
        $nantes->setNom("Nantes");
        $nantes->setCodePostal("44000");
        $manager->persist($nantes);

        $niort = new Ville();
        $niort->setNom("Niort");
        $niort->setCodePostal("79000");
        $manager->persist($niort);

        $rennes = new Ville();
        $rennes->setNom("Rennes");
        $rennes->setCodePostal("35000");
        $manager->persist($rennes);

        $quimper = new Ville();
        $quimper->setNom("Quimper");
        $quimper->setCodePostal("29000");
        $manager->persist($quimper);

        $lyon = new Ville();
        $lyon->setNom("Lyon");
        $lyon->setCodePostal("69000");
        $manager->persist($lyon);

        $strasbourg = new Ville();
        $strasbourg->setNom("Strasbourg");
        $strasbourg->setCodePostal("67000");
        $manager->persist($strasbourg);

        $lille = new Ville();
        $lille->setNom("Lille");
        $lille->setCodePostal("59000");
        $manager->persist( $lille);

        $poitiers = new Ville();
        $poitiers->setNom("Poitiers");
        $poitiers->setCodePostal("86000");
        $manager->persist($poitiers);

        $moulins = new Ville();
        $moulins->setNom("Moulins");
        $moulins->setCodePostal("03000");
        $manager->persist($moulins);

        $saintAignan = new Ville();
        $saintAignan->setNom("Saint-Aignan");
        $saintAignan->setCodePostal("41110");
        $manager->persist($saintAignan);


        //Campus Fixtures
        $campusNantes = new Campus();
        $campusNantes->setNom('Campus de Nantes');
        $manager->persist($campusNantes);

        $campusNiort = new Campus();
        $campusNiort->setNom('Campus de Niort');
        $manager->persist($campusNiort);

        $campusQuimper = new Campus();
        $campusQuimper->setNom('Campus de Quimper');
        $manager->persist($campusQuimper);

        $campusRennes = new Campus();
        $campusRennes->setNom('Campus de Rennes');
        $manager->persist($campusRennes);

        $campusEnLigne = new Campus();
        $campusEnLigne->setNom('Campus en ligne');
        $manager->persist($campusEnLigne);


        //Lieu Fixtures
        $cinema1 = new Lieu();
        $cinema1->setVille($niort);
        $cinema1->setNom("CGRNiort");
        $cinema1->setAdresse("Place de la Brèche");
        $cinema1->setLatitude(46.32242);
        $cinema1->setLongitude(-0.456899);
        $manager->persist($cinema1);

        $cinema2 = new Lieu();
        $cinema2->setVille($moulins);
        $cinema2->setNom("CGRMoulins");
        $cinema2->setAdresse("16, rue Marcellin Desboutin");
        $cinema2->setLatitude(46.564351);
        $cinema2->setLongitude(3.339655);
        $manager->persist($cinema2);

        $theatre1 = new Lieu();
        $theatre1->setVille($nantes);
        $theatre1->setNom("Théatre Nantes");
        $theatre1->setAdresse("6 rue des Carmélites");
        $theatre1->setLatitude(47.21666);
        $theatre1->setLongitude(-1.55145);
        $manager->persist( $theatre1);

        $zoo1 = new Lieu();
        $zoo1->setVille($saintAignan);
        $zoo1->setNom("Zooparc de Beauval");
        $zoo1->setAdresse("Avenue du Blanc");
        $zoo1->setLatitude(47.24801);
        $zoo1->setLongitude(1.35304);
        $manager->persist($zoo1);

        $piscine1 = new Lieu();
        $piscine1->setVille($rennes);
        $piscine1->setNom("Piscine Rennes");
        $piscine1->setAdresse("10 boulevard Albert 1er");
        $piscine1->setLatitude(48.08905);
        $piscine1->setLongitude(1.69100);
        $manager->persist( $piscine1);

        $piscine2 = new Lieu();
        $piscine2->setVille($rennes);
        $piscine2->setNom("Aquaworld Rennes");
        $piscine2->setAdresse("2 bis Rue du Bourg Nouveau");
        $piscine2->setLatitude(48.11594);
        $piscine2->setLongitude(1.71841);
        $manager->persist($piscine2);

        $parc1 = new Lieu();
        $parc1->setVille($quimper);
        $parc1->setNom("Parc et jardins du château");
        $parc1->setAdresse("90 All. de Lanniron");
        $parc1->setLatitude(47.97592);
        $parc1->setLongitude(4.11059);
        $manager->persist($parc1);

        $parc2 = new Lieu();
        $parc2->setVille($quimper);
        $parc2->setNom("Parc de la glisse");
        $parc2->setAdresse("131 Bd de Créac'h Gwen");
        $parc2->setLatitude(47.97390);
        $parc2->setLongitude(-4.09912);
        $manager->persist($parc2);

        $parc3 = new Lieu();
        $parc3->setVille($nantes);
        $parc3->setNom("Les machines de l'île");
        $parc3->setAdresse("Parc des Chantiers, Bd Léon Bureau");
        $parc3->setLatitude(47.20738);
        $parc3->setLongitude(-1.56425);
        $manager->persist($parc3);

        $expo1 = new Lieu();
        $expo1->setVille($nantes);
        $expo1->setNom("Muséum d'histoire Naturelle");
        $expo1->setAdresse("12 Rue Voltaire");
        $expo1->setLatitude(47.21355);
        $expo1->setLongitude(-1.56474);
        $manager->persist($expo1);


        //User Fixtures
        $admin = new User();
        $admin->setUsername('admin');
        $password = $this->hasher->hashPassword($admin, '123123');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsAdmin(true);
        $admin->setIsActive(true);
        $admin->setCampus($campusEnLigne);
        $manager->persist($admin);

        $toto = new User();
        $toto->setUsername('toto');
        $password = $this->hasher->hashPassword($toto, '123123');
        $toto->setPassword($password);
        $toto->setIsAdmin(false);
        $toto->setIsActive(true);
        $toto->setCampus($campusEnLigne);
        $manager->persist($toto);

        $sego = new User();
        $sego->setUsername('Sego');
        $password = $this->hasher->hashPassword($sego, '123123');
        $sego->setPassword($password);
        $sego->setIsAdmin(false);
        $sego->setIsActive(true);
        $sego->setCampus($campusNiort);
        $manager->persist($sego);

        $fred = new User();
        $fred->setUsername('Fred');
        $password = $this->hasher->hashPassword($fred, '123123');
        $fred->setPassword($password);
        $fred->setIsAdmin(false);
        $fred->setIsActive(true);
        $fred->setCampus($campusQuimper);
        $manager->persist($fred);

        $ivo = new User();
        $ivo->setUsername('Ivo');
        $password = $this->hasher->hashPassword($ivo, '123123');
        $ivo->setPassword($password);
        $ivo->setIsAdmin(false);
        $ivo->setIsActive(true);
        $ivo->setCampus($campusNantes);
        $manager->persist($ivo);

        $lulu = new User();
        $lulu->setUsername('Lulu');
        $password = $this->hasher->hashPassword($lulu, '123123');
        $lulu->setPassword($password);
        $lulu->setIsAdmin(false);
        $lulu->setIsActive(true);
        $lulu->setCampus($campusNantes);
        $manager->persist($lulu);

        $denis = new User();
        $denis->setUsername('Denis');
        $password = $this->hasher->hashPassword($denis, '123123');
        $denis->setPassword($password);
        $denis->setIsAdmin(false);
        $denis->setIsActive(true);
        $denis->setCampus($campusNantes);
        $manager->persist($denis);


        //Groupe Fixtures
        $groupe1 = new Groupe();
        $groupe1->setProprietaire($toto);
        $groupe1->addMembre($toto);
        $manager->persist($groupe1);

        //Photos ficture
        $photoPiscine = new Photo();
        $photoPiscine->setChemindd('piscine1.gif');
        $photoPiscine->setUser($toto);
        $photoPiscine->setIsProfilePicture(false);
        $photoCinema = new Photo();
        $photoCinema->setChemindd('cinema1.gif');
        $photoCinema->setUser($toto);
        $photoCinema->setIsProfilePicture(false);
        $photoConcert = new Photo();
        $photoConcert->setChemindd('concert1.gif');
        $photoConcert->setUser($toto);
        $photoConcert->setIsProfilePicture(false);
        $photoRando = new Photo();
        $photoRando->setChemindd('rando_mer1.gif');
        $photoRando->setUser($toto);
        $photoRando->setIsProfilePicture(false);
        $photoResto = new Photo();
        $photoResto->setChemindd('Restaurant1.gif');
        $photoResto->setUser($toto);
        $photoResto->setIsProfilePicture(false);
        $photoTheatre = new Photo();
        $photoTheatre->setChemindd('theatre1.gif');
        $photoTheatre->setUser($toto);
        $photoTheatre->setIsProfilePicture(false);
        $photoPrehistoire = new Photo();
        $photoPrehistoire->setChemindd('prehistoire.jpg');
        $photoPrehistoire->setUser($toto);
        $photoPrehistoire->setIsProfilePicture(false);
        $photoConf = new Photo();
        $photoConf ->setChemindd('conference.jpg');
        $photoConf ->setUser($toto);
        $photoConf ->setIsProfilePicture(false);
        $photoChateau = new Photo();
        $photoChateau ->setChemindd('Chateau.jpg');
        $photoChateau ->setUser($toto);
        $photoChateau ->setIsProfilePicture(false);


        $manager->persist($photoPiscine);
        $manager->persist($photoCinema);
        $manager->persist($photoConcert);
        $manager->persist($photoRando);
        $manager->persist($photoResto);
        $manager->persist($photoTheatre);
        $manager->persist($photoPrehistoire);
        $manager->persist($photoConf);
        $manager->persist($photoChateau);


        //Sortie Fixtures
        $sortieEnCours = new Sortie();
        $sortieEnCours->setNom("Natation débutant");
        $sortieEnCours->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieEnCours->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours->setDateCloture(new DateTime('2022-02-06'));
        $sortieEnCours->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours->setDateDebut(new DateTime('2022-02-20'));
        $sortieEnCours->setHeureDebut(new DateTime('14:00:00'));
        $sortieEnCours->setDateFin(new DateTime('2022-02-20'));
        $sortieEnCours->setHeureFin(new DateTime('16:00:00'));
        $sortieEnCours->setLimiteParticipants(5);
        $sortieEnCours->setInfosSortie("Cours initiation débutant");
        $sortieEnCours->setTheme($sport);
        $sortieEnCours->setCampus($campusRennes);
        $sortieEnCours->setOrganisateur($lulu);
        $sortieEnCours->setLieu($piscine1);
        $sortieEnCours->addParticipant($toto);
        $sortieEnCours->addPhoto($photoPiscine);
        $manager->persist($sortieEnCours);

        $sortieEnCours1 = new Sortie();
        $sortieEnCours1->setNom("Randonnée en bord de mer");
        $sortieEnCours1->setDateAnnonce(new DateTime('2022-02-13'));
        $sortieEnCours1->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours1->setDateCloture(new DateTime('2022-03-06'));
        $sortieEnCours1->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours1->setDateDebut(new DateTime('2022-04-20'));
        $sortieEnCours1->setHeureDebut(new DateTime('09:00:00'));
        $sortieEnCours1->setDateFin(new DateTime('2022-04-20'));
        $sortieEnCours1->setHeureFin(new DateTime('13:00:00'));
        $sortieEnCours1->setLimiteParticipants(15);
        $sortieEnCours1->setInfosSortie("Prévoir tenues adapatées (marche et pluie)");
        $sortieEnCours1->setTheme($sport);
        $sortieEnCours1->setCampus($campusQuimper);
        $sortieEnCours1->setOrganisateur($sego);
        $sortieEnCours1->setLieu($parc2);
        $sortieEnCours1->addParticipant($toto);
        $sortieEnCours1->addParticipant($lulu);
        $sortieEnCours1->addParticipant($sego);
        $sortieEnCours1->addParticipant($fred);
        $sortieEnCours1->addPhoto($photoRando);
        $manager->persist($sortieEnCours1);

        $sortieEnCours2 = new Sortie();
        $sortieEnCours2->setNom("Conférence sur la préhistoire");
        $sortieEnCours2->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieEnCours2->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours2->setDateCloture(new DateTime('2022-02-25'));
        $sortieEnCours2->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours2->setDateDebut(new DateTime('2022-03-20'));
        $sortieEnCours2->setHeureDebut(new DateTime('20:00:00'));
        $sortieEnCours2->setDateFin(new DateTime('2022-03-20'));
        $sortieEnCours2->setHeureFin(new DateTime('22:00:00'));
        $sortieEnCours2->setLimiteParticipants(5);
        $sortieEnCours2->setInfosSortie("Les premiers outils");
        $sortieEnCours2->setTheme($conference);
        $sortieEnCours2->setCampus($campusNantes);
        $sortieEnCours2->setOrganisateur($toto);
        $sortieEnCours2->setLieu($expo1);
        $sortieEnCours2->addParticipant($toto);
        $sortieEnCours2->addPhoto($photoPrehistoire);
        $manager->persist($sortieEnCours2);

        $sortieEnCours3 = new Sortie();
        $sortieEnCours3->setNom("Piscine");
        $sortieEnCours3->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieEnCours3->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours3->setDateCloture(new DateTime('2022-02-25'));
        $sortieEnCours3->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours3->setDateDebut(new DateTime('2022-03-21'));
        $sortieEnCours3->setHeureDebut(new DateTime('12:00:00'));
        $sortieEnCours3->setDateFin(new DateTime('2022-03-21'));
        $sortieEnCours3->setHeureFin(new DateTime('14:00:00'));
        $sortieEnCours3->setLimiteParticipants(5);
        $sortieEnCours3->setInfosSortie("Piscine toutes les semaines");
        $sortieEnCours3->setTheme($sport);
        $sortieEnCours3->setCampus($campusNiort);
        $sortieEnCours3->setOrganisateur($sego);
        $sortieEnCours3->setLieu($piscine1);
        $sortieEnCours3->addParticipant($toto);
        $sortieEnCours3->addPhoto($photoPiscine);
        $manager->persist($sortieEnCours3);

        $sortieEnCours4 = new Sortie();
        $sortieEnCours4->setNom("Piscine");
        $sortieEnCours4->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieEnCours4->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours4->setDateCloture(new DateTime('2022-02-30'));
        $sortieEnCours4->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours4->setDateDebut(new DateTime('2022-03-28'));
        $sortieEnCours4->setHeureDebut(new DateTime('12:00:00'));
        $sortieEnCours4->setDateFin(new DateTime('2022-03-28'));
        $sortieEnCours4->setHeureFin(new DateTime('14:00:00'));
        $sortieEnCours4->setLimiteParticipants(5);
        $sortieEnCours4->setInfosSortie("Piscine toutes les semaines");
        $sortieEnCours4->setTheme($sport);
        $sortieEnCours4->setCampus($campusNiort);
        $sortieEnCours4->setOrganisateur($sego);
        $sortieEnCours4->setLieu($piscine1);
        $sortieEnCours4->addParticipant($sego);
        $sortieEnCours4->addPhoto($photoPiscine);
        $manager->persist($sortieEnCours4);

        $sortieEnCours5 = new Sortie();
        $sortieEnCours5->setNom("Piscine");
        $sortieEnCours5->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieEnCours5->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours5->setDateCloture(new DateTime('2022-03-12'));
        $sortieEnCours5->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours5->setDateDebut(new DateTime('2022-04-04'));
        $sortieEnCours5->setHeureDebut(new DateTime('12:00:00'));
        $sortieEnCours5->setDateFin(new DateTime('2022-04-04'));
        $sortieEnCours5->setHeureFin(new DateTime('14:00:00'));
        $sortieEnCours5->setLimiteParticipants(5);
        $sortieEnCours5->setInfosSortie("Piscine toutes les semaines");
        $sortieEnCours5->setTheme($sport);
        $sortieEnCours5->setCampus($campusNiort);
        $sortieEnCours5->setOrganisateur($sego);
        $sortieEnCours5->setLieu($piscine1);
        $sortieEnCours5->addParticipant($lulu);
        $sortieEnCours5->addPhoto($photoPiscine);
        $manager->persist($sortieEnCours5);

        $sortieEnCours6 = new Sortie();
        $sortieEnCours6->setNom("Théatre L'avare");
        $sortieEnCours6->setDateAnnonce(new DateTime('2022-02-13'));
        $sortieEnCours6->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours6->setDateCloture(new DateTime('2022-02-25'));
        $sortieEnCours6->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours6->setDateDebut(new DateTime('2022-03-30'));
        $sortieEnCours6->setHeureDebut(new DateTime('20:00:00'));
        $sortieEnCours6->setDateFin(new DateTime('2022-03-30'));
        $sortieEnCours6->setHeureFin(new DateTime('23:00:00'));
        $sortieEnCours6->setLimiteParticipants(8);
        $sortieEnCours6->setInfosSortie("Une belle pièce!");
        $sortieEnCours6->setTheme($theatre);
        $sortieEnCours6->setCampus($campusNantes);
        $sortieEnCours6->setOrganisateur($fred);
        $sortieEnCours6->setLieu($theatre1);
        $sortieEnCours6->addParticipant($toto);
        $sortieEnCours6->addPhoto($photoTheatre);
        $manager->persist($sortieEnCours6);

        $sortieEnCours7 = new Sortie();
        $sortieEnCours7->setNom("Retour vers le futur2");
        $sortieEnCours7->setDateAnnonce(new DateTime('2022-02-17'));
        $sortieEnCours7->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours7->setDateCloture(new DateTime('2022-03-15'));
        $sortieEnCours7->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours7->setDateDebut(new DateTime('2022-03-21'));
        $sortieEnCours7->setHeureDebut(new DateTime('20:00:00'));
        $sortieEnCours7->setDateFin(new DateTime('2022-03-21'));
        $sortieEnCours7->setHeureFin(new DateTime('22:30:00'));
        $sortieEnCours7->setLimiteParticipants(10);
        $sortieEnCours7->setInfosSortie("c'est top!");
        $sortieEnCours7->setTheme($cinema);
        $sortieEnCours7->setCampus($campusNiort);
        $sortieEnCours7->setOrganisateur($toto);
        $sortieEnCours7->setLieu($cinema1);
        $sortieEnCours7->addParticipant($toto);
        $sortieEnCours7->addPhoto($photoCinema);
        $manager->persist($sortieEnCours7);

        $sortieEnCours8 = new Sortie();
        $sortieEnCours8->setNom("Impact du confinement chez les ados");
        $sortieEnCours8->setDateAnnonce(new DateTime('2022-02-17'));
        $sortieEnCours8->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours8->setDateCloture(new DateTime('2022-03-15'));
        $sortieEnCours8->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours8->setDateDebut(new DateTime('2022-03-21'));
        $sortieEnCours8->setHeureDebut(new DateTime('20:00:00'));
        $sortieEnCours8->setDateFin(new DateTime('2022-03-21'));
        $sortieEnCours8->setHeureFin(new DateTime('22:30:00'));
        $sortieEnCours8->setLimiteParticipants(10);
        $sortieEnCours8->setTheme($conference);
        $sortieEnCours8->setCampus($campusRennes);
        $sortieEnCours8->setOrganisateur($lulu);
        $sortieEnCours8->setLieu($theatre1);
        $sortieEnCours8->addParticipant($toto);
        $sortieEnCours8->addPhoto($photoConf);
        $manager->persist($sortieEnCours8);

        $sortieEnCours9 = new Sortie();
        $sortieEnCours9->setNom("Restaurant masqué");
        $sortieEnCours9->setDateAnnonce(new DateTime('2022-02-22'));
        $sortieEnCours9->setHeureCloture(new DateTime('20:00:00'));
        $sortieEnCours9->setDateCloture(new DateTime('2022-03-18'));
        $sortieEnCours9->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieEnCours9->setDateDebut(new DateTime('2022-03-22'));
        $sortieEnCours9->setHeureDebut(new DateTime('20:00:00'));
        $sortieEnCours9->setDateFin(new DateTime('2022-03-22'));
        $sortieEnCours9->setHeureFin(new DateTime('22:30:00'));
        $sortieEnCours9->setLimiteParticipants(8);
        $sortieEnCours9->setInfosSortie("Pensez au pass sanitaire!");
        $sortieEnCours9->setTheme($autres);
        $sortieEnCours9->setCampus($campusQuimper);
        $sortieEnCours9->setOrganisateur($toto);
        $sortieEnCours9->setLieu($cinema2);
        $sortieEnCours9->addParticipant($toto);
        $sortieEnCours9->addPhoto($photoResto);
        $manager->persist($sortieEnCours9);

        $sortieAnnulee = new Sortie();
        $sortieAnnulee->setNom("Star Wars");
        $sortieAnnulee->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieAnnulee->setHeureAnnonce(new DateTime('20:00:00'));
        $sortieAnnulee->setHeureCloture(new DateTime('20:00:00'));
        $sortieAnnulee->setDateCloture(new DateTime('2022-02-06'));
        $sortieAnnulee->setDateDebut(new DateTime('2022-02-20'));
        $sortieAnnulee->setHeureDebut(new DateTime('20:00:00'));
        $sortieAnnulee->setDateFin(new DateTime('2022-02-20'));
        $sortieAnnulee->setHeureFin(new DateTime('22:00:00'));
        $sortieAnnulee->setRaisonAnnulation("Cinéma fermé");
        $sortieAnnulee->setLimiteParticipants(20);
        $sortieAnnulee->setInfosSortie("Séance en 3D");
        $sortieAnnulee->setTheme($cinema);
        $sortieAnnulee->setCampus($campusNiort);
        $sortieAnnulee->setOrganisateur($sego);
        $sortieAnnulee->setLieu($cinema1);
        $sortieAnnulee->addPhoto($photoCinema);
        $manager->persist($sortieAnnulee);

        $sortieCloturee = new Sortie();
        $sortieCloturee->setNom("Concert U2");
        $sortieCloturee->setDateAnnonce(new DateTime('2022-02-02'));
        $sortieCloturee->setHeureAnnonce(new DateTime('19:00:00'));
        $sortieCloturee->setDateCloture(new DateTime('2022-02-15'));
        $sortieCloturee->setHeureCloture(new DateTime('14:32:00'));
        $sortieCloturee->setDateDebut(new DateTime('2022-02-19'));
        $sortieCloturee->setHeureDebut(new DateTime('21:00:00'));
        $sortieCloturee->setDateFin(new DateTime('2022-02-20'));
        $sortieCloturee->setHeureFin(new DateTime('23:00:00'));
        $sortieCloturee->setLimiteParticipants(4);
        $sortieCloturee->setInfosSortie("Places assises");
        $sortieCloturee->setTheme($concert);
        $sortieCloturee->setCampus($campusNantes);
        $sortieCloturee->setOrganisateur($ivo);
        $sortieCloturee->setLieu($theatre1);
        $sortieCloturee->addParticipant($lulu);
        $sortieCloturee->addParticipant($ivo);
        $sortieCloturee->addParticipant($fred);
        $sortieCloturee->addParticipant($sego);
        $sortieCloturee->addPhoto($photoConcert);
        $manager->persist($sortieCloturee);

        $sortieArchivee = new Sortie();
        $sortieArchivee->setNom("Visite du château");
        $sortieArchivee->setDateAnnonce(new DateTime('2020-12-12'));
        $sortieArchivee->setHeureAnnonce(new DateTime('19:00:00'));
        $sortieArchivee->setDateCloture(new DateTime('2020-05-02'));
        $sortieArchivee->setHeureCloture(new DateTime('14:32:00'));
        $sortieArchivee->setDateDebut(new DateTime('2020-01-01'));
        $sortieArchivee->setHeureDebut(new DateTime('10:00:00'));
        $sortieArchivee->setDateFin(new DateTime('2020-01-01'));
        $sortieArchivee->setHeureFin(new DateTime('11:00:00'));
        $sortieArchivee->setLimiteParticipants(5);
        $sortieArchivee->setInfosSortie("Pensez à prendre un parapluie pour la visite des jardins");
        $sortieArchivee->setTheme($autres);
        $sortieArchivee->setCampus($campusQuimper);
        $sortieArchivee->setOrganisateur($fred);
        $sortieArchivee->setLieu($parc1);
        $sortieArchivee->addPhoto($photoChateau);
        $manager->persist($sortieArchivee);



        $manager->flush();
    }

}
