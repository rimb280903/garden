<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class AdminController extends Controller
{


    public function dashboardView()
    {
        return view('admin.dashboard');
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

        $products = Product::with('category')->get();

        return view('admin.products', compact('products'));
    }
    public function categories()
    {

        $categories = Category::get();

        return view('admin.categories', compact('categories'));
    }



    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $variants = Variant::all();
        return view('admin.editProduct', compact('product', 'categories', 'variants'));
    }
    public function productDeleteVariant($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = Variant::all();
        return view('admin.productDeleteVariant', compact('product', 'variants'));
    }

    public function productDestroyVariant($productVariantID)
    {
        $line= ProductVariant::findOrFail($productVariantID);
        $line->delete();
        return redirect()->back()->with('success' , 'deleted with success!');
    }

    public function updateProduct($id, Request $request)
    {

        // update table produit
        $product = Product::findOrFail($id);
        $product->update([
            'nom_P' => $request->input('nom_P'),
            'description_P' => $request->input('description_P'),
            'prix_base' => $request->input('prix_base'),
            'id_Categorie' => $request->input('id_Categorie'),
        ]);
        //------------------------------

        // a variable that has all the data from the form
        $formData = $request->input('variant', []);

        $reformatedData = array();

        foreach ($formData as $variant) {
            $lineId = $variant['line_id'];
            $valeur = $variant['valeur'];
            $prix = $variant['prix'];

            $reformatedData[] = array(
                'line_id' => $lineId,
                'valeur' => $valeur,
                'prix' => $prix
            );
        }

        foreach ($reformatedData as $result) {
            $lineIds = $result['line_id'];
            $valeurs = $result['valeur'];
            $prixs = $result['prix'];

            // Get the existing variants based on the line IDs
            $existingVariants = ProductVariant::whereIn('id', $lineIds)->get();

            // Update the variant values based on the order of the line IDs
            foreach ($existingVariants as $index => $variant) {
                $variant->valeur = $valeurs[$index];
                $variant->prix = $prixs[$index];
                $variant->save();
            }
        }

        return redirect()->route('admin.products')->with('success', 'Updated successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editCategory', compact('category'));
    }


    public function updateCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->update(
            [
                'nom_C' => $request->nom_C,
                "description_C" => $request->description_C,

            ]); 
            return redirect()->route('admin.categories')->with('success', 'Updated successfully!');

    }

    public function addProduct()
    {
        $categories = Category::get();
        return view('admin.addProduct',compact('categories'));
    }

    public function storeProduct(Request $request)
    {  
        $validatedData = $request->validate([
        'nom_P' => 'required|max:255|unique:produit',
        'description_P' => 'required',
        'prix_base' => 'required|numeric|min:0',
        'id_Categorie' => 'required|exists:categories,id',
        'image_path' => 'required|image|max:2048',
        ]);
    
        // Store the image in the specified directory
        $image=$request->file("image_path")->getClientOriginalName();
        $request->file("image_C")->move(public_path('assets/images/dynamic'),$image);
    
        // Create the product in the database
        Product::create([
            'nom_P' => $request->input('nom_P'),
            'description_P' => $request->input('description_P'),
            'prix_base' => $request->input('prix_base'),
            'id_Categorie' => $request->input('id_Categorie'),
            'image_path' => $image,
        ]);
   

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
}


    public function productAddVariant($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = Variant::all();
        return view('admin.productAddVariant', compact('product', 'variants'));
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

        foreach ($validatedData['variant'] as $key => $variantId) {
            $productVariant = new ProductVariant([
                'id_produit' => $request->productID,
                'id_variante' => $variantId,
                'valeur' => $validatedData['value'][$key],
                'prix' => $validatedData['price'][$key],
            ]);
            $productVariant->save();
        }
        
        return redirect()->route('admin.products')->with('success', 'Added successfully!');

    }


    public function addCategory()
    {
        
        return view('admin.addcategory');
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
        $image=$request->file("image_C")->getClientOriginalName();
        $request->file("image_C")->move(public_path('assets/images/dynamic'),$image);

        // Save the category data to the database
        Category::create([
            'nom_C' => $validatedData['nom_C'],
            'description_C' => $validatedData['description_C'],
            'image_C' => $image
        ]);

        // Redirect back with success message
        return redirect()->route('admin.categories')->with('success', 'Added successfully!');
    }

    public function variants ()
    {
        $variants = Variant::get();
        return view('admin.variants',compact('variants'));
    }

    public function addVariant(Request $request)
    {
        $validatedData=$request->validate([
            'nom_V' => 'required|unique:variante'
        ]);

       
         Variant::create([
            'nom_V' => $validatedData['nom_V']
        ]);

        return redirect()->route('admin.variants')->with('success', 'Variant created successfully.');
    }

    public function updateVariant($id,Request $request)
    {
        $request->validate([
            'nom_V' => 'required|unique:variante,nom_V,'.$id,
        ]);

        $variant = Variant::findOrFail($id);
        $variant->update([
            'nom_V' => $request->input('nom_V'),
        ]);

        return redirect()->route('admin.variants')->with('success', 'Variant updated successfully.');
    }

}
