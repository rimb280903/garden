<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\TagBlog;

class AdminController2 extends Controller
{


    public function dashboardView()
    {
        return view('admin2.dashboard');
    }

    public function loginform()
    {
        if (auth()->check()) {
            return redirect()->route('admin2.products');
        }
        return view('admin.login');
    }

    public function products()
    {

        $selected = 1;
        $products = Product::with('category')->get();
        $categories = Category::get();

        return view('admin2.products', compact('products', 'categories', 'selected'));
    }

    public function softProducts()
    {
        $products = Product::with('category')
            ->whereHas('category', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->onlyTrashed()
            ->get();
        return view('admin2.restoreProducts', compact('products'));
    }


    public function softDeleteProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();

            return redirect()->route('admin2.products')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->route('admin2.products')->with('error', 'Unable to delete product.');
        }
    }


    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product->restore()) {
            return redirect()->route('admin2.softProduct')->with('success', 'Product restored successfully.');
        } else {
            return redirect()->route('admin2.softProduct')->with('error', 'Failed to restore product.');
        }
    }


    public function hardDeleteProduct($id)
    {
        $product = Product::withTrashed()->find($id);

        if (!$product) {
            return redirect()->route('admin2.softProduct')->with('error', 'Product not found.');
        }

        $product->forceDelete();

        return redirect()->route('admin2.softProduct')->with('success', 'Product permanently deleted.');
    }


    public function categoryFilter(Request $request)
    {
        $selected = $request->category;
        $categories = Category::get();
        $products = Product::with('category')->where('id_Categorie', $selected)->get();

        return view('admin2.products', compact('products', 'categories', 'selected'));
    }


    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $variants = Variant::all();
        return view('admin2.editProduct', compact('product', 'categories', 'variants'));
    }


    public function productDeleteVariant($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = Variant::all();
        return view('admin2.productDeleteVariant', compact('product', 'variants'));
    }


    public function productDestroyVariant($productVariantID)
    {
        $line = ProductVariant::find($productVariantID);

        if (!$line) {
            return redirect()->back()->with('error', 'Variant not found!');
        }

        if ($line->delete()) {
            return redirect()->back()->with('success', 'Variant deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete variant!');
        }
    }


    public function updateProduct($id, Request $request)
    {
        $data = $request->validate([
            'nom_P' => 'required',
            'description_P' => 'required',
            'prix_base' => 'required|numeric|min:0',
            'id_Categorie' => 'required|exists:categorie,id',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $updateResult = $product->update($data);

        if (!$updateResult) {
            return redirect()->back()->with('error', 'Failed to update product!');
        }

        $formData = $request->input('variant', []);

        $reformatedData = collect($formData)->map(function ($variant) {
            return [
                'line_id' => $variant['line_id'],
                'valeur' => $variant['valeur'],
                'prix' => $variant['prix'],
            ];
        });

        $reformatedData->each(function ($result) {
            $existingVariants = ProductVariant::whereIn('id', $result['line_id'])->get();

            foreach ($existingVariants as $index => $variant) {
                $variant->valeur = $result['valeur'][$index];
                $variant->prix = $result['prix'][$index];
                $variant->save();
            }
        });

        return redirect()->route('admin2.products')->with('success', 'Product updated successfully!');
    }


    public function softDeleteCategory($id)
    {
        $Category = Category::find($id);
        if ($Category) {
            $Category->delete();

            return redirect()->route('admin2.categories')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('admin2.categories')->with('error', 'Unable to delete category.');
        }
    }


    public function softCategories()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin2.restoreCategories', compact('categories'));
    }


    public function restoreCategory($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category->restore()) {
            return redirect()->route('admin2.softCategory')->with('success', 'Category restored successfully.');
        } else {
            return redirect()->route('admin2.softCategory')->with('error', 'Failed to restore Category.');
        }
    }


    public function hardDeleteCategory($id)
    {
        $category = Category::withTrashed()->find($id);

        if (!$category) {
            return redirect()->route('admin2.softCategory')->with('error', 'Category not found.');
        }

        $category->forceDelete();

        return redirect()->route('admin2.softCategory')->with('success', 'Category permanently deleted.');
    }


    public function addProduct()
    {
        $categories = Category::get();
        return view('admin2.addProduct', compact('categories'));
    }


    public function storeProduct(Request $request)
    {
        $validatedData = $request->validate([
            'nom_P' => 'required|max:255|unique:produit',
            'description_P' => 'required',
            'prix_base' => 'required|numeric|min:0',
            'id_Categorie' => 'required|exists:categorie,id',
            'image_path' => 'required|image|max:2048',
        ]);

        // Store the image in the specified directory
        $image = $request->file("image_path")->getClientOriginalName();

        $request->file("image_path")->move(public_path('assets/images/dynamic'), $image);

        // Create the product in the database
        $product = Product::create([
            'nom_P' => $request->input('nom_P'),
            'description_P' => $request->input('description_P'),
            'prix_base' => $request->input('prix_base'),
            'id_Categorie' => $request->input('id_Categorie'),
            'image_path' => $image,
        ]);

        if (!$product) {
            return redirect()->back()->with('error', 'Failed to create product!');
        }

        return redirect()->route('admin2.products')->with('success', 'Product created successfully!');
    }


    public function productAddVariant($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = Variant::all();
        return view('admin2.productAddVariant', compact('product', 'variants'));
    }


    public function productStoreVariant(Request  $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'productID' => 'required|exists:produit,id',
            'variant.*' => 'required|exists:variante,id',
            'value.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
        ]);

        try {
            foreach ($validatedData['variant'] as $key => $variantId) {
                $productVariant = new ProductVariant([
                    'id_produit' => $request->productID,
                    'id_variante' => $variantId,
                    'valeur' => $validatedData['value'][$key],
                    'prix' => $validatedData['price'][$key],
                ]);
                $productVariant->save();
            }
            return redirect()->route('admin2.products')->with('success', 'Variants added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding variants.');
        }
    }


    public function categories()
    {

        $categories = Category::get();

        return view('admin2.categories', compact('categories'));
    }


    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin2.editCategory', compact('category'));
    }


    public function updateCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $updated = $category->update([
            'nom_C' => $request->nom_C,
            'description_C' => $request->description_C,
        ]);
        if ($updated) {
            return redirect()->route('admin2.categories')->with('success', 'Updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }


    public function addCategory()
    {

        return view('admin2.addcategory');
    }


    public function storeCategory(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nom_C' => 'required|max:255|unique:categorie',
            'description_C' => 'nullable',
            'image_C' => 'image|max:2048|required'
        ]);

        // Upload the image if it exists
        $image = $request->file("image_C")->getClientOriginalName();
        $request->file("image_C")->move(public_path('assets/images/dynamic'), $image);

        // Save the category data to the database
        $category = Category::create([
            'nom_C' => $validatedData['nom_C'],
            'description_C' => $validatedData['description_C'],
            'image_C' => $image
        ]);

        if ($category) {
            // Redirect back with success message
            return redirect()->route('admin2.categories')->with('success', 'Category added successfully!');
        } else {
            // Redirect back with error message
            return redirect()->route('admin2.categories')->with('error', 'Failed to add category.');
        }
    }


    public function variants()
    {
        $variants = Variant::get();
        return view('admin2.variants', compact('variants'));
    }


    public function addVariant(Request $request)
    {
        $validatedData = $request->validate([
            'nom_V' => 'required|unique:variante'
        ]);

        $variant = Variant::create([
            'nom_V' => $validatedData['nom_V']
        ]);

        if (!$variant) {
            return redirect()->back()->with('error', 'Variant could not be created.');
        }

        return redirect()->route('admin2.variants')->with('success', 'Variant created successfully.');
    }


    public function updateVariant($id, Request $request)
    {
        $request->validate([
            'nom_V' => 'required|unique:variante,nom_V,' . $id,
        ], [
            'unique' => 'The variant name is already being used',
        ]);

        $variant = Variant::findOrFail($id);

        if (!$variant->update(['nom_V' => $request->input('nom_V')])) {
            return redirect()->back()->with('error', 'Variant could not be updated.');
        }

        return redirect()->route('admin2.variants')->with('success', 'Variant updated successfully.');
    }

    public function mails()
    {
        $mails = Contact::get();
        return view('admin2.mail', compact('mails'));
    }

    public function sendMail(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);
         

        $created = Contact::create([
            'name' => $request->name,
            'Lname' => $request->Lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);
       

        if ($created) {
            return redirect()->back()->with('success', 'message sent!');
        } else {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    public function deleteMail($id)
    {
        $Contact = Contact::find($id);
        if ($Contact) {
            $Contact->delete();

            return redirect()->route('admin2.mails')->with('success', 'Message deleted successfully.');
        } else {
            return redirect()->route('admin2.mails')->with('error', 'Unable to delete Message.');
        }
    }

    public function softMails()
    {
        $mails = Contact::onlyTrashed()->get();
        return view('admin2.restoreMail', compact('mails'));
    }


    public function restoreMail($id)
    {
        $Mail = Contact::withTrashed()->find($id);
        if ($Mail->restore()) {
            return redirect()->route('admin2.softMails')->with('success', 'Mail restored successfully.');
        } else {
            return redirect()->route('admin2.softMails')->with('error', 'Failed to restore Mail.');
        }
    }


    public function hardDeleteMail($id)
    {
        $Mail = Contact::withTrashed()->find($id);

        if (!$Mail) {
            return redirect()->route('admin2.softMails')->with('error', 'Mail not found.');
        }

        $Mail->forceDelete();

        return redirect()->route('admin2.softMails')->with('success', 'Mail permanently deleted.');
    }

    public function blogs()
    {
        $blogs = Blog::get();
        return view('admin2.blogs', compact('blogs'));
    }

    function editBlog($id)
    {
        $tags = Tag::get();
        $blog = Blog::findOrFail($id);
        return view('admin2.editBlog', compact('tags', 'blog'));
    }
    function updateBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        if ($request->hasFile('image_path')) {
            // Validate and store the new image
            $validatedData = $request->validate([
                'image_path' => 'image|max:2048'
            ]);
            $image = $request->file("image_path")->getClientOriginalName();

            $request->file("image_path")->move(public_path('assets/images/dynamic'), $image);
            $blog->image_path = $image;
        } else {
            // Keep the old image path
            $blog->image_path = $blog->image_path;
        }

        // Update the other fields
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->save();

        $tagNames = $request->input('tag_names');

        $blog->tags()->sync($tagNames);
        return redirect()->route('admin2.blog')->with('success','Blog Updated successfully ');
    }

    public function addBlog()
    {
        $tags = Tag::get();

        return view('admin2.addBlog', compact('tags'));
    }

    public function storeBlog(Request $request)
    {
        $tagNames = $request->input('tag_names');
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image_path' => 'nullable|required|image|max:2048',
            'tag_names.*' => 'integer|exists:tags,id',
        ]);
        $image = $request->file("image_path")->getClientOriginalName();

        $request->file("image_path")->move(public_path('assets/images/dynamic'), $image);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->description = $validatedData['description'];
        $blog->image_path = $image;
        $blog->save();


        $blog->tags()->sync($tagNames);
        return redirect()->route('admin2.blog')->with('success', 'blog added successfully');
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin2.blog')->with('success', 'blog deleted successfully');
    }

    public function addTags()
    {
        return view('admin2.addTags');
    }
    public function storeTags(Request $request)
    {

        $validatedData = $request->validate([
            'tag_names.*' => 'required|unique:tags,name'
        ], [
            'tag_names.*.required' => 'The tag name field is required.',
            'tag_names.*.unique' => 'The tag name must be unique.',
        ]);


        foreach ($request->tag_names as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
        }

        return redirect()->route('admin2.tags')->with('success', 'Tags created successfully.');
    }

    public function Tags()
    {
        $tags = Tag::get();
        return view('admin2.tags', compact('tags'));
    }
    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully.');
    }

    public function updateTag(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id,
        ]);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('success', 'Tag edited successfully.');
    }
}
