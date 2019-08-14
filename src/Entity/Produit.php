<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Entity\File as EmbededFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @Vich\Uploadable()
 */
class Produit
{
    public function __construct()
    {
        $this->image = new EmbededFile();
        $this->image2 = new EmbededFile();
        $this->image3 = new EmbededFile();
        $this->hashtags = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"titre"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez ajouter un titre..")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez ajouter une description..")
     */
    private $description;

    /**
     *
     * @Vich\UploadableField(mapping="produit_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     *
     * @var File
     */
    private $imageFile;

    /**
     *
     * @Vich\UploadableField(mapping="produit_image2", fileNameProperty="image2.name", size="image2.size", mimeType="image2.mimeType", originalName="image2.originalName", dimensions="image2.dimensions")
     *
     * @var File
     */
    private $imageFile2;

    /**
     *
     * @Vich\UploadableField(mapping="produit_image3", fileNameProperty="image3.name", size="image3.size", mimeType="image3.mimeType", originalName="image3.originalName", dimensions="image3.dimensions")
     *
     * @var File
     */
    private $imageFile3;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image2;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image3;

    /**
     * @ORM\ManyToMany(targetEntity="Hashtag")
     */
    private $hashtags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param EmbeddedFile $image
     */
    public function setImage(EmbeddedFile $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbededFile
    {
        return $this->image;
    }

    public function setImageFile2(?File $imageFile = null): void
    {
        $this->imageFile2 = $imageFile;
    }

    /**
     * @return File
     */
    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
    }

    public function setImage2(EmbededFile $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage2(): ?EmbededFile
    {
        return $this->image2;
    }

    public function setImage3(EmbededFile $image2): self
    {
        $this->image3 = $image2;

        return $this;
    }

    public function getImage3(): ?EmbededFile
    {
        return $this->image3;
    }

    public function setImageFile3(?File $imageFile = null): void
    {
        $this->imageFile3 = $imageFile;
    }

    /**
     * @return File
     */
    public function getImageFile3(): ?File
    {
        return $this->imageFile3;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Hashtag[]
     */
    public function getHashtags(): Collection
    {
        return $this->hashtags;
    }

    public function addHashtag(Hashtag $hashtag): self
    {
        if (!$this->hashtags->contains($hashtag)) {
            $this->hashtags[] = $hashtag;
        }

        return $this;
    }

    public function removeHashtag(Hashtag $hashtag): self
    {
        if ($this->hashtags->contains($hashtag)) {
            $this->hashtags->removeElement($hashtag);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
