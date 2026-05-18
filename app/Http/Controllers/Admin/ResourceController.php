<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with('category');

        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        $resources = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        $categories = ResourceCategory::active()->get();
        return view('admin.resources.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateResource($request);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_new'] = $request->boolean('is_new', false);
        $validated['published_at'] = $request->boolean('publish_now', false) ? now() : null;
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('resources/thumbnails', 'public');
        }

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('resources/files', 'public');
        }

        Resource::create($validated);

        return redirect()->route('admin.resources.index')->with('success', __('messages.resource_created'));
    }

    public function edit(Resource $resource)
    {
        $categories = ResourceCategory::active()->get();
        return view('admin.resources.edit', compact('resource', 'categories'));
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $this->validateResource($request, $resource->id);

        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_new'] = $request->boolean('is_new', false);

        if (!$resource->published_at && $request->boolean('publish_now', false)) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('resources/thumbnails', 'public');
        }

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('resources/files', 'public');
        }

        $resource->update($validated);

        return redirect()->route('admin.resources.index')->with('success', __('messages.resource_updated'));
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index')->with('success', __('messages.resource_deleted'));
    }

    private function validateResource(Request $request, $id = null)
    {
        $rules = [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resources' . ($id ? ",slug,{$id}" : ''),
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'type' => 'required|in:blog_article,audio,self_help_ebook,video,guided_meditation,mental_health_conversation,assessment',
            'category_id' => 'nullable|exists:resource_categories,id',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'media_url' => 'nullable|string|max:255',
            'media_duration' => 'nullable|string|max:50',
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'external_link' => 'nullable|url|max:255',
            'display_order' => 'nullable|integer',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string',
            'meta_description_ar' => 'nullable|string',
        ];

        return $request->validate($rules);
    }
}
