<?php

namespace App\Models;

use App\Models\Traits\Created;
use App\Models\Traits\Updated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory, SoftDeletes, Created, Updated;

    protected $fillable = ['name', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::softDeleted(function ($project) {

            $userId = Auth::id();

            DB::table('tasks')->where('project_id', $project->id)->update([
                'deleted_by' => $userId,
                'deleted_at' => now()
            ]);

        });
    }

    function setId(int $id)
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    function getId()
    {
        return $this->attributes['id'];
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

    function setDescription(string $description)
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    function getDescription()
    {
        return $this->attributes['description'];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public static function findProjectById(int $id): ?self
    {
        return self::find($id);
    }

    public function deleteProject(): bool
    {
        return $this->delete();
    }

}
