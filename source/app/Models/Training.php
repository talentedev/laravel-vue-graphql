<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use App\Models\Field;

class Training extends Model
{
    use HasFactory;

    /**
     * Get the school that owns the traning.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the field that owns the traning.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
