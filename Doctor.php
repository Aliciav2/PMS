<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'speciality', 
        'monday_from', 'monday_to',
        'tuesday_from', 'tuesday_to',
        'wednesday_from', 'wednesday_to',
        'thursday_from', 'thursday_to',
        'friday_from', 'friday_to',
        'saturday_from', 'saturday_to',
        'sunday_from', 'sunday_to'
    ];
	// Define la relación con el modelo User
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}


