<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    
    $tasks = Task::orderBy('created_at', 'asc')->get();
    
//    dd($tasks);
    
    return view('tasks.index', [
        'tasks' => $tasks
    ]);
//    return view('tasks.index')->with($tasks);
});

Route::post('/task', function(Request $request) {
    //dd($request);
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255'
    ]);
    
    //dd($validator);
    
    if ($validator->fails()) {
        return redirect('/')->withInput()->withErrors($validator);
    }
    
//    Task::create([
//        'name' => $request->name
//    ]); // Need to define $fillable in Model
    
    $task = new Task;
//    dd($task);
    $task->name = $request->name;
    $task->save();
    
    return redirect('/');
});

//Route::delete('/task/{taskId}', function($taskId) {
////    dd($task);
//    $task = Task::find($taskId);
//    
//    dd($task);
//});

Route::delete('/task/{task}', function(Task $task) {    
//    dd($task);
    $task->delete();
    return redirect('/');
});