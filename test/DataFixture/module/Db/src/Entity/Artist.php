<?php

declare(strict_types=1);

namespace Db\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Artist
{
    protected $id;
    protected $name;
    protected $createdAt;
    protected $album;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->album = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $value)
    {
        $this->createdAt = $value;

        return $this;
    }

    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Add album
     *
     * @param \Db\Entity\Album $album
     *
     * @return Artist
     */
    public function addAlbum($album)
    {
        if ($album instanceof \Db\Entity\Album) {
            $this->album[] = $album;
        } elseif ($album instanceof ArrayCollection) {
            foreach ($album as $a) {
                if (! $a instanceof \Db\Entity\Album) {
                    throw new \Exception('Invalid type in addAlbum');
                }
                $this->album->add($a);
            }
        }

        return $this;
    }

    /**
     * Remove album
     *
     * @param \Db\Entity\Album $album
     */
    public function removeAlbum($album)
    {
        if ($album instanceof \Db\Entity\Album) {
            $this->album[] = $album;
        } elseif ($album instanceof ArrayCollection) {
            foreach ($album as $a) {
                if (! $a instanceof \Db\Entity\Album) {
                    throw new \Exception('Invalid type remove addAlbum');
                }
                $this->album->removeElement($a);
            }
        }
    }
}
