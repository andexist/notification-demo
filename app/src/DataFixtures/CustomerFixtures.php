<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Constants\CustomerFixturesConstants;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Customer;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName("John Doe");
        $customer->setCode('123');

        $manager->persist($customer);

        $customer1 = new Customer();
        $customer1->setName("Jane Doe");
        $customer1->setCode('456');

        $manager->persist($customer1);

        $customer2 = new Customer();
        $customer2->setName("Matt Doe");
        $customer2->setCode('789');

        $manager->persist($customer2);

        $manager->flush();

        $this->addReference(CustomerFixturesConstants::CUSTOMER_FIXTURE_REFERENCE, $customer);
        $this->addReference(CustomerFixturesConstants::SECOND_CUSTOMER_FIXTURE_REFERENCE, $customer1);
        $this->addReference(CustomerFixturesConstants::THIRD_CUSTOMER_FIXTURE_REFERENCE, $customer2);
    }
}
