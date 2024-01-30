<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PageBlogItem;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->paginate(6);
        $blog_page_item = PageBlogItem::where('id',1)->first();
        return view('front.blog',compact('posts','blog_page_item'));
    }

    public function detail($slug){
        $post = Post::where('slug',$slug)->first();

        //To update total views wheneve this page get hit:
        $post->total_view = $post->total_view+1;
        $post->update();
        
        return view('front.post',compact('post'));
    }
}
