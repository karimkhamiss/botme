<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client extends EntityBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="client", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientCartProduct", mappedBy="client", orphanRemoval=true)
     */
    private $CartProduct;

    public function __construct()
    {
        $this->CartProduct = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    public function getName()
    {
        return $this->getUser()->getFirstname()." ".$this->getUser()->getLastname();
    }
    /**
     * @return Collection|ClientCartProduct[]
     */
    public function getCartProduct(): Collection
    {
        return $this->CartProduct;
    }

    public function addCartProduct(ClientCartProduct $cartProduct): self
    {
        if (!$this->CartProduct->contains($cartProduct)) {
            $this->CartProduct[] = $cartProduct;
            $cartProduct->setClient($this);
        }

        return $this;
    }

    public function removeCartProduct(ClientCartProduct $cartProduct): self
    {
        if ($this->CartProduct->contains($cartProduct)) {
            $this->CartProduct->removeElement($cartProduct);
            // set the owning side to null (unless already changed)
            if ($cartProduct->getClient() === $this) {
                $cartProduct->setClient(null);
            }
        }

        return $this;
    }
}
