<?php

namespace App\Dto\Projects;

use Spatie\LaravelData\Data;

class CreateProjectRequestDto extends Data
{
    public string $name;
    public string $description;

    /**
     * @param string $name
     * @return $this
     */
    function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $description
     * @return $this
     */
    function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    function getDescription(): string
    {
        return $this->description;
    }

}
