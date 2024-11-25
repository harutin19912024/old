@extends('layouts.site')

@section('content')

    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>Ресторан 1001 Ночь</h5>
                            <h1>Восточный ресторан в центре города</h1>
{{--                            <a href="{{ route('food_menu') }}" class="btn_1">Меню</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about_part">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="about_part_iner">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="about_text">
                                    <h5>{{ __('home.aboutUs') }}</h5>
                                    <h2>{{ $aboutInfo->title }}</h2>
                                    <p>{{ $aboutInfo->short_description }}</p>
                                    @php echo mb_strimwidth($aboutInfo->description, 0, 401, "...")
                                    @endphp
{{--                                    <p>{{ mb_strimwidth($aboutInfo->description, 0, 406, "...") }}</p>--}}
                                    <a href="{{ route('about') }}" class="btn_3">{{ __('home.learnMore') }}</a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="about_img">
                                    <img src='{{asset("/uploads/$aboutInfo->path")}}' alt="{{$aboutInfo->title}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div id="mycarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
{{--            <ol class="carousel-indicators">--}}
{{--                <li data-target="#mycarousel" data-slide-to="0"  class="active"></li>--}}
{{--                <li data-target="#mycarousel" data-slide-to="1"></li>--}}
{{--                <li data-target="#mycarousel" data-slide-to="2"></li>--}}
{{--            </ol>--}}
            <div class="carousel-inner">
                @foreach($slider as $image)
                    <div class="carousel-item ">
                        <img src="{{ asset("uploads/".$image->path)}}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#mycarousel" role="button" data-slide="prev">
                <div class="banner-icons">
                    <span class="fas fa-angle-left"></span>
                </div>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#mycarousel" role="button" data-slide="next">
                <div class="banner-icons">
                    <span class="fas fa-angle-right"></span>
                </div>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <section class="food_menu">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section_tittle">
                        <p>{{ __('home.deliciousMenu') }}</p>
                        <h2>Популярное меню</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-member">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <?php $count = 0;?>
                                @foreach($products as $product)

                                    @if($count <= 2)
                                <div class="single_food_item media">
                                    <img src='{{ asset("uploads/".$product->logo)}}' style="width:210px !important;height:165px !important"
                                            alt="{{$product->title}}"
                                            class="img-responsive" >
                                    <div class="media-body align-self-center">
                                        <h3>{{$product->title}}</h3>
                                        <p>{{$product->uses_desc}}</p>
{{--                                        <h5>{{$product->price}}</h5>--}}
                                    </div>
                                </div>
                                    @endif
                                            <?php $count++; ?>
                                @endforeach
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <?php $count = 0;?>
                                @foreach($products as $product)
                                    @if($count > 2 && $count < 6)
                                        <div class="single_food_item media">
                                            <img src='{{ asset("uploads/".$product->logo)}}' style="width:210px !important;height:165px !important"
                                            alt="{{$product->title}}"
                                            class="img-responsive" >
                                            <div class="media-body align-self-center">
                                                <h3>{{$product->title}}</h3>
                                                <p>{{$product->uses_desc}}</p>
{{--                                                <h5>{{$product->price}}</h5>--}}
                                            </div>
                                        </div>
                                    @endif
                                        <?php $count++; ?>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--    <section class="intro_video_bg">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="intro_video_iner text-center">--}}
{{--                        <div class="intro_video_icon">--}}
{{--                            <a id="play-video_1" class="video-play-button popup-youtube"--}}
{{--                               href="https://www.youtube.com/watch?v=pBFQdxA-apI">--}}
{{--                                <span class="ti-control-play"></span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    --}}
{{--                                @foreach($slider as $image)--}}
{{--                            <div class="owl-item " style="width: 334.333px; margin-right: 20px;">--}}
{{--                                <div class="client_review_single">--}}
{{--                                        <img class="d-block w-100" src="{{ asset("uploads/".$image->path)}}" style="width:100%;"  alt="{{$image->title}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                                @endforeach--}}




    <section class="review_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle">
                        <p>Отзывы</p>
                        <h2>Что они сказали</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11">
                    <div class="client_review_part owl-carousel owl-loaded owl-drag">


                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                 style="transition: all 0.25s ease 0s; width: 4252px; transform: translate3d(-2125px, 0px, 0px);">
                                @foreach($overview as $image)
                                <div class="owl-item " style="width: 334.333px; margin-right: 20px;">
                                    <div class="client_review_single">
                                        <div class="client_review_text">
                                            <p>
                                                {{$image->text1}}

                                            </p>
                                            <div class="client_review_img">
                                                <div>
                                                <img src="{{ asset("uploads/".$image->path)}}" alt="#"
                                                     data-pagespeed-url-hash="729397122">
                                                </div>
                                                <h4>{{$image->title}}</h4>
                                                <div class="review_icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
{{--                        <div class="owl-nav disabled">--}}
{{--                            <button type="button" role="presentation" class="owl-prev"><span--}}
{{--                                    aria-label="Previous">‹</span></button>--}}
{{--                            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="owl-dots">--}}
{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                            <button role="button" class="owl-dot active"><span></span></button>--}}
{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact_part section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_part_iner">
                        <h3>{{ __('home.contactUs') }}</h3>
                        <div class="single_contact_part">
                            <h5>{{ __('home.address') }}</h5>
                            <p>{{ $contactInfo->country }} {{ $contactInfo->factory_name }}</p>
                        </div>
                        <div class="single_contact_part">
                            <h5>{{ __('home.weareopen') }}</h5>
                            <p>{{ $contactInfo->fax_number }}</p>
                        </div>
                        <div class="single_contact_part">
                            <h5>{{ __('home.reservation') }}</h5>
                            <p><a href="tel:{{ $contactInfo->telephone_number }}">{{ $contactInfo->telephone_number }}</a></p>
                            <p><a href = "mailto: {{ $contactInfo->po_box }}">{{ $contactInfo->po_box }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>

</script>
