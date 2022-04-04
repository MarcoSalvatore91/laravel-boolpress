<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        $tags = Tag::all();

        $categories = Category::all();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'string', 'unique:posts', 'max:50'],
                'content' => 'string | required',
                'category_id' => 'nullable',
                'image' => 'nullable', 'image',
                'tags' => 'nullable|exists:tags,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.unique' => 'Titolo già esistente',
                'title.max' => 'Il titolo non può contenere piu\' di 50 caratteri',
                'content.required' => 'La descrizione è obbligatoria',
                'tags.exists' => 'Il tag inserito non è valido',
                'image.image' => 'Il formato non è valido',
            ]
        );

        $data = $request->all();

        $post = new Post();

        if (array_key_exists('image', $data)) {
            $img_url = Storage::put('post_images', $data['image']);
            $data['image'] = $img_url;
        }

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        $mail = new SendEmail($post);
        Mail::to(Auth::user()->email)->send($mail);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $post_ids = $post->tags->pluck('id')->toArray();

        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate(
            [
                'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'max:50'],
                'content' => 'string | required',
                'category_id' => 'nullable',
                'image' => 'nullable', 'image',
                'tags' => 'nullable|exists:tags,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.unique' => 'Titolo già esistente',
                'title.max' => 'Il titolo non può contenere piu\' di 50 caratteri',
                'content.required' => 'La descrizione è obbligatoria',
                'tags.exists' => 'Il tag inserito non è valido',
                'image.image' => 'Il formato non è valido',
            ]
        );

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        if (array_key_exists('image', $data)) {
            if ($post->image) Storage::delete($post->image);
            $img_url = Storage::put('post_images', $data['image']);
            $data['image'] = $img_url;
        }

        $post->update($data);

        if (!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete($post->image);

        if ($post->tags) $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
