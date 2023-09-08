<?php

declare(strict_types=1);

namespace App\Repository\Customer\Interface;

use App\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null): ?Customer;

    public function findAll(): array;

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array;

    public function findOneBy(array $criteria, array $orderBy = null): ?Customer;

    public function findOneByCode(string $code): ?Customer;

    public function count(array $criteria = []): int;

    public function persist(Customer $customer): void;

    public function delete(Customer $customer): void;
}
