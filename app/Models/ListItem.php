<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $table = 'lists';
    protected $fillable = ['list'];     //ユーザーが変更できる項目のみ書く。

    public static $rules = array(       //フォームを送るときのルール。250文字まで。
        'list' => 'string|min:0|max:250'
    );

    public function tasksInList()
    {
        return $this->hasMany(MissionTodo::class); //リストは複数のタスクを持つ
    }

     public function listUser()
    {
        return $this->belongsTo(User::class); //リストは一人のユーザーに関連づけられる
    }

}
