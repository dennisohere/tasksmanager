<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int id
 * @property int priority
 * @property int project_id
 *
 * @property-read Project $project
 */
class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
