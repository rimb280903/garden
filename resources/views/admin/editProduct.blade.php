@extends('admin.dashboard')

@section('content')


    <div class="container mt-2">
        <form action="{{route('admin.product.update',$product->id)}}" method="POST" >
            @csrf
            @method('patch')
          
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset("/assets/images/dynamic/".$product->image_path) }}"
                    alt="{{ $product->nom_P }}" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom_P">Nom</label>
                        <input type="text" name="nom_P" id="nom_P" class="form-control" 
                        value="{{ old('nom_P', $product->nom_P) }}" required>
                        @if ($errors->has('nom_P'))
                            <span class="text-danger">{{ $errors->first('nom_P') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description_P">Description</label>
                        <textarea name="description_P" id="description_P" class="form-control" rows="5" required>{{ old('description_P', $product->description_P) }}</textarea>
                        @if ($errors->has('description_P'))
                            <span class="text-danger">{{ $errors->first('description_P') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="prix_base">Prix de base</label>
                        <input type="number" name="prix_base" id="prix_base" class="form-control"
                        value="{{ old('prix_base', $product->prix_base) }}" required step="any">
                        @if ($errors->has('prix_base'))
                            <span class="text-danger">{{ $errors->first('prix_base') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="id_Categorie">Catégorie</label>
                        <select name="id_Categorie" id="id_Categorie" class="form-control" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('id_Categorie', $product->id_Categorie) == $category->id ? 'selected' : '' }}>{{ $category->nom_C }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_Categorie'))
                            <span class="text-danger">{{ $errors->first('id_Categorie') }}</span>
                        @endif
                    </div>
                    <center>
                    <button type="submit" class="btn btn-primary">Modifier</button></center>
                </div>
            </div>
            <hr>


            <h3>Product Variants</h3>
            <div class="mb-3">
    @foreach ($variants as $variant)
@if ($product->productVariants()->where('id_variante', $variant->id)->count() > 0)
    <div class="border mb-3 p-3">
        <label for="variant_{{ $variant->id }}" class="col-form-label">{{ $variant->nom_V }}:</label>
        @foreach ($product->productVariants()->where('id_variante', $variant->id)->get() as $productVariant)
            <div class="row">
                <div class="col">
                    <input type="text" id="variant_{{ $variant->id }}_valeur"
                    name="variant[{{ $variant->id }}][valeur][]" value="{{ $productVariant->valeur ?? '' }}" class="form-control" >
                    <input type="hidden" name="variant[{{ $variant->id }}][line_id][]" value="{{ $productVariant->id }}"> 
                </div>
                <div class="col">
                    <input type="number" id="variant_{{ $variant->id }}_prix" name="variant[{{ $variant->id }}][prix][]"  step="0.001" value="{{ $productVariant->prix ?? '' }}" class="form-control">
                </div>
                
            </div>
        @endforeach
    </div>
@endif
@endforeach


  </div>
<button type="submit" class="btn btn-primary">Update product</button>

</form>
@endsection