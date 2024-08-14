<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function post(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $admin_id = $request->admin_id;

        $blog = new Blog();

        $blog->title = $title;
        $blog->content = $content;
        $blog->admin_id = $admin_id;

        $blog->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'blog_' . hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/blog'), $filename);

                $blogImage = new BlogImage();
                $blogImage->image_path = $filename;
                $blogImage->blog_id = $blog->id;
                $blogImage->save();
            }
        }

        $blog->load('images');



        return $blog;
    }

    public function getAllPosts()
    {

        $blogs = Blog::with('images')->latest()->get();

        return $blogs;
    }

    public function getBlogByID($id)
    {
        $blog = Blog::with('images')->find($id);
        return $blog;
    }
}
