<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function lecture(){
        return view('/admin/session/lecture');
    }

    public function put(Request $request){
        session()->put('name',$request->name);
        session()->put('age',$request->age);
        session()->put('address',$request->address);
        
        return redirect('/admin/session/lecture');
    }

    public function delete($key){
        if($key == 'delete-all'){
            session()->flush();
        }
        else{
            session()->forget($key);
        }

        return redirect('/admin/session/lecture');
    }

    public function index(){
        //get tasks from session
        $tasks = session()->has('tasks')? session()->get('tasks') : [];
        return view ('/admin/session/index')
                ->with('tasks',$tasks);
    }

    public function store(Request $request){

        //get tasks from session
        $tasks = session()->has('tasks')? session()->get('tasks') : [];

        $task = [];
        $task['id'] = uniqid();
        $task['task'] = $request->task;
        $task['description'] = $request->description;

        array_push($tasks,$task);

        session()->put('tasks',$tasks);
        // session()->flush();

        return response()->json(["data"=> $tasks]);
    }
    
    public function update(){
        
    }

    public function destroy($taskId){
        //get tasks from session
        $tasks = session()->has('tasks')? session()->get('tasks') : [];

        $updatedTasks = array_values(array_filter($tasks, function($task) use($taskId){
            return $task['id'] != $taskId;
        }));

        session()->put('tasks',$updatedTasks);

        return response()->json($updatedTasks);
    }
}
