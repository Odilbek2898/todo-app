<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ScopeByUser(Builder $query, Auth $auth)
    {
        return $query->where('user_id', $auth::user()->id);

    }
}
