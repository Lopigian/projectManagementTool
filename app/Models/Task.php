<?php

namespace App\Models;

use App\Models\Traits\Created;
use App\Models\Traits\Updated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, Created, Updated;

    protected $fillable = ['project_id', 'name', 'description', 'status'];

    function setId(int $id)
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    function getId()
    {
        return $this->attributes['id'];
    }

    function setProjectId(int $projectId)
    {
        $this->attributes['project_id'] = $projectId;
        return $this;
    }

    function getProjectId()
    {
        return $this->attributes['project_id'];
    }

    function setName(string $name)
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    function getName()
    {
        return $this->attributes['name'];
    }

    function setStatus(int $status)
    {
        $this->attributes['status'] = $status;
        return $this;
    }

    function getStatus()
    {
        return $this->attributes['status'];
    }

    function setDescription(string $description)
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    function getDescription()
    {
        return $this->attributes['description'];
    }


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public static function findTaskById(int $id): ?self
    {
        return self::find($id);
    }

    public function deleteTask(): bool
    {
        return $this->delete();
    }
}
