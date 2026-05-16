<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialPost;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $posts = SocialPost::with('creator')->latest()->paginate(15);
        return view('admin.social.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.social.form', ['post' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform'     => 'required|in:facebook,instagram',
            'content'      => 'required|string|max:2000',
            'scheduled_at' => 'required|date',
        ]);

        SocialPost::create([
            'platform'     => $request->platform,
            'content'      => $request->content,
            'scheduled_at' => $request->scheduled_at,
            'status'       => 'pending',
            'created_by'   => auth()->id(),
        ]);

        return redirect('/admin/social')->with('success', 'Post scheduled.');
    }

    public function destroy($id)
    {
        SocialPost::findOrFail($id)->delete();
        return redirect('/admin/social')->with('success', 'Post deleted.');
    }

    // Simulate posting (mock API call)
    public function markPosted($id)
    {
        SocialPost::findOrFail($id)->update([
            'status'    => 'posted',
            'posted_at' => now(),
            'likes'     => rand(10, 500),
            'comments'  => rand(1, 50),
        ]);

        return redirect()->back()->with('success', 'Post marked as published.');
    }

    public function calendar()
    {
        $posts = SocialPost::orderBy('scheduled_at')->get();
        return view('admin.social.calendar', compact('posts'));
    }
}
