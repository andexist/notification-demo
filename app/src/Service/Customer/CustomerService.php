<?php

declare(strict_types=1);

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Exception\MissingResourceException;
use App\Repository\Customer\Interface\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {}

    public function find(int $id): Customer
    {
        if ($customer = $this->customerRepository->find($id)) {
            return $customer;
        }

        throw new MissingResourceException(Customer::class, (string)$id);
    }

    public function findOneByCode(string $code): Customer
    {
        if ($customer = $this->customerRepository->findOneByCode($code)) {
            return $customer;
        }

        throw new MissingResourceException(Customer::class, $code);
    }
}
