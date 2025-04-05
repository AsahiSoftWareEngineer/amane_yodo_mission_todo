<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionTodo extends Model
{
    use HasFactory;

    protected $guarded = array('id');   //値を用意しておかなくても良い項目。勝手にデータベース側で番号振られる。
    protected $fillable = ['task','sort_order'];     //ユーザーが変更できる項目のみ書く。


    public static $rules = array(       //フォームを送るときのルール。250文字まで。
        'task' => 'string|min:0|max:250'
    );

    public function getData()
    {
        return $this->id . ':' . $this->task . '';
    }

    public function taskList()
    {
        return $this->belongsTo(ListItem::class,'list_id'); //タスクは一つのリストに関連づけられる
    }

    public function taskUser()
    {
        return $this->belongsTo(User::class); //タスクは一人のユーザーに関連づけられる
    }

}
