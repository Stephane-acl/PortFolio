<?php

namespace App\Entity;

use App\Repository\TechnoRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=TechnoRepository::class)
 * @Vich\Uploadable
 */
class Techno
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
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="techno_file", fileNameProperty="name")
     * @var File | null
     */
    private $technoFile;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, inversedBy="techno")
     */
    private $project;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $title;

    public function __construct()
    {
        $this->project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Project $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->project->contains($project)) {
            $this->project->removeElement($project);
        }

        return $this;
    }

    public function setTechnoFile(File $image = null):Techno
    {
        $this->technoFile = $image;
        if ($image) {
            $this->updateAt = new DateTime('now');
        }
        return $this;
    }

    public function getTechnoFile(): ?File
    {
        return $this->technoFile;
    }

    public function getUpdateAt(): ?\DateTime
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTime $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
