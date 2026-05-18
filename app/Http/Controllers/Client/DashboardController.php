<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JournalEntry;
use App\Models\MoodEntry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentEntries = JournalEntry::where('user_id', $user->id)
            ->orderBy('entry_date', 'desc')
            ->take(5)->get();
        $recentMoods = MoodEntry::where('user_id', $user->id)
            ->orderBy('entry_date', 'desc')
            ->take(7)->get();
        $stats = [
            'total_entries' => JournalEntry::where('user_id', $user->id)->count(),
            'total_moods' => MoodEntry::where('user_id', $user->id)->count(),
            'streak_days' => $this->calculateStreak($user->id),
        ];

        return view('client.dashboard', compact('recentEntries', 'recentMoods', 'stats'));
    }

    private function calculateStreak($userId)
    {
        $entries = JournalEntry::where('user_id', $userId)
            ->orderBy('entry_date', 'desc')
            ->pluck('entry_date')
            ->map(fn($d) => $d->toDateString())
            ->unique()
            ->values();

        if ($entries->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        if ($entries[0] !== $today && $entries[0] !== $yesterday) {
            return 0;
        }

        $checkDate = $entries[0] === $today ? now() : now()->subDay();

        foreach ($entries as $entryDate) {
            if ($entryDate === $checkDate->toDateString()) {
                $streak++;
                $checkDate->subDay();
            } elseif ($entryDate < $checkDate->toDateString()) {
                break;
            }
        }

        return $streak;
    }
}
