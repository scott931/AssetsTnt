<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_transfer_id',
        'action',
        'user_id',
        'details',
    ];

    public function assetTransfer()
    {
        return $this->belongsTo(AssetTransfer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}