<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogComponent extends Component
{
    use WithFileUploads;
    public $blog_title;
    public $slug;
    public $image;
    public function render()
    {
        $blogs = Blog::latest()->paginate(7);
        return view('livewire.blog-component', compact('blogs'));
    }
    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Blog::class, 'slug', $this->blog_title);
    }
    public function store()
    {
        $dataValid = $this->validate([
            'blog_title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
        $dataValid['image'] = $this->image->store('blogs', 'public');

        Blog::create([
            'blog_title' => $this->blog_title,
            'slug'  => $this->slug,
            'image' => 'storage/' . $dataValid['image'],
        ]);

        session()->flash('message', 'File uploaded.');
    }
}
