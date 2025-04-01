<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory, HasFactory;
    protected $fillable = ['name'];

    public array $translatable = ['name'];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
