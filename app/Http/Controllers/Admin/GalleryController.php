<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:50',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'title' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:550',
        ]);

        $category = $request->category;
        $title = $request->title;
        $videoUrl = $request->video_url;
        $isVideo = $request->has('is_video') || !empty($videoUrl) || $category === 'video';
        $maxOrder = Gallery::max('sort_order') ?? 0;

        foreach ($request->file('images') as $file) {
            // Compress and optimize uploaded gallery image
            $imagePath = ImageOptimizerService::compressAndStore($file, 'gallery', 1200, 1600, 82);

            Gallery::create([
                'title' => $title ?: ucfirst($category) . ' Creation',
                'category' => strtolower($category),
                'image_path' => $imagePath,
                'video_url' => $videoUrl,
                'is_video' => $isVideo,
                'sort_order' => ++$maxOrder,
                'is_active' => true,
            ]);
        }

        return back()->with('success', 'Gallery item(s) uploaded and optimized successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image file if stored locally
        if ($gallery->image_path && !str_starts_with($gallery->image_path, 'http') && !str_starts_with($gallery->image_path, 'images/')) {
            $fullPath = public_path(ltrim($gallery->image_path, '/'));
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }

        $gallery->delete();
        return back()->with('success', 'Gallery item deleted successfully.');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        return back()->with('success', 'Gallery item status updated successfully.');
    }
}
