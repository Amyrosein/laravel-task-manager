<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRequest;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{

    public function index()
    {
        //
    }


    public function create(ChecklistGroup $checklistGroup)
    {
        return view('admin.checklists.create', compact('checklistGroup'));
    }


    public function store(StoreChecklistRequest $request, ChecklistGroup $checklistGroup)
    {
        $checklistGroup->checklists()->create($request->validated());

        return redirect()->route('dashboard');
    }


    public function show(string $id, ChecklistGroup $checklistGroup)
    {
        //
    }


    public function edit(ChecklistGroup $checklistGroup, Checklist $checklist)
    {
        $checklist->load('tasks');
        return view('admin.checklists.edit', compact('checklist', 'checklistGroup'));
    }


    public function update(StoreChecklistRequest $request, ChecklistGroup $checklistGroup, Checklist $checklist)
    {
        $checklist->update($request->validated());

        return redirect()->route('dashboard');
    }


    public function destroy(ChecklistGroup $checklistGroup, Checklist $checklist)
    {
        $checklist->delete();

        return redirect()->route('dashboard');
    }
}
