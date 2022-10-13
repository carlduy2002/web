<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Original_Price;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Sale_Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pro_Image;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Status;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Supplier_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="products")
     */
    private $Shop_ID;

    /**
     * @ORM\OneToMany(targetEntity=OrdersDetail::class, mappedBy="Product_ID")
     */
    private $ordersDetails;

    /**
     * @ORM\OneToMany(targetEntity=CartDetail::class, mappedBy="Product_ID")
     */
    private $cartDetails;

    public function __construct()
    {
        $this->ordersDetails = new ArrayCollection();
        $this->cartDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getOriginalPrice(): ?string
    {
        return $this->Original_Price;
    }

    public function setOriginalPrice(string $Original_Price): self
    {
        $this->Original_Price = $Original_Price;

        return $this;
    }

    public function getSalePrice(): ?string
    {
        return $this->Sale_Price;
    }

    public function setSalePrice(string $Sale_Price): self
    {
        $this->Sale_Price = $Sale_Price;

        return $this;
    }

    public function getProImage(): ?string
    {
        return $this->Pro_Image;
    }

    public function setProImage(string $Pro_Image): self
    {
        $this->Pro_Image = $Pro_Image;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getCategoryID(): ?Category
    {
        return $this->Category_ID;
    }

    public function setCategoryID(?Category $Category_ID): self
    {
        $this->Category_ID = $Category_ID;

        return $this;
    }

    public function getSupplierID(): ?Supplier
    {
        return $this->Supplier_ID;
    }

    public function setSupplierID(?Supplier $Supplier_ID): self
    {
        $this->Supplier_ID = $Supplier_ID;

        return $this;
    }

    public function getShopID(): ?Shop
    {
        return $this->Shop_ID;
    }

    public function setShopID(?Shop $Shop_ID): self
    {
        $this->Shop_ID = $Shop_ID;

        return $this;
    }

    /**
     * @return Collection<int, OrdersDetail>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->ordersDetails;
    }

    public function addOrdersDetail(OrdersDetail $ordersDetail): self
    {
        if (!$this->ordersDetails->contains($ordersDetail)) {
            $this->ordersDetails[] = $ordersDetail;
            $ordersDetail->setProductID($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetail $ordersDetail): self
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getProductID() === $this) {
                $ordersDetail->setProductID(null);
            }
        }

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
            $cartDetail->setProductID($this);
        }

        return $this;
    }

    public function removeCartDetail(CartDetail $cartDetail): self
    {
        if ($this->cartDetails->removeElement($cartDetail)) {
            // set the owning side to null (unless already changed)
            if ($cartDetail->getProductID() === $this) {
                $cartDetail->setProductID(null);
            }
        }

        return $this;
    }
}
