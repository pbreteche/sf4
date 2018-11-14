<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Les titres, c'est trop nul")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\IsNull(groups={"publication"})
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=50)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @Assert\IsTrue(
     *     message="Le contenu doit être 2x plus long que le titre",
     *     groups={"publication"}
     * )
     */
    public function isContentTwiceAsLongAsTitle()
    {
        $contentLength = mb_strlen($this->content);
        $titleLength = mb_strlen($this->title);
        return  $titleLength && $contentLength / $titleLength >= 2;
    }
}
