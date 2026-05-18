<?php

namespace App\Http\Controllers;

use App\Models\ClientReview;
use App\Models\JournalPrompt;
use App\Models\MoodEntry;
use App\Models\Partner;
use App\Models\ProviderProfile;
use App\Models\Resource;
use App\Models\Service;
use App\Models\TherapyProgram;
use App\Models\Workshop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $partners = Partner::active()->orderBy('display_order')->get();
        $featuredServices = Service::active()->orderBy('display_order')->take(4)->get();
        $featuredProviders = ProviderProfile::publicListing()->featured()->with('user')->take(6)->get();
        $featuredReviews = ClientReview::approved()->featured()->orderBy('display_order')->take(6)->get();
        $latestResources = Resource::active()->published()->orderBy('published_at', 'desc')->take(6)->get();
        $upcomingWorkshops = Workshop::active()->open()->where('date_time', '>=', now())->orderBy('date_time')->take(3)->get();
        $journalPrompts = JournalPrompt::active()->orderBy('display_order')->take(3)->get();
        $moodInsights = MoodEntry::latest('entry_date')->take(6)->get();

        return view('home.index', compact(
            'partners',
            'featuredServices',
            'featuredProviders',
            'latestResources',
            'featuredReviews',
            'upcomingWorkshops',
            'journalPrompts',
            'moodInsights'
        ));
    }
}
