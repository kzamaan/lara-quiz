<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'explanation'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function answer()
    {
        return $this->hasOne(Option::class)->where('is_correct', true);
    }
}
