<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $Username;

    /**
     * @ORM\OneToMany(targetEntity=CartDetail::class, mappedBy="Cart_ID")
     */
    private $cartDetails;

    public function __construct()
    {
        $this->cartDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?User
    {
        return $this->Username;
    }

    public function setUsername(?User $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    /**
     * @return Collection<int, CartDetail>
     */
    public function getCartDetails(): Collection
    {
        return $this->cartDetails;
    }

    public function addCartDetail(CartDetail $cartDetail): self
    {
        if (!$this->cartDetails->contains($cartDetail)) {
            $this->cartDetails[] = $cartDetail;
            $cartDetail->setCartID($this);
        }

        return $this;
    }

    public function removeCartDetail(CartDetail $cartDetail): self
    {
        if ($this->cartDetails->removeElement($cartDetail)) {
            // set the owning side to null (unless already changed)
            if ($cartDetail->getCartID() === $this) {
                $cartDetail->setCartID(null);
            }
        }

        return $this;
    }
}
