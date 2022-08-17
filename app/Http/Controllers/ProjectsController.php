<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function list(Request $request): Collection|array
    {
        $search = $request->get('search');

        $query = Project::query();

        if($search){
            $query = $query->where('title', 'LIKE', '%' . $search . '%');
        }

        return $query->get();
    }
}
