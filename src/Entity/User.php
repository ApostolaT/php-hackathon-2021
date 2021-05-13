<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @Groups("user")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=13)
     */
    private $cnp;

    /**
     *
     * @ORM\ManyToMany(targetEntity=Programme::class, mappedBy="participants")
     */
    private $programmes;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }

    /**
     * @Groups("user")
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Groups("user")
     * @return string|null
     */
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
     * @Groups("user")
     * @return string|null
     */
    public function getCnp(): ?string
    {
        return $this->cnp;
    }

    public function setCnp(string $cnp): self
    {
        $this->cnp = $cnp;

        return $this;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->addParticipant($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            $programme->removeParticipant($this);
        }

        return $this;
    }
}
