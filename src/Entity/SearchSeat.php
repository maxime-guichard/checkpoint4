<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchSeat
{
    private ?string $name = '';

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
