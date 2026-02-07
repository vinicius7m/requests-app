<?php

namespace App\Models;

use App\Enums\RequestCategory;
use App\Enums\RequestStatus;
use App\Exceptions\DomainException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'user_id',
        'status'
    ];

    protected $casts = [
        'status' => RequestStatus::class,
        'category' => RequestCategory::class,
    ];

    public function cancel(): void
    {
        if ($this->status !== RequestStatus::OPEN) {
            throw new DomainException('Solicitação não pode ser cancelada.');
        }

        $this->update([
            'status' => RequestStatus::CANCELLED,
        ]);
    }

    public function approve(?string $reason = null): void
    {
        if ($this->status !== RequestStatus::OPEN) {
            throw new DomainException('Solicitação não pode ser aprovada.');
        }

        $this->update([
            'status' => RequestStatus::APPROVED,
            'reason' => $reason
        ]);
    }

    public function reject(string $reason): void
    {
        if ($this->status !== RequestStatus::OPEN) {
            throw new DomainException('Solicitação não pode ser rejeitada.');
        }

        $this->update([
            'status' => RequestStatus::REJECTED,
            'reason' => $reason
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
