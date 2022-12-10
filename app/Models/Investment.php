<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filing_date',
        'amount',
        'cycle',
        'investor_id',
    ];

    protected $appends=['due_date'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'filing_date' => 'date',
        'investor_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }

    /**
     * @return mixed
     */
    public function getDueDateAttribute(): mixed
    {
        return $this->filing_date->addMonth($this->cycle);
    }


}
