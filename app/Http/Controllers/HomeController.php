<?php

namespace App\Http\Controllers;

use App\Models\ClientReview;
use App\Models\JournalPrompt;
use App\Models\MoodEntry;
use App\Models\Partner;
use App\Models\ProviderProfile;
use App\Models\Resource;
use App\Models\ResourceCategory;
use App\Models\Service;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $resourceCategories = ResourceCategory::active()->orderBy('display_order')->get();

        return view('home.index', compact(
            'partners',
            'featuredServices',
            'featuredProviders',
            'latestResources',
            'featuredReviews',
            'upcomingWorkshops',
            'journalPrompts',
            'moodInsights',
            'resourceCategories',
        ));
    }

    public function getResourcesByCategory(Request $request)
    {
        $category = $request->query('category');
        $limit = $request->query('limit', 6);

        $query = Resource::active()->published()->orderBy('published_at', 'desc');

        if ($category && $category !== 'all') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        $resources = $query->take($limit)->get();

        return response()->json([
            'success' => true,
            'resources' => $resources->map(function ($resource) {
                return [
                    'id' => $resource->id,
                    'title' => $resource->localized_title,
                    'description' => Str::limit($resource->localized_description, 100),
                    'type' => $resource->type,
                    'category' => $resource->category?->localized_name ?? ucfirst(str_replace('_', ' ', $resource->type)),
                    'duration' => $resource->media_duration,
                    'thumbnail' => $resource->thumbnail_image ? asset('storage/'.$resource->thumbnail_image) : null,
                    'slug' => $resource->slug,
                ];
            }),
        ]);
    }
}
