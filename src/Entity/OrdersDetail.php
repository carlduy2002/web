<?php

namespace App\Entity;

use App\Repository\OrdersDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersDetailRepository::class)
 */
class OrdersDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="ordersDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Order_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="ordersDetails")
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

    public function getOrderID(): ?Orders
    {
        return $this->Order_ID;
    }

    public function setOrderID(?Orders $Order_ID): self
    {
        $this->Order_ID = $Order_ID;

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
