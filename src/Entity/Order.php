<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $orderAt = null;

    /**
     * @var Collection<int, OrderProduit>
     */
    #[ORM\OneToMany(targetEntity: OrderProduit::class, mappedBy: 'commande')]
    private Collection $orderProduits;

    public function __construct()
    {
        $this->orderProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getOrderAt(): ?\DateTimeImmutable
    {
        return $this->orderAt;
    }

    public function setOrderAt(\DateTimeImmutable $orderAt): static
    {
        $this->orderAt = $orderAt;

        return $this;
    }

    /**
     * @return Collection<int, OrderProduit>
     */
    public function getOrderProduits(): Collection
    {
        return $this->orderProduits;
    }

    public function addOrderProduit(OrderProduit $orderProduit): static
    {
        if (!$this->orderProduits->contains($orderProduit)) {
            $this->orderProduits->add($orderProduit);
            $orderProduit->setCommande($this);
        }

        return $this;
    }

    public function removeOrderProduit(OrderProduit $orderProduit): static
    {
        if ($this->orderProduits->removeElement($orderProduit)) {
            // set the owning side to null (unless already changed)
            if ($orderProduit->getCommande() === $this) {
                $orderProduit->setCommande(null);
            }
        }

        return $this;
    }
}
