<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'unite_price',
        'supplier_id',
    ];

    protected $appends=['amount'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'quantity' => 'float',
        'unite_price' => 'float',
        'supplier_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }


    /**
     * @return BelongsToMany
     */
    public function investors(): BelongsToMany
    {
        return $this->belongsToMany(Investor::class);
    }

    /**
     * @return float|int
     */
    public function getAmountAttribute(): float|int
    {
        return $this->unite_price*$this->quantity;
    }
}
