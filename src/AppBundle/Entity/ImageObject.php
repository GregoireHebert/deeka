<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An image file.
 * 
 * @see http://schema.org/ImageObject Documentation on Schema.org
 * 
 * @ORM\Entity
 * @Iri("http://schema.org/ImageObject")
 */
class ImageObject
{
    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string Actual bytes of the media object, for example the image file or video file.
     * 
     * @ORM\Column(nullable=true)
     * @Assert\Url
     * @Iri("https://schema.org/contentUrl")
     */
    private $contentUrl;
    /**
     * @var \DateTime Date of first broadcast/publication.
     * 
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     * @Iri("https://schema.org/datePublished")
     */
    private $datePublished;
    /**
     * @var string A short description of the item.
     * 
     * @ORM\Column(nullable=true)
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/description")
     */
    private $description;
    /**
     * @var string The name of the item.
     * 
     * @ORM\Column(nullable=true)
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/name")
     */
    private $name;
    /**
     * @var string A thumbnail image relevant to the Thing.
     * 
     * @ORM\Column(nullable=true)
     * @Assert\Url
     * @Iri("https://schema.org/thumbnailUrl")
     */
    private $thumbnailUrl;

    /**
     * Sets id.
     * 
     * @param int $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets id.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets contentUrl.
     * 
     * @param string $contentUrl
     * 
     * @return $this
     */
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    /**
     * Gets contentUrl.
     * 
     * @return string
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * Sets datePublished.
     * 
     * @param \DateTime $datePublished
     * 
     * @return $this
     */
    public function setDatePublished(\DateTime $datePublished = null)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Gets datePublished.
     * 
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Sets description.
     * 
     * @param string $description
     * 
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets description.
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets name.
     * 
     * @param string $name
     * 
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets name.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets thumbnailUrl.
     * 
     * @param string $thumbnailUrl
     * 
     * @return $this
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Gets thumbnailUrl.
     * 
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }
}
