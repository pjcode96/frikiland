<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Entity\User;
use App\Entity\Posts;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $published_at = null;

    #[ManyToOne(targetEntity: Posts::class, inversedBy: 'comments')]
    #[JoinColumn(name: 'post_id', referencedColumnName:'id')]
    private Posts|null $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeInterface $published_at): static
    {
        $this->published_at = $published_at;

        return $this;
    }
}
