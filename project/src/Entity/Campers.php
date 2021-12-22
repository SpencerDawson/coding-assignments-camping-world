<?php

namespace App\Entity;
use App\Entity\Documents;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campers
 *
 * @ORM\Table(name="campers", indexes={@ORM\Index(name="IDX_741E74A0895648BC", columns={"doc_id"})})
 * @ORM\Entity
 */
class Campers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="campers_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=250, nullable=false)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=250, nullable=false)
     */
    private $brand;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer", nullable=false)
     */
    private $capacity;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @var \Documents
     *
     * @ORM\ManyToOne(targetEntity="Documents")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doc_id", referencedColumnName="id")
     * })
     */
    private $doc;

    public function __construct()
    {
      $this->createAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getDoc(): ?Documents
    {
        return $this->doc;
    }

    public function setDoc(?Documents $doc): self
    {
        $this->doc = $doc;

        return $this;
    }


}
