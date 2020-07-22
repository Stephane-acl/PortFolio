<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le nom ne devrait pas être vide")
     * @Assert\Length(max="255", maxMessage="Le nom ne devrait pas dépasser {{ limit }} caractères")
     */
    private $messages;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank(message="Le nom ne devrait pas être vide")
     * @Assert\Length(max="45", maxMessage="Le nom ne devrait pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom ne devrait pas être vide")
     * @Assert\Length(max="255", allowEmptyString="false")
     * @Assert\Email(message="Veuillez rentrer une adresse mail valide")
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessages(): ?string
    {
        return $this->messages;
    }

    public function setMessages(?string $messages): self
    {
        $this->messages = $messages;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
