<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MissionTodo;
use App\Models\ListItem;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class TaskDetailController extends Controller
{

    public function editTask($id) //タスク編集(取得)
    {
        $task = MissionTodo::find($id);
        $userLists = ListItem::where('user_id',Auth::id())->get();
        return view('tasks.revise',compact('task','userLists'));
    }

    public function updateTask(Request $request,$id) //タスク更新
    {
        $rules = [
        'task' => 'string|min:0|max:250',
        'due_date' =>'nullable|date',
        'list_id' => 'nullable|exists:lists,id',
        ];

        $messages = ['max' => '250文字以下にしてください'];

        Validator::make($request->all(), $rules,$messages)->validate();
    
        $task = MissionTodo::findOrFail($id);

        if ($request->has('list_id') && $request->input('list_id') !== null)
        {
            $listId = $request->input('list_id');
            $userList = ListItem::where('user_id', Auth::id())->findOrFail($listId);
            $task->list_id = $userList->id;
        }
    
        if ($request->has('due_date') && $request->input('due_date') !== null)
        {
            $task->deadline = $request->input('due_date');
        }
        
        $task->task = $request->input('task_name');
        $task->save();
        return redirect()->route('tasks');
    }

}
