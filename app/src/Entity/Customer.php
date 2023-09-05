<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $code = null;

    #[ORM\OneToOne(mappedBy: 'Customer', cascade: ['persist', 'remove'])]
    private ?CustomerSettings $customerSettings = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCustomerSettings(): ?CustomerSettings
    {
        return $this->customerSettings;
    }

    public function setCustomerSettings(?CustomerSettings $customerSettings): static
    {
        // unset the owning side of the relation if necessary
        if ($customerSettings === null && $this->customerSettings !== null) {
            $this->customerSettings->setCustomer(null);
        }

        // set the owning side of the relation if necessary
        if ($customerSettings !== null && $customerSettings->getCustomer() !== $this) {
            $customerSettings->setCustomer($this);
        }

        $this->customerSettings = $customerSettings;

        return $this;
    }
}
