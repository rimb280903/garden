@extends('layouts.app')

@section('content')
<center> <div class="container border">
    <div class="row">
       
        
            <h1>{{ $product->nom_P }}</h1>
            <p>{{ $product->description_P }}</p>
            <h2>{{ $product->prix_base }} USD</h2>
            
                
                
                <a href="{{route('variants',$product)}}" class="btn btn-success">show variants</a>
            
        </div>
    </div>
</div></center>
@endsection
