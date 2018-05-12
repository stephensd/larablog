<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog; //model found in directory app/Blog.php
use App\Category;
use Session;
use App\User;
use App\Mail\BlogPublished;
use Illuminate\Support\Facades\Mail;

class BlogsController extends Controller
{
    public function __construct() {
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['delete', 'trash', 'restore', 'permanentDelete']]);
    }

    public function index() {
        //$blogs = Blog::where('status', 1)->latest()->get(); //get published blogs
        $blogs = Blog::latest()->get();
        return view('blogs.index', compact('blogs'));
        // you can use compact('blogs') or ['blogs' => $blog]
    }

    public function create() {
        $blogs = Blog::all();
        $categories = Category::latest()->get();
        return view('blogs.create', compact('blogs', 'categories'));
    }

    public function store(Request $request) {
        //validate
        $rules = [
          'title' => ['required', 'min:10', 'max:160'],
          'body' => ['required', 'min:20'],
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        //meta fields
        $input['slug'] = str_slug($request->title, '-');
        $input['meta_title'] = str_limit($request->title, 55);
        $input['meta_description'] = str_limit($request->body, 155, '...');

        //image upload
        if ($file = $request->file('featured_image')) {
          $photoName = uniqid() . '_' . $file->getClientOriginalName();
          $photoName = strtolower(str_replace(' ', '_', $photoName));
          $file->move('images/featured_image/', $photoName);
          $input['featured_image'] = $photoName;
        }

        //
        //$blog = Blog::create($input);
        $blogByUser = $request->user()->blog()->create($input);
        //sync with Categories
        if ($request->category_id) {
          $blogByUser->category()->sync($request->category_id);
        }

        //send mail
        $users = User::all();
        foreach($users as $user) {
          Mail::to($user->email)->queue(new BlogPublished($blogByUser, $user));
        }

        Session::flash('blog_created_message', 'Congratz on posting a blog.');
        return redirect('/blogs');
        // $blog = new Blog();
        // $blog->title = $request->title;
        // $blog->body = $request->body;
        // $blog->save();
    }

    public function show($slug) {
        $blog = Blog::whereSlug($slug)->first();
        //$blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function edit($id) {
        $blog = Blog::findOrFail($id);
        $categories = Category::latest()->get();

        $filteredCategory = array(); //on post edit, this shows categories checked and unchecked
        foreach ($blog->category as $c) {
          $filteredCategory[] = $c->id - 1; //-1 to remove repeats
        }

        $filtered = array_except($categories, $filteredCategory);

        return view('blogs.edit', compact('blog', 'categories', 'filtered'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $blog = Blog::findOrFail($id);

        //image upload
        if ($file = $request->file('featured_image')) {
          if ($blog->featured_image) {
            unlink('images/featured_image/'.$blog->featured_image);
          }
          $photoName = uniqid() . '_' . $file->getClientOriginalName();
          $photoName = strtolower(str_replace(' ', '_', $photoName));
          $file->move('images/featured_image/', $photoName);
          $input['featured_image'] = $photoName;
        }

        $blog->update($input);
        //sync with Categories
        if ($request->category_id) {
          $blog->category()->sync($request->category_id);
        }
        return redirect('blogs');
    }

    public function delete($id) {
        $blog = Blog::findOrFail($id);
        $blog->delete($id);
        return redirect('blogs');
    }

    public function trash() {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id) {
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoredBlog->restore($restoredBlog);
        return redirect('blogs');
    }

    public function permanentDelete($id) {
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);
        return back();
    }
}
