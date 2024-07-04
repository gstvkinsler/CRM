<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUser extends Model
{
    use HasFactory;

    protected $table = 'documents_users';
    
    protected $fillable = [
        'user_id',
        'type',
        'document',
    ];
}
