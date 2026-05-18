<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoodEntryRequest;
use App\Models\MoodEntry;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        $moods = MoodEntry::where('user_id', auth()->id())
            ->orderBy('entry_date', 'desc')
            ->paginate(30);

        $moodLabels = [
            1 => ['label' => 'Very Low', 'color' => 'danger'],
            2 => ['label' => 'Low', 'color' => 'warning'],
            3 => ['label' => 'Neutral', 'color' => 'info'],
            4 => ['label' => 'Good', 'color' => 'primary'],
            5 => ['label' => 'Very Good', 'color' => 'success'],
        ];

        return view('client.mood.index', compact('moods', 'moodLabels'));
    }

    public function store(MoodEntryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        MoodEntry::create($data);

        return redirect()->route('mood-tracker.index')->with('success', __('messages.mood_logged'));
    }
}
