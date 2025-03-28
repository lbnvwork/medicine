<?php

namespace App\Repository;

use App\Entity\AuthUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method AuthUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthUser[]    findAll()
 * @method AuthUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private $passwordEncoder;

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($registry, AuthUser::class);
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof AuthUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Добавление пользователя
     */
    public function addUserFromFixtures(
        string $phone,
        string $firstName,
        string $lastName,
        string $role,
        string $password,
        bool $enabled
    ): ?AuthUser {

        $user = (new AuthUser())
            ->setPhone($phone)
            ->setEnabled($enabled);
        $user
            ->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $password
                )
            )
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setRoles($role);
        $this->_em->persist($user);

        return $user;
    }

    public function addUserFromAdmin(Form $form, AuthUser $user)
    {
        $data = $form->getData();
        /** @var AuthUser $authUser */
        $authUser = $data['authUser'];
        /** @var AuthUser $onlyRole */
        $onlyRole = $data['onlyRole'];
        $authUser->setRoles($onlyRole->getRoles()[0]);
        // See https://symfony.com/doc/current/security.html#c-encoding-passwords
        $encodedPassword = $this->passwordEncoder->encodePassword($authUser, $authUser->getPassword());
        $authUser->setPassword($encodedPassword);
        $this->_em->persist($authUser);
    }
}
