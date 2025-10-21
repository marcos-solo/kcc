<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Show all photos
     */
    public function photos()
    {
        $photos = MediaItem::where('type', 'photo')->orderBy('order')->get();
        return view('media.photos', compact('photos'));
    }

    /**
     * Show all videos
     */
    public function videos()
    {
        $videos = MediaItem::where('type', 'video')->orderBy('order')->get();
        return view('media.videos', compact('videos'));
    }

    /**
     * Show all publications (PDFs, documents, etc.)
     */
    public function publications()
    {
        $publications = MediaItem::where('type', 'publication')->orderBy('order')->get();
        return view('media.publications', compact('publications'));
    }

    /**
     * Show all reports
     */
    public function reports()
    {
        $reports = MediaItem::where('type', 'report')->orderBy('order')->get();
        return view('media.reports', compact('reports'));
    }
}
