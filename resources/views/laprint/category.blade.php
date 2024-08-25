
{{--  @extends('layouts.app')

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
@endsection--}}

    

@extends('layouts.header')

@section('content')

  <div class="project-area mt-2">
    <div class="container-fluid">
        <div class="row project-row mt-none-30">
            @foreach($category->products as $product)
                <div class="col-xl-4 col-md-4 col-lg-4 mt-30">
                    <div class="project-item">
                        <div class="project-item__thumb">
                            <img src="{{ asset('assets/images/dynamic/' . $product->image_path) }}" >
                        </div>
                        <div class="project-item__hover" data-overlay="dark" data-opacity="9">
                            <a href="{{ route('variants2',$product->id) }}" class="project-item__link"><i class="far fa-arrow-right"></i></a>
                            <div class="project-item__content">
                                <h4 class="project-item__title">{{ $product->nom_P }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection