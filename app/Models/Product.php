<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function order() {
        return $this->belongsToMany(Order::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }


    public function scopeFilter($query, $filter) {
        
        $query->when($filter['search'] ?? false, function($query, $search) {
            $query->where(function ($query) use($search) {     
                $query->where('title', 'LIKE', '%'.$search.'%')
                      ->orwhere('description', 'LIKE', '%'.$search.'%');
            });
        });

        $query->when($filter['category'] ?? false, function($query, $slug) {
            $query->whereHas('category', function($query) use ($slug){
                //query ka category. ae category table ye slug column mr dynamically win lr tae $slug nae tu tr ko shar
                $query->where('slug', $slug);      
            });
        });

        $query->when($filter['username'] ?? false, function($query, $username) {
            $query->whereHas('user', function($query) use ($username){
                $query->where('username', $username);      
            });
        });
        
    }
}