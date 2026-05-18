<?php

namespace App\Http\Controllers;

use App\Models\TherapyProgram;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        $programs = TherapyProgram::active()->orderBy('created_at', 'desc')->paginate(12);
        return view('programs.index', compact('programs'));
    }

    public function show(TherapyProgram $program)
    {
        $program->load('facilitator.user', 'service');
        return view('programs.show', compact('program'));
    }
}
