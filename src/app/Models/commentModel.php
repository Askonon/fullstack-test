<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'comments';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'name',
        'text',
        'date'
    ];
    protected array $casts = [
        'name' => 'string',
        'text' => 'string',
        'date' => 'string',
    ];
}