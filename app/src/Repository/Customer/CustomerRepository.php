<?php

namespace App\Repository\Customer;

use App\Entity\Customer;
use App\Repository\Customer\Interface\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Customer
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

    public function findOneBy(array $criteria, array $orderBy = null): ?Customer
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function count(array $criteria = []): int
    {
        return parent::count($criteria);
    }

    public function persist(Customer $customer): void
    {
        $em = $this->getEntityManager();
        $em->persist($customer);
        $em->flush();
    }

    public function delete(Customer $customer): void
    {
        $em = $this->getEntityManager();
        $em->remove($customer);
        $em->flush();
    }
}
