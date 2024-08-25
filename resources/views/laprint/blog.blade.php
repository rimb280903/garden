@extends('layouts.header')
@section('content')
    <!-- breadcrumb section start -->
    <section class="breadcrumb-section pt-180 pb-180 bg_img" data-background="assets/images/bg/breadcrumb-bg-1.jpeg"
        data-overlay="dark" data-opacity="3">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 d-flex pr-0">
                    <div class="breadcrumb-text">
                        <h2 class="breadcrumb-text__title">
                            BLOGS
                        </h2>
                        <ul class="breadcrumb-text__nav">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb section end -->






























    <!-- news area start -->
    <div class="blog__area blog__area--2 pt-125 pb-125">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    @foreach ($blogs as $blog)
                        
                   
                    <article class="blog__box blog__box--3 blog__box--image mb-40">
                        <div class="thumb">

                            <img src="/assets/images/dynamic/{{ $blog->image_path }}" alt="{{$blog->iamge_path}}">

                        </div>
                        <div class="content pt-50">
                            <div class="cat">
                                <span>LaPrint ©</span>
                            </div>
                            <h3 class="title">
                               {{$blog->title}}
                            </h3>
                            <div class="meta mt-20 mb-20">
                                <!-- <span><i class="far fa-eye"></i> 232 Views </span>
                                <span><a href="{{ url('#0') }}"><i class="far fa-comments"></i> 35 Comments</a></span> -->
                                <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('jS F Y') }}</span>

                            </div>
                            <div class="post-text mb-35">
                                <p>{{$blog->description}}</p>
                            </div>
                            <div class="post-bottom mt-30">
                                <!-- <div class="authore">
                                    <img src="assets/images/news/news-list-authore.png" alt="">
                                    <span>by Hetmayar</span>
                                </div> -->
                                
                            </div>
                        </div>
                    </article>
                    @endforeach
















                    <div class="blog__pagination mt-40">
                        <ul>
                            @if ($blogs->onFirstPage())
                                <li class="disabled"><span><i class="fas fa-angle-double-left"></i></span></li>
                            @else
                                <li><a href="{{ $blogs->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
                            @endif
                            
                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                            
                            @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                            @else
                                <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                            @endif
                            
                            @if ($blogs->lastPage() > 3)
                                <li><a href="{{ $blogs->url($blogs->lastPage()) }}"><i class="fas fa-ellipsis-h"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="sidebar-wrap">



                        <div class="widget sidebar grey-bg mb-40">
                            <h4 class="sidebar__title mb-30">
                                <span><img src="{{ asset('/assets/images/shape/heading-shape-3.png') }}" class="mr-5"
                                        alt=""></span>
                                Search Blogs  
                            </h4>
                            <form class="sidebar-search-form" method="post" action="{{route('blog.search')}}">
                                @csrf
                                <input type="text" placeholder="Search your keyword..." name="search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>


                        <div class="widget sidebar grey-bg mb-40">
                            <h4 class="sidebar__title mb-30">
                                <span><img src="{{ asset('/assets/images/shape/heading-shape-3.png') }}" class="mr-5"
                                        alt=""></span>
                                Latest Blogs
                            </h4>
                            <ul class="recent-posts">
                                @foreach ($latest_blogs as $lb)
                                    
                                <li>
                                    <div class="thumb mb-2">
                                      
                                        <img src="/assets/images/dynamic/{{ $lb->image_path }}" alt="{{$lb->iamge_path}}">
                                                
                                    </div>
                                    <div class="content">
                                        <h6 class="title">{{$lb->title}}</h6>
                                        <div class="meta"> {{ $lb->created_at->format('jS F Y') }}</div>
                                    </div>
                                </li>
                               @endforeach
                            </ul>
                        </div>


                        <!-- <div class="widget sidebar grey-bg mb-40">
                            <h4 class="sidebar__title mb-30">
                                <span><img src="{{ asset('/assets/images/shape/heading-shape-3.png') }}" class="mr-5" alt=""></span>
                                Social media
                            </h4>
                            <div class="social__links">
                                <a href="{{ url('#0') }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ url('#0') }}"><i class="fab fa-twitter"></i></a>
                                <a href="{{ url('#0') }}"><i class="fab fa-pinterest-p"></i></a>
                                <a href="{{ url('#0') }}"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div> -->


                        <div class="widget sidebar grey-bg mb-40">
                            <h4 class="sidebar__title mb-30">
                                <span><img src="{{ asset('/assets/images/shape/heading-shape-3.png') }}" class="mr-5"
                                        alt=""></span>
                                Popular Tags
                            </h4>
                            <div class="tag">
                                @foreach ($tags as $tag)
                                <a href="{{ route('blogs.tag', $tag->id) }}" class="site-btn">{{ $tag->name }}</a>
                            @endforeach
                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news area end -->
@endsection
