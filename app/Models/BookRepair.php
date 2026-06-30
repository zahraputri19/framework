<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookRepair extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'description',
        'repair_date',
        'deadline_date',
        'completion_date',
        'status',
        'fine_amount',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'repair_date' => 'date',
        'deadline_date' => 'date',
        'completion_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateFine()
    {
        if ($this->status === 'selesai' && $this->completion_date) {
            $completion = Carbon::parse($this->completion_date)->startOfDay();
            $deadline = Carbon::parse($this->deadline_date)->startOfDay();

            if ($completion->greaterThan($deadline)) {
                $hariTelat = (int) $deadline->diffInDays($completion);
                return $hariTelat * 1000;
            }
            return 0;
        }

        if ($this->status === 'terlambat') {
            $now = Carbon::now()->startOfDay();
            $deadline = Carbon::parse($this->deadline_date)->startOfDay();
            $hariTelat = (int) $deadline->diffInDays($now);
            return max(0, $hariTelat * 1000);
        }

        return 0;
    }

    public function updateStatus()
    {
        if ($this->status === 'selesai') {
            return;
        }

        $now = Carbon::now()->startOfDay();
        $deadline = Carbon::parse($this->deadline_date)->startOfDay();

        if ($now->greaterThan($deadline)) {
            $this->status = 'terlambat';
            $calculatedFine = $this->calculateFine();
            $this->fine_amount = $calculatedFine > 0 ? $calculatedFine : 0;
            if ($this->fine_amount > 0) {
                $this->payment_status = $this->payment_status === 'lunas' ? 'lunas' : 'belum_bayar';
            }
        }

        $this->save();
    }
}
