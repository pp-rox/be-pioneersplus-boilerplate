<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table1 extends Model
{
    protected $table = 'table1';

    protected $fillable = [
        'parent_id',
        'field1',
        'field2',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Table1', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Table1', 'parent_id');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))
            ->whereNull('parent_id')->get();
    }
}
