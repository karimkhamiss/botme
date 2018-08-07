<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    /**
     *   Get Total of the shopping cart by using client_id and subtotal of each product
     */
    public function getTotal($client_id)
    {
        $total = 0;
        $counter = 0;
        $client_cart_product_array = $this->getClientProducts();
        foreach ($client_cart_product_array as $client_cart_product_to_item)
        {
            if($client_cart_product_to_item->getClient()->getId() == $client_id)
            {
                $total += $client_cart_product_to_item->getSubTotal();
                $counter += 1;
            }
        }
        if($this->id == 1)
        return $total;
        else
            return $counter;
    }
}
