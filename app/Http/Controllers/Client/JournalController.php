<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\JournalEntryRequest;
use App\Models\JournalEntry;
use App\Models\JournalPrompt;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $entries = JournalEntry::where('user_id', auth()->id())
            ->orderBy('entry_date', 'desc')
            ->paginate(15);
        $prompts = JournalPrompt::active()->inRandomOrder()->take(5)->get();
        return view('client.journal.index', compact('entries', 'prompts'));
    }

    public function show($id)
    {
        $entry = JournalEntry::where('user_id', auth()->id())->findOrFail($id);
        return view('client.journal.show', compact('entry'));
    }

    public function edit($id)
    {
        $entry = JournalEntry::where('user_id', auth()->id())->findOrFail($id);
        $prompts = JournalPrompt::active()->get();
        return view('client.journal.edit', compact('entry', 'prompts'));
    }

    public function store(JournalEntryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        JournalEntry::create($data);

        return redirect()->route('my-journal.index')->with('success', __('messages.journal_entry_created'));
    }

    public function update(JournalEntryRequest $request, $id)
    {
        $entry = JournalEntry::where('user_id', auth()->id())->findOrFail($id);
        $entry->update($request->validated());

        return redirect()->route('my-journal.index')->with('success', __('messages.journal_entry_updated'));
    }

    public function destroy($id)
    {
        $entry = JournalEntry::where('user_id', auth()->id())->findOrFail($id);
        $entry->delete();

        return redirect()->route('my-journal.index')->with('success', __('messages.journal_entry_deleted'));
    }
}
