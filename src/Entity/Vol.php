<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;


/**
 * @ORM\Entity(repositoryClass=VolRepository::class)
 * @ApiResource(
 *     formats={"json"},
 *     normalizationContext={"groups"={"oualid"}}
 * )
 * @ApiFilter(SearchFilter::class,properties={"start.name":"exact"})
 * @ApiFilter(SearchFilter::class,properties={"finish.name":"exact"})
 * @ApiFilter(RangeFilter::class,properties={"price"})
 */
class Vol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"oualid"})
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="vols")
     */
    private $start;

    /**
     * @Groups({"oualid"})
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="vols")
     */
    private $finish;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="string", length=255)
     */
    private $airport;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @Groups({"oualid"})
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?City
    {
        return $this->start;
    }

    public function setStart(?City $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?City
    {
        return $this->finish;
    }

    public function setFinish(?City $finish): self
    {
        $this->finish = $finish;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAirport(): ?string
    {
        return $this->airport;
    }

    public function setAirport(string $airport): self
    {
        $this->airport = $airport;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }
}
