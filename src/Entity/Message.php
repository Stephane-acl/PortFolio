<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Le nom ne devrait pas être vide")
     */
    private $message;

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

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $messageRead = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        if ($message) {
            $this->createdAt = new DateTime('now');
        }
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMessageRead(): ?bool
    {
        return $this->messageRead;
    }

    public function setMessageRead(bool $messageRead): self
    {
        $this->messageRead = $messageRead;

        return $this;
    }
}