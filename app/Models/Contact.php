<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'birthday',
        'document',
        'phones',
    ];

    public function setPhonesAttribute($value)
    {
        $this->attributes['phones'] = json_encode($value);
    }

    public function getPhonesAttribute($value)
    {
        return json_decode($value);
    }
}
