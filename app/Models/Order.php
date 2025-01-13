<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public const STATUS_PENDING = "pending";
    public const STATUS_APPROVED = "approved";
    public const STATUS_SHIPPING = "shipping";
    public const STATUS_COMPLETED = "completed";
    public const STATUS_REJECTED = "rejected";

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_SHIPPING,
        self::STATUS_COMPLETED,
        self::STATUS_REJECTED,
    ];
    protected $table = 'orders';
    protected $fillable = [
        'code',
        'user_id',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_email',
        'order_date',
        'total',
        'reject_reason',
        'note',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
