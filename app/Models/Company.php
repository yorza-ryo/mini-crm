<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'email', 'logo'];
    protected $dates = ['deleted_at'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($offer) {
            $offer->employees()->delete();
        });
    }
}
