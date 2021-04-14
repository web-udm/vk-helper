<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liking extends Model
{
    use HasFactory;

    static public function createNewLiking(string $dateOfStart): void
    {
        $likingProcess = new Liking();
        $likingProcess->status = 'В процессе';
        $likingProcess->date = $dateOfStart;
        $likingProcess->save();
    }

    static public function changeStatusToCompleted(string $dateOfStart): void
    {
        Liking::query()->where('date', $dateOfStart)
            ->update(['status' => 'Успешно завершено']);
    }
}
