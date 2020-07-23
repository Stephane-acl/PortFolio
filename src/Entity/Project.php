<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     *     targetEntity=Picture::class,
     *     mappedBy="project",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     *     )
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="project")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=Techno::class, mappedBy="project")
     */
    private $techno;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
        $this->techno = new ArrayCollection();
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
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
            $picture->setProject($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->picture->contains($picture)) {
            $this->picture->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProject() === $this) {
                $picture->setProject(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Techno[]
     */
    public function getTechno(): Collection
    {
        return $this->techno;
    }

    public function addTechno(Techno $techno): self
    {
        if (!$this->techno->contains($techno)) {
            $this->techno[] = $techno;
            $techno->addProject($this);
        }

        return $this;
    }

    public function removeTechno(Techno $techno): self
    {
        if ($this->techno->contains($techno)) {
            $this->techno->removeElement($techno);
            $techno->removeProject($this);
        }

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
