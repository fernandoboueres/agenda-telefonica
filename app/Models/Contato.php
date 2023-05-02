<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contato extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'telefone',
        'user_id'
    ];

    public static $rules = [
        'nome' => 'required',
        'telefone' => 'required',
        'user_id' => 'required',
    ];

    public static function get_by_current_user(){
        return self::where('user_id',  Auth::id())->orderBy('id')->get();
    }

    public function setTelefoneAttribute($value){
        $this->attributes['telefone'] = \preg_replace('/[^0-9]/', '', $value);
    }
    
}