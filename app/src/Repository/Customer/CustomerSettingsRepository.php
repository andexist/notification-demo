<?php

namespace App\Repository\Customer;

use App\Entity\CustomerSettings;
use App\Repository\Customer\Interface\CustomerSettingsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CustomerSettings>
 *
 * @method CustomerSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSettings[]    findAll()
 * @method CustomerSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerSettingsRepository extends ServiceEntityRepository implements CustomerSettingsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSettings::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?CustomerSettings
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?CustomerSettings
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function count(array $criteria = []): int
    {
        return parent::count($criteria);
    }

    public function persist(CustomerSettings $customerSettings): void
    {
        $em = $this->getEntityManager();
        $em->persist($customerSettings);
        $em->flush();
    }

    public function delete(CustomerSettings $customerSettings): void
    {
        $em = $this->getEntityManager();
        $em->remove($customerSettings);
        $em->flush();
    }
}
