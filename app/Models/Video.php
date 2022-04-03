<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Video extends Model
{
    use HasFactory, Sortable;
    
    public $sortable = ['id'];
    protected $guarded = [];
}
