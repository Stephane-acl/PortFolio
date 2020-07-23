<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 */
class Projects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(max="45", allowEmptyString="false", maxMessage="Ce champ est trop long")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Pictures::class,
     *     mappedBy="projects",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     *     )
     */
    private $pictures;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clients;

    /**
     * @ORM\ManyToMany(targetEntity=Technos::class, mappedBy="projects")
     */
    private $technos;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->technos = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProjects($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProjects() === $this) {
                $picture->setProjects(null);
            }
        }

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    /**
     * @return Collection|Technos[]
     */
    public function getTechnos(): Collection
    {
        return $this->technos;
    }

    public function addTechno(Technos $techno): self
    {
        if (!$this->technos->contains($techno)) {
            $this->technos[] = $techno;
            $techno->addProject($this);
        }

        return $this;
    }

    public function removeTechno(Technos $techno): self
    {
        if ($this->technos->contains($techno)) {
            $this->technos->removeElement($techno);
            $techno->removeProject($this);
        }

        return $this;
    }
}
