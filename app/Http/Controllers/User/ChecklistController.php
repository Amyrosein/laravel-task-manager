<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Services\ChecklistService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function show(Checklist $checklist) : View
    {
        // sync checklists
        (new ChecklistService())->sync_checklist($checklist, auth()->id());

        return view('users.checklists.show', compact('checklist'));
    }
}
