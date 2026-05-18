<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::active()->published();

        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $resources = $query->orderBy('published_at', 'desc')->paginate(12);
        $categories = ResourceCategory::active()->orderBy('display_order')->get();

        return view('resources.index', compact('resources', 'categories'));
    }

    public function show(Resource $resource)
    {
        $resource->load('category', 'tags');
        $resource->increment('view_count');
        $relatedResources = Resource::active()->published()
            ->where('id', '!=', $resource->id)
            ->where('type', $resource->type)
            ->take(4)->get();

        return view('resources.show', compact('resource', 'relatedResources'));
    }
}
