<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaItemController extends Controller
{
    public function index()
    {
        $mediaItems = MediaItem::orderBy('order')->paginate(10);
        return view('admin.media.index', compact('mediaItems'));
    }

    public function create()
    {
        return view('admin.media.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:publication,report,photo,video',
            'file' => 'required|file',
            'order' => 'nullable|integer',
        ]);

        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $counter = 1;

        while (MediaItem::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $route_name = "media.slug";
        $filePath = $request->file('file')->store("media/{$request->type}", 'public');

        MediaItem::create([
            'title' => $request->title,
            'slug' => $slug,
            'type' => $request->type,
            'file' => $filePath,
            'order' => $request->order ?? 0,
            'route_name' => $route_name,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media item added successfully.');
    }


    public function edit(MediaItem $mediaItem)
    {
        return view('admin.media.edit', compact('mediaItem'));
    }

    public function update(Request $request, MediaItem $mediaItem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:publication,report,photo,video',
            'file' => 'nullable|file',
            'order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->title);

        $mediaItem->update([
            'title' => $request->title,
            'slug' => $slug,
            'type' => $request->type,
            'file' => $request->file('file') ? $request->file('file')->store("media/{$request->type}", 'public') : $mediaItem->file,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media item updated successfully.');
    }

    public function destroy(MediaItem $mediaItem)
    {
        $mediaItem->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media item deleted.');
    }
}

