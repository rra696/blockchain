<?php

declare(strict_types=1);

namespace App\Services\Chain\Storage;

use App\Entity\Chain;

interface Storage
{
    /**
     * @param Chain $chain
     */
    public function save(Chain $chain): void;

    /**
     * @return Chain
     */
    public function get(): Chain;
}
