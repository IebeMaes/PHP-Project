<?php

namespace App\Http\Controllers\Organizer;

use App\Activity;
use App\Task;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('organizer/taken');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'activity' => 'required',
            'beginuur' => 'required',
        ],[
            'name.required' => 'Vul een naam in.',
            'name.min' => 'De naam moet minstens :min karakters bevatten.',
            'description.required' => 'Vul een beschrijving in.',
            'description.min' => 'De beschrijving moet minstens :min karakters bevatten.',
            'activity.required' => 'Selecteer een activiteit.',
            'beginuur.required' => 'Vul een start uur in.',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->note = $request->comment;
        $task->activity_id = $request->activity;
        $task->start_hour = $request->beginuur;
        $task->end_hour = $request->einduur;
        $task->min_number =  $request->minhelper;
        $task->max_number = $request->maxhelper;
        $task->save();

        return response()->json([
            'type' => 'success',
            'text' => "<b>$task->name</b> is aangemaakt",
            'object' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task,Request $request)
    {
        $personeelsfeestid = $request->route('task.id');
        $tasks = Task::with('activity.daypart_activity.daypart')
            ->wherehas("activity.daypart_activity.daypart", function ($query) use($personeelsfeestid) {$query->where('staffparty_id' ,'=' , $personeelsfeestid);})->get();


//        $tasks = DB::table("tasks")
//            ->join('activities' , 'tasks.activity_id', '=' , 'activities.id')
//            ->join('daypart_activities', 'activities.id', '=' , 'daypart_activities.activity_id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->select('tasks.name as taskname' ,'tasks.description' ,'activities.name as activityname' ,'tasks.note' ,'tasks.min_number' ,'tasks.max_number' ,'tasks.start_hour' ,'tasks.end_hour', 'tasks.id as id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->distinct()->get();
        $activities = Activity::with('daypart_activity.daypart')
            ->wherehas("daypart_activity.daypart", function ($query) use($personeelsfeestid) {$query->where('staffparty_id' ,'=' , $personeelsfeestid);})
        ->orderBy('name')->get();
        $result = compact('tasks', 'activities', 'personeelsfeestid');
        Json::dump($result);
        return view('organizer.taken.index', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return redirect('organizer/taken');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'activity' => 'required',
            'beginuur' => 'required',
            ],[
                'name.required' => 'Vul een naam in.',
                'name.min' => 'De naam moet minstens :min karakters bevatten.',
                'description.required' => 'Vul een beschrijving in.',
                'description.min' => 'De beschrijving moet minstens :min karakters bevatten.',
                'activity.required' => 'Selecteer een activiteit.',
                'beginuur.required' => 'Vul een start uur in.',
            ]);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->note = $request->comment;
        $task->activity_id = $request->activity;
        $task->start_hour = $request->beginuur;
        $task->end_hour = $request->einduur;
        $task->min_number =  $request->minhelper;
        $task->max_number = $request->maxhelper;
        $task->save();
        return response()->json([
            'type' => 'success',
            'text' => "<b>$task->name</b> is gewijzigd"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        $task->delete();


        return response()->json([
            'type' => 'success',
            'text' => "<b>$task->name</b> is verwijderd"

        ]);
    }
}
