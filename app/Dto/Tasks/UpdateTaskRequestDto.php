<?php

namespace App\Dto\Tasks;

use Spatie\LaravelData\Data;

class UpdateTaskRequestDto extends Data
{
    public int $id;
    public int $projectId;
    public string $name;
    public int $status;
    public string $description;

    /**
     * @param int $projectId
     * @return $this
     */
    function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @return int
     */
    function getProjectId(): int
    {
        return $this->projectId;
    }

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
     * @param int $status
     * @return $this
     */
    function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    function getStatus(): int
    {
        return $this->status;
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
