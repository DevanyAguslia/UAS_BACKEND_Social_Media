<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{
    public function index()
    {
        // Ambil semua feeds dari database
        $feeds = Feed::latest()->get();

        return view('feeds.index', compact('feeds'));
    }

     // Menampilkan halaman pembuatan feed
     public function showCreateForm()
     {
         return view('feeds.create');
     }
 

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'content' => 'required_without:image',
            'image' => 'required_without:content|image|max:2048' // maksimal 2MB
        ]);

        // Simpan feed baru
        $feed = new Feed();
        $feed->user_id = auth()->id();
        $feed->content = $request->content;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('feeds', 'public');
            $feed->image = $imagePath;
        }

        $feed->save();

        return redirect()->route('feeds.index')->with('success', 'Feed berhasil diposting.');;
    }

    public function destroy(Feed $feed)
    {
        $feed->delete();

        return redirect()->back()->with('success', 'Feed berhasil dihapus.');
    }

    public function edit(Feed $feed)
    {
        // Pastikan hanya pemilik feed yang dapat mengedit
        if (Auth::id() !== $feed->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit feed ini.');
        }

        return view('feeds.edit', compact('feed'));
    }

    public function update(Request $request, Feed $feed)
    {
        // Validasi request
        $request->validate([
            'content' => 'required_without:image',
            'image' => 'required_without:content|image|max:2048' // maksimal 2MB
        ]);

        // Pastikan hanya pemilik feed yang dapat mengedit
        if (Auth::id() !== $feed->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit feed ini.');
        }

        // Update feed
        $feed->content = $request->content;

        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($feed->image) {
                Storage::disk('public')->delete($feed->image);
            }
            $imagePath = $request->file('image')->store('feeds', 'public');
            $feed->image = $imagePath;
        }

        $feed->save();

        return redirect()->back()->with('success', 'Feed berhasil diperbarui.');
    }
}
