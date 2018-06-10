<?php

declare(strict_types=1);

namespace Db\Entity;

/**
 * Test Class Album
 *
 * @package Db\Entity
 */
class Album extends AbstractEntity
{

    /**
     * @var string
     */
    protected $artist;

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * Set artist
     *
     * @param string $value
     *
     * @return void
     */
    public function setArtist(string $value): void
    {
        $this->artist = $value;
    }
}
