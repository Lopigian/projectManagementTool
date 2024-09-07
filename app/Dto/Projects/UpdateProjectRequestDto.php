<?php

namespace App\Dto\Projects;

use Spatie\LaravelData\Data;

class UpdateProjectRequestDto extends Data
{
    public int $id;
    public string $name;
    public string $description;

    /**
     * @param int $id
     * @return $this
     */
    function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    function getId(): int
    {
        return $this->id;
    }

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
