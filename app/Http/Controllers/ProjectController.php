<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\TimeLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::paginate(10);
        return view('search_project')->with('projects', $projects);
    }

    public function edit(int $id)
    {
        $project = Project::find($id);
        $customers = Customer::all();
        $project_statuses = ProjectStatus::all();

        if (!$project) {
            abort(404);
        }

        return view('edit_project')->with(['project' => $project, 'customers' => $customers, 'project_statuses' => $project_statuses]);
    }

    public function create(): View
    {
        $customers = Customer::all();
        return view('create_project')->with('customers', $customers);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'car_model' => 'required|max:255',
            'car_make' => 'required|max:255',
            'car_year' => 'required|integer|numeric',
            'license_plate' => 'required|max:255',
            'customer_id' => 'required|exists:customers,id',
            'issue_description' => 'required',
            'work_description' => 'required',
            'project_status_id' => 'required|exists:project_statuses,id',
            'start_time' => 'required_with:end_time|date_format:H:i',
            'end_time' => 'required_with:start_time|date_format:H:i|after:start_time',
        ];

        $messages = [
            'required' => 'Vänligen fyll i alla fält.',
            'car_year.integer' => 'Årsmodell fältet måste bestå av endast siffror.',
            'car_year.numeric' => 'Årsmodell fältet måste bestå av endast siffror.',
            'customer_id.exists' => 'Kunden kunde inte hittas.',
            'name.max' => 'Projektnamn fältet får inte överstiga 255 tecken.',
            'car_model.max' => 'Bilmodell fältet får inte överstiga 255 tecken.',
            'car_make.max' => 'Bilmärke fältet får inte överstiga 255 tecken.',
            'license_plate.max' => 'Registernummer fältet får inte överstiga 255 tecken.',
            'project_status_id.exists' => 'Det gick inte att hitta den nödvändiga projektstatusen. Vänligen kontakta administratören.',
            'start_time.required_with' => 'Sluttid fältet är obligatorisk om starttid fältet är ifyllt.',
            'start_time.date_format' => 'Starttid fältet måste vara i formatet HH:MM.',
            'end_time.required_with' => 'Starttid fältet är obligatoriskt om sluttid fältet är ifyllt.',
            'end_time.date_format' => 'Sluttid fältet måste vara i formatet HH:MM.',
            'end_time.after' => 'Sluttid fältet måste vara efter starttid.',
        ];

        $request->merge([
            'start_time' => $request->start_time ?: null,
            'end_time' => $request->end_time ?: null,
        ]);

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existing_project = Project::find($id);

        $existing_project->name = $request->name;
        $existing_project->car_model = $request->car_model;
        $existing_project->car_make = $request->car_make;
        $existing_project->car_year = $request->car_year;
        $existing_project->license_plate = $request->license_plate;
        $existing_project->customer_id = $request->customer_id;
        $existing_project->project_status_id = $request->project_status_id;
        $existing_project->issue_description = $request->issue_description;
        $existing_project->work_description = $request->work_description;

        $existing_project->save();

        if ($request->start_time && $request->end_time) {
            $time_log = new TimeLog;

            $time_log->user_id = Auth::id();
            $time_log->project_id = $id;
            $time_log->start_time = $request->start_time;
            $time_log->end_time = $request->end_time;

            $time_log->save();
        }

        session()->flash('status', 'Projektinformationen har sparats');
        return redirect()->route('project.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'car_model' => 'required|max:255',
            'car_make' => 'required|max:255',
            'car_year' => 'required|integer|numeric',
            'license_plate' => 'required|max:255',
            'customer_id' => 'required|exists:customers,id',
            'issue_description' => 'required',
            'work_description' => 'required',
        ];

        $messages = [
            'required' => 'Vänligen fyll i alla fält.',
            'car_year.integer' => 'Årsmodell fältet måste bestå av endast siffror.',
            'car_year.numeric' => 'Årsmodell fältet måste bestå av endast siffror.',
            'customer_id.exists' => 'Kunden kunde inte hittas.',
            'name.max' => 'Projektnamn fältet får inte överstiga 255 tecken.',
            'car_model.max' => 'Bilmodell fältet får inte överstiga 255 tecken.',
            'car_make.max' => 'Bilmärke fältet får inte överstiga 255 tecken.',
            'license_plate.max' => 'Registernummer fältet får inte överstiga 255 tecken.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = new Project;

        try {
            $in_queue_status = ProjectStatus::where('name', 'Ej påbörjad')->firstOrFail();

            $project->project_status_id = $in_queue_status->id;
            $project->user_id = Auth::id();
            $project->name = $request->name;
            $project->car_model = $request->car_model;
            $project->car_make = $request->car_make;
            $project->car_year = $request->car_year;
            $project->license_plate = $request->license_plate;
            $project->customer_id = $request->customer_id;
            $project->issue_description = $request->issue_description;
            $project->work_description = $request->work_description;

            $project->save();

            session()->flash('status', 'Ett nytt projekt har skapats');
            return back();
        } catch (ModelNotFoundException $e) {
            return back()->withErrors(['error' => 'Det gick inte att hitta den nödvändiga projektstatusen. Vänligen kontakta administratören.']);
        }
    }

    public function show(int $id): View
    {
        $project = Project::find($id);

        if (!$project) {
            abort(404);
        }

        return view('show_project')->with('project', $project);
    }

    public function destroy(int $id): RedirectResponse
    {
        $project = Project::find($id);

        if (!$project) {
            abort(404);
        }

        $project->delete();
        session()->flash('status', 'Projektet har raderats');
        return back();
    }
}
