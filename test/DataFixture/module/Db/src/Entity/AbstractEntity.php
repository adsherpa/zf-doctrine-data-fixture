<?php

declare(strict_types=1);

namespace Db\Entity;

/**
 * Abstract test entity
 *
 * @package Db\Entity
 */
abstract class AbstractEntity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTimeImmutable
     */
    protected $createdAt;

    /**
     * Get identity
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param $value
     * @return void
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * Get created at
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set created at
     *
     * @param \DateTimeImmutable $value
     *
     * @return void
     */
    public function setCreatedAt(\DateTimeImmutable $value): void
    {
        $this->createdAt = $value;
    }
}
