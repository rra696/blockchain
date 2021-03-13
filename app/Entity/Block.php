<?php

declare(strict_types=1);

namespace App\Entity;

class Block
{
    public int $index;
    public string $hash;
    public string $previousHash;
    public int $timestamp;
    public string $data;

    /**
     * @param int $index
     * @param string $previousHash
     * @param string $data
     */
    public function __construct(int $index, string $previousHash, string $data)
    {
        $this->index = $index;
        $this->previousHash = $previousHash;
        $this->data = $data;
        $this->timestamp = time();
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash): self
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getPreviousHash(): string
    {
        return $this->previousHash;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
