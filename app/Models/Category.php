<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function scopeFilter($query, $filter) {
        
        $query->when($filter['search'] ?? false, function($query, $search) {
            $query->where(function ($query) use($search) {     
                $query->where('name', 'LIKE', '%'.$search.'%')
                      ->orwhere('slug', 'LIKE', '%'.$search.'%');
            });
        });
        
    }
}
