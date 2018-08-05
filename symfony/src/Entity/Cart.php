<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientCartProduct", mappedBy="cart", orphanRemoval=true)
     */
    private $ClientProducts;

    public function __construct()
    {
        $this->ClientProducts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ClientCartProduct[]
     */
    public function getClientProducts(): Collection
    {
        return $this->ClientProducts;
    }

    public function addClientProduct(ClientCartProduct $clientProduct): self
    {
        if (!$this->ClientProducts->contains($clientProduct)) {
            $this->ClientProducts[] = $clientProduct;
            $clientProduct->setCart($this);
        }

        return $this;
    }

    public function removeClientProduct(ClientCartProduct $clientProduct): self
    {
        if ($this->ClientProducts->contains($clientProduct)) {
            $this->ClientProducts->removeElement($clientProduct);
            // set the owning side to null (unless already changed)
            if ($clientProduct->getCart() === $this) {
                $clientProduct->setCart(null);
            }
        }

        return $this;
    }
}
