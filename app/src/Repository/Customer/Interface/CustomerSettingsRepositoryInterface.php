<?php

declare(strict_types=1);

namespace App\Repository\Customer\Interface;

use App\Entity\CustomerSettings;

interface CustomerSettingsRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null): ?CustomerSettings;

    public function findAll(): array;

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array;

    public function findOneBy(array $criteria, array $orderBy = null): ?CustomerSettings;

    public function count(array $criteria = []): int;

    public function persist(CustomerSettings $customerSettings): void;

    public function delete(CustomerSettings $customerSettings): void;
}
