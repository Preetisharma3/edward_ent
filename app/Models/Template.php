<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
     protected $fillable = [
        'template_name','question_id','answer_id','signature_id','material_id'
        ];
}
