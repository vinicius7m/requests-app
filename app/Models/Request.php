<?php

namespace App\Models;

use App\Enums\RequestStatus;
use DomainException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function approve(): void
    {
        if ($this->status !== RequestStatus::OPEN) {
            throw new DomainException('Solicitação não pode ser aprovada.');
        }

        $this->update([
            'status' => RequestStatus::APPROVED,
        ]);
    }

    public function reject(): void
    {
        if ($this->status !== RequestStatus::OPEN) {
            throw new DomainException('Solicitação não pode ser rejeitada.');
        }

        $this->update([
            'status' => RequestStatus::REJECTED,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
