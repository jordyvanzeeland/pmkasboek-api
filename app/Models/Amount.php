<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Amount extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'date',
        'description',
        'amount',
        'type',
        'booksaldo'
    ];

    public function type(){
        return $this->hasOne('App\Models\AmountType', 'id', 'type');
    }

    public function saldo(){
        return $this->hasOne('App\Models\Saldo', 'id', 'booksaldo');
    }

}