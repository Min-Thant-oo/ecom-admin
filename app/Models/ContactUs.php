<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    public function scopeFilter($query, $filter) {
        $query->when($filter['search'] ?? false, function($query, $search) {
            $query->where(function ($query) use($search) {     
                $query->where('name', 'LIKE', '%'.$search.'%')
                      ->orwhere('email', 'LIKE', '%'.$search.'%')
                      ->orwhere('subject', 'LIKE', '%'.$search.'%')
                      ->orwhere('message', 'LIKE', '%'.$search.'%');
            });
        });
    }
}
