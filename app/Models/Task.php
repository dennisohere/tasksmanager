<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function setTaskPriority($priority = null, $project_id = null)
    {
        if(!$priority){
            $max_priority_query = self::query();
            if($project_id){
                $max_priority_query = $max_priority_query->where('project_id', $project_id);
            }
            $priority = $max_priority_query->max('priority') + 1;
        }

        $this->priority = $priority;
    }
}
