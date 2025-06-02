<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'contact',
        'departement_id',
        'montant_journalier'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    //un employer peut avoir plusieurs paiements
    public function payments()
    {
        return $this->hasMany(Payment::class, 'employer_id');
    }
}
