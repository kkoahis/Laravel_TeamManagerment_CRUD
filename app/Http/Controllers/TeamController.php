<?php

namespace App\Http\Controllers;

use App\Exports\TeamsExport;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    //
    public function index()
    {
        $teams = \App\Models\Team::all();

        return view('team.index', compact('teams'));
    }

    public function add()
    {
        $teams = \App\Models\Team::all();
        $departments = \App\Models\Department::all();

        return view('team.add', compact('teams', 'departments'));
    }

    public function store(Request $request)
    {
        if ($request->id == null || $request->name == null) {
            return redirect()->route('team.add')->with('error', 'ID và Name không được để trống');
        }

        $team = new \App\Models\Team;
        $team->id = $request->id;
        $team->name = $request->name;
        $team->department_id = $request->department_id;

        // Check if the new ID is the same as the id of an existing team
        $existingTeam = \App\Models\Team::find($team->id);
        if ($existingTeam) {
            return redirect()->route('team.add')->with('error', 'Team ID đã tồn tại');
        }

        $team->save();

        return redirect()->route('team.add')->with('success', 'Team has been added');
    }

    public function edit()
    {
        $teams = \App\Models\Team::all();
        $departments = \App\Models\Department::all();

        return view('team.edit', compact('teams', 'departments'));
    }

    public function update(Request $request)
    {
        if ($request->teamName == null || $request->teamId == null) {
            return redirect()->route('team.edit')->with('error', 'ID và Name không được để trống');
        }

        $team = \App\Models\Team::find($request->teamId);
        $team->name = $request->teamName;

        // seaerch for the department id with the given name
        $department = \App\Models\Department::where('name', $request->department_name)->first();
        $team->department_id = $department->id;

        $team->save();

        return redirect()->route('team.edit')->with('success', 'Team has been updated');
    }

    public function delete(Request $request)
    {
        if ($request->teamId == null) {
            return redirect()->route('team.index')->with('error', 'Hãy chọn team cần xóa');
        }

        $team = \App\Models\Team::find($request->teamId);
        $team->delete();

        return redirect()->route('team.index')->with('success', 'Team has been deleted');
    }

    public function search()
    {
        $teams = \App\Models\Team::all();

        return view('team.search', ['teams' => $teams]);
    }

    public function searchResult(Request $request)
    {
        $keyword = $request->teamId;
        $teamSearch = \App\Models\Team::where('id', 'like', '%' . $keyword . '%')->paginate(5);

        return view('team.searchResult', ['teamSearch' => $teamSearch]);
    }

    public function export(Request $request)
    {
        // export search results to a csv file
        // dd($request->all());
        $keyword = $request->teamId;
        $teams = \App\Models\Team::where('id', 'like', '%' . $keyword . '%')->get();

        return Excel::download(new TeamsExport($teams), 'searchResultTeam.csv');
    }
}
