<?php

namespace App\Entity;

use App\Repository\CartDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartDetailRepository::class)
 */
class CartDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Cart_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="cartDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Product_ID;

    /**
     * @ORM\Column(type="integer")
     */
    private $Qty_Pro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartID(): ?Cart
    {
        return $this->Cart_ID;
    }

    public function setCartID(?Cart $Cart_ID): self
    {
        $this->Cart_ID = $Cart_ID;

        return $this;
    }

    public function getProductID(): ?Product
    {
        return $this->Product_ID;
    }

    public function setProductID(?Product $Product_ID): self
    {
        $this->Product_ID = $Product_ID;

        return $this;
    }

    public function getQtyPro(): ?int
    {
        return $this->Qty_Pro;
    }

    public function setQtyPro(int $Qty_Pro): self
    {
        $this->Qty_Pro = $Qty_Pro;

        return $this;
    }
}
