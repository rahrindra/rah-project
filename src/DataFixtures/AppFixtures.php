<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $userPassword = $this->encoder->encodePassword($user, 'pass');
        $user->setPassword($userPassword);

        // le commerçant
        $partner = new User();
        $partner->setEmail('partner@gmail.com');
        $partner->setRoles(['ROLE_PARTNER']);
        $partnerPassword = $this->encoder->encodePassword($partner, 'pass');
        $partner->setPassword($partnerPassword);

        // l'admininstrateur RAH
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $adminPassword = $this->encoder->encodePassword($admin, 'pass');
        $admin->setPassword($adminPassword);

        $manager->persist($user);
        $manager->persist($partner);
        $manager->persist($admin);
        $manager->flush();
    }
}
