<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function threads()
    {
        return $this->hasMany(Thread::class)->orderBy('created_at', 'DESC');
    }
}
