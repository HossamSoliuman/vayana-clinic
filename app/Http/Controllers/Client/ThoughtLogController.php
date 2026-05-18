<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CbtThoughtLogRequest;
use App\Models\CbtThoughtLog;
use Illuminate\Http\Request;

class ThoughtLogController extends Controller
{
    public function index()
    {
        $logs = CbtThoughtLog::where('user_id', auth()->id())
            ->orderBy('log_date', 'desc')
            ->paginate(15);

        return view('client.thought-log.index', compact('logs'));
    }

    public function store(CbtThoughtLogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        CbtThoughtLog::create($data);

        return redirect()->route('thought-log.index')->with('success', __('messages.thought_log_created'));
    }
}
