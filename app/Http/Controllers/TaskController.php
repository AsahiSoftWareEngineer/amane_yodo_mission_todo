<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MissionTodo;
use App\Models\ListItem;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    
    public function index(Request $request) //タスク一覧
    {
        $checked = $request->input('checked');
        $deadline = $request->input('deadline');
        $listId = $request->input('list_id');
        
        $query = MissionTodo::with('taskList','taskUser')
                            ->where('user_id', Auth::id());
        if($checked)
        {
                if ($checked === 'true')
                {
                    $query->where('checked', true);
                }
                elseif ($checked === 'false')
                {
                    $query->where('checked', false);
                }
        }
        else
        {
            $query->where('checked',false);
        }


        if ($deadline && $deadline === 'true')
        {
            $query = $query->whereNotNull('deadline')->orderBy('deadline', 'asc'); 
        }


        if($listId && $listId === 'true')
        {
            $query = $query->whereNotNull('list_id');
        }

        $tasks = $query->orderBy('sort_order','asc')->get();

        return view('tasks.index',compact('tasks','checked','deadline','listId'));

    }

    public function storeTask(Request $request) //タスク保存
    {
        $this->validate($request,MissionTodo::$rules);
        
        $userId = Auth::user()->id;
    
        $newTask = new MissionTodo;
        $taskName = $request->input('task');
        
        $newTask->user_id = $userId;
        $newTask->sort_order = MissionTodo::max('sort_order')+1;
        $newTask->task= $taskName;

        $newTask->save();
        return redirect()->route('tasks');

    }

    public function destroyTask($id) //タスク削除
    {
        MissionTodo::find($id)->delete();
        return redirect()->route('tasks');
    }

    public function renewCheckbox(Request $request, $id) //チェックボックスの状態を更新
    {
        $currentTask = MissionTodo::findOrFail($id);
        $currentTask->checked = !$currentTask->check;
        $currentTask->save();
        return redirect()->route('tasks');

    }

     public function sortTask(Request $request,$id) //ソート並び替え
    {
        $deadline = $request->get('deadline');
        $listId = $request->get('list_id');
        $checked =$request->get('checked');
        $cmd = $request->input('cmd');
        
        $currentTask = MissionTodo::findOrFail($id);

        $moveTasks = null;

        if($cmd)
        {
            if($cmd === "up")
            {
                $moveTasks = MissionTodo::where('sort_order','<',$currentTask->sort_order)
                                    ->orderBy('sort_order','desc')
                                    ->first();
            }
            elseif($cmd === "down")
            {
                $moveTasks =  MissionTodo::where('sort_order','>',$currentTask->sort_order)
                                    ->orderBy('sort_order','asc')
                                    ->first();
            }
        }
    
        if($moveTasks)
        {
            if($cmd === "up")
            {
                $currentTask->sort_order = $moveTasks->sort_order;
                $moveTasks->sort_order += 1;
            }
            elseif($cmd === "down")
            {
                $currentTask->sort_order = $moveTasks->sort_order;
                $moveTasks->sort_order -= 1;
            }
        
            $currentTask->save();
            $moveTasks->save();
        }

        if($deadline)
        {
            return redirect()->route('tasks',['deadline' => 'true']);
        }
        elseif($listId)
        {
            return redirect()->route('tasks',['list_id' => 'true']);
        }
        elseif($checked && $checked === 'true')
        {
            return redirect()->route('tasks',['checked' => 'true']);
        }
        elseif($checked && $checked === 'false')
        {
            return redirect()->route('tasks',['checked' => 'false']);
        }
        else
        {
            return redirect()->route('tasks');
        }

        }
}
