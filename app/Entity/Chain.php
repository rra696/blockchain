<?php

declare(strict_types=1);

namespace App\Entity;

class Chain
{
    private array $blocks;

    /**
     * @param array $blocks
     */
    public function __construct(array $blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * @return array
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * @param array $blocks
     * @return $this
     */
    public function update(array $blocks): self
    {
        $this->blocks = $blocks;
        return $this;
    }
}
