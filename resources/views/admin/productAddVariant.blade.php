@extends('admin.dashboard')
@section('content')
<form method="POST" action="{{route('admin.product.store.variant')}}">
    @csrf
    <div class="form-group">
        <label for="product">Product :  </label>
        <input type="text" value="{{$product->nom_P}}" name="product" readonly id="product" class="form-control">
        <input type="hidden" name="productID" value="{{$product->id}}" >
    </div>
    <div id="variants">
        <div class="form-group row">
            <div class="col-md-4">
                <label for="variant">Variant:</label>
                <select class="form-control" name="variant[]">
                    @foreach($variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->nom_V }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="value">Value:</label>
                <input type="text" class="form-control" name="value[]">
            </div>
            <div class="col-md-3">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price[]">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-primary btn-add">+</button>
            </div>
        </div>
    </div>
    <div class="text-center">

    <button type="submit" class="btn btn-primary">Done</button>
    <a href="{{ route('admin.product', $product->id) }}" 
        class="btn btn-success mx-2">Check Variants</a>

        
    </div>
</form>

    <script>
    $(document).ready(function() {
        var variants = {!! json_encode($variants) !!};
        // Initialize the add button
        $('.btn-add').click(function() {
            var html = '<div class="form-group row">' +
                '<div class="col-md-4">' +
                '<label for="variant">Variant:</label>' +
                '<select class="form-control" name="variant[]">';
            // Add options to the select field
            for (var i = 0; i < variants.length; i++) {
                html += '<option value="' + variants[i].id + '">' + variants[i].nom_V + '</option>';
            }
            html += '</select></div>' +
                '<div class="col-md-4">' +
                '<label for="value">Value:</label>' +
                '<input type="text" class="form-control" name="value[]">' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label for="price">Price:</label>' +
                '<input type="text" class="form-control" name="price[]">' +
                '</div>' +
                '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger btn-remove">-</button>' +
                '</div></div>';
            // Add the new fields to the variants div
            $('#variants').append(html);
        });

        // Initialize the remove button
        $(document).on('click', '.btn-remove', function() {
            $(this).closest('.form-group.row').remove();
        });
    });
</script>
@endsection

    
