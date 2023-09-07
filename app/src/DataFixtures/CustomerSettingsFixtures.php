<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Constants\CustomerFixturesConstants;
use App\Entity\CustomerSettings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerSettingsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $customerSettings = new CustomerSettings();
        $customerSettings->setEmail('john@example.com');
        $customerSettings->setPhoneNumber("37011111111");
        $customerSettings->setNotificationType('email');
        $customerSettings->setCustomer($this->getReference(CustomerFixturesConstants::CUSTOMER_FIXTURE_REFERENCE));

        $manager->persist($customerSettings);

        $customerSettings1 = new CustomerSettings();
        $customerSettings1->setEmail('jane@example.com');
        $customerSettings1->setPhoneNumber("37022222222");
        $customerSettings1->setNotificationType('sms');
        $customerSettings1->setCustomer($this->getReference(CustomerFixturesConstants::SECOND_CUSTOMER_FIXTURE_REFERENCE));

        $manager->persist($customerSettings1);

        $customerSettings2 = new CustomerSettings();
        $customerSettings2->setEmail('slackuser@example.com');
        $customerSettings2->setPhoneNumber("37033333333");
        $customerSettings2->setNotificationType('slack');
        $customerSettings2->setCustomer($this->getReference(CustomerFixturesConstants::THIRD_CUSTOMER_FIXTURE_REFERENCE));

        $manager->persist($customerSettings2);
        $manager->flush();
    }

    public function getDependencies(): iterable
    {
        return [CustomerFixtures::class];
    }
}
