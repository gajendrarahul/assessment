<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JsonFile extends Model
{
    use HasFactory;

    protected $fillable = ['id','file_path','user_id'];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class)->orderBy('id','desc');
    }
}
