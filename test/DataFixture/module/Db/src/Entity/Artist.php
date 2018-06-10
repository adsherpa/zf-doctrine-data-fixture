<?php

declare(strict_types=1);

namespace Db\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Artist extends AbstractEntity
{
    /**
     * @var ArrayCollection
     */
    protected $albums;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albums = new ArrayCollection;
    }

    /**
     * Get albums
     *
     * @return ArrayCollection
     */
    public function getAlbums(): ArrayCollection
    {
        return $this->albums;
    }

    /**
     * Add an album
     *
     * @param Album $album
     *
     * @return void
     */
    public function addAlbum(Album $album): void
    {
        $this->albums->set($album->getId(), $album);
    }

    /**
     * Add many albums
     *
     * @param ArrayCollection $albums
     *
     * @return void
     */
    public function addAlbums(ArrayCollection $albums): void
    {
        foreach ($albums as $album) {
            $this->addAlbum($album);
        }
    }

    /**
     * Remove an album
     *
     * @param Album $album
     *
     * @return void
     */
    public function removeAlbum(Album $album): void
    {
        $this->albums->remove($album->getId());
    }

    /**
     * Remove many albums
     *
     * @param ArrayCollection $albums
     *
     * @return void
     */
    public function removeAlbums(ArrayCollection $albums): void
    {
        foreach ($albums as $album) {
            $this->removeAlbum($album);
        }
    }
}
