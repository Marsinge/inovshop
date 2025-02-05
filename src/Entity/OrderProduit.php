<?php

namespace App\Entity;

use App\Repository\OrderProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderProduitRepository::class)]
class OrderProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'orderProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $commande = null;

    #[ORM\Column]
    private ?int $qte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getCommande(): ?Order
    {
        return $this->commande;
    }

    public function setCommande(?Order $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): static
    {
        $this->qte = $qte;

        return $this;
    }
}
