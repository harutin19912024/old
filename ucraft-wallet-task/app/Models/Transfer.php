<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Transfer.
 *
 * @property string      $status
 * @property string      $status_last
 * @property string      $discount
 * @property int         $deposit_id
 * @property int         $withdraw_id
 * @property Wallet      $from
 * @property string      $from_type
 * @property int         $from_id
 * @property Wallet      $to
 * @property string      $to_type
 * @property int         $to_id
 * @property string      $uuid
 * @property Transaction $deposit
 * @property Transaction $withdraw
 *
 * @method int getKey()
 */
class Transfer extends Model
{
    public const STATUS_TRANSFER = 'transfer';
    public const STATUS_PAID = 'paid';
    public const STATUS_REFUND = 'refund';

    /**
     * @var string[]
     */
    protected $fillable = [
        'status',
        'deposit_id',
        'withdraw_id',
        'from_type',
        'from_id',
        'to_type',
        'to_id',
        'uuid',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'deposit_id' => 'int',
        'withdraw_id' => 'int',
    ];

    public function getTable(): string
    {
        return $this->table;
    }

    public function from(): MorphTo
    {
        return $this->morphTo();
    }

    public function to(): MorphTo
    {
        return $this->morphTo();
    }

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'deposit_id');
    }

    public function withdraw(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'withdraw_id');
    }
}
