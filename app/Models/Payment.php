<?php

namespace App\Models;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'employer_id',
        'amount',
        'launch_date',
        'done_time',
        'status',
        'month',
        'year',
    ];
    public function employe(){
        return $this->belongsTo(Employe::class, 'employer_id');
    }
}
