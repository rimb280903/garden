<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Product;
use App\Models\TagBlog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NavBarController extends Controller
{
    public function index()
    {

        // $random_products = Product::inRandomOrder()
        //     ->take(5)
        //     ->get();      uncomment this after all products are filled with good quality images
        $random_products =Product::where('id_Categorie',2)->take(5)->get();  // comment this variable and add the other one after the products are filled
        $latest_blogs = Blog::latest()->take(4)->get();
        return view('laprint.index', compact('random_products' , 'latest_blogs'));
    }
    function blog()
    {
        $blogs = Blog::paginate(2);
        $tags  = Tag::take(12)->get();
        $latest_blogs = Blog::latest()->take(2)->get();

        return view('laprint.blog', compact('blogs', 'tags', 'latest_blogs'));
    }
    public function filterTag($tag)
    {
        $tagBlogs = TagBlog::where('id_tag', $tag)->get();

        $blogIds = $tagBlogs->pluck('id_blog');

        $blogs = Blog::whereIn('id', $blogIds)->paginate(2);

        $tags  = Tag::take(12)->get();
        $latest_blogs = Blog::latest()->take(2)->get();

        return view('laprint.blog', compact('blogs', 'tags', 'latest_blogs'));
    }

    public function searchBlog(Request $request)
    {

        $tags  = Tag::take(12)->get();
        $latest_blogs = Blog::latest()->take(2)->get();
        $keyword = $request->input('search');

        $blogs = Blog::where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->paginate(2);

        return view('laprint.blog', compact('blogs', 'tags', 'latest_blogs'));
    }



    public function cat($id)
    {
        $category = Category::findOrFail($id);
        return view('laprint.category', compact('category'));
    }

    public function pro($id)
    {
        $product = Product::findOrFail($id);
        return view('laprint.product', compact('product'));
        //return dd($product);
    }


    public function variants(Product $product)
    {
        $product->load('productVariants.variant');

        return view('laprint.produit-1', compact('product'));
        return $product;
    }

    public function cart_item(Request $req)
    {
        return $req;
    }


    public function AboutUs()
    {
        return view('laprint.aboutus');
    }
    public function contact()
    {
        return view('laprint.contact');
    }
    public function contactC(Request $request)
    {
        $command= $request->command;
        $product = $request->produit;
        return view('laprint.contact' ,compact('command' , 'product'));
    }

     public function sendEmail(Request $request)
     {
         $request->validate([
           'email' => 'required|email',
           'subject' => 'required',
           'name' => 'required',

         ]);

         $data = [
           'subject' => $request->subject,
           'name' => $request->name,
           'email' => $request->email,
         ];

         Mail::send('email-template', $data, function($message) use ($data) {
          $message->to($data['email'])
           ->subject($data['subject']);
         });

         return redirect('/')->with(['message' => 'Email successfully sent!']);
     }


    public function variants2(Product $product)
    {
        $product->load('productVariants.variant');


        return view('laprint.variants', compact('product'));
        //return view('laprint.variants2', compact('product'));

        return $product;
    }
}
