<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function scopeFilter($query, $filter) {

        $query->when($filter['search'] ?? false, function($query, $search) {
            $query->whereHas('user', function($query) use ($search){
                $query->where('name', 'LIKE', '%' . $search . '%') 
                      ->orWhere('email', 'LIKE', '%' . $search . '%');      
            });
        });
        
    }
}
