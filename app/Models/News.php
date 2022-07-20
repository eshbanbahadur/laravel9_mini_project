<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class News extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $fillable = array('title', 'content');

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



