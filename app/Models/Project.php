<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property string title
 * @property string slug
 * @property string description
 * @property int id
 *
 * @property-read Collection|Task[] $tasks
 */
class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    protected static function booted()
    {
        static::saving(function($project){
            /** @var self $project */
            $project->slug = Str::slug($project->title);
        });
    }
}
