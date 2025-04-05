<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MissionTodo; 
use App\Models\ListItem;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ListController extends Controller
{

    public function index(Request $request) //追加したリストを表示(リスト追加ページ)
    {

        $userLists = ListItem::with('listUser')
                        ->where('user_id',Auth::id())
                        ->get();

        return view('lists.index', compact('userLists'));
    }

    public function storeList(Request $request) //リスト保存
    {
        $this->validate($request,ListItem::$rules);

        $userId = Auth::user()->id;

        $newList = new ListItem;
        $listName = $request->input('list');

        $newList->user_id =$userId;
        $newList->list= $listName; 
        $newList->save();

        return redirect()->route('lists');

    }

    public function editListName($id) //リスト名編集(取得）
    {
        $currentList = ListItem::find($id);
        return view('lists.revise', compact('currentList'));
    }

    public function updateListName(Request $request,$id) //リスト名を更新
    {
        $rules = [
            'list' => 'string|min:0|max:250',
        ];

        $messages = ['max' => '250文字以下にしてください'];

        Validator::make($request->all(), $rules,$messages)->validate();

        $updateList = ListItem::find($id);
        $updateList->list = $request->input('list_name');
        $updateList->save();
        return redirect()->route('lists');      
    }

    public function removeList($id) //リスト削除
    {
        MissionTodo::where('list_id',$id)->update(['list_id'=> null]);
        ListItem::find($id)->delete();
        return  redirect()->route('lists');
    }

}

