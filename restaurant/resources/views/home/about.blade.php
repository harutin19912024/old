@extends('layouts.site')

@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
{{--                            <p>Home. About</p>--}}
                            <h2>{{ __('home.aboutUs') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about_part single_about_page padding_bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="about_part_iner">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="about_text">
{{--                                    <h5>{{ __('home.aboutUs') }}</h5>--}}
                                    <h2>{{ $aboutInfo->title }}</h2>
{{--                                    <p>{{ $aboutInfo->short_description }}</p>--}}
                                    @php echo $aboutInfo->description
                                    @endphp
{{--                                    <a href="{{ route('about') }}" class="btn_3">{{ __('home.learnMore') }}</a>--}}
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


{{--    <section class="review_part section_padding">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-xl-5">--}}
{{--                    <div class="section_tittle">--}}
{{--                        <p>Отзывы</p>--}}
{{--                        <h2>Что они сказали</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-11">--}}
{{--                    <div class="client_review_part owl-carousel owl-loaded owl-drag">--}}


{{--                        <div class="owl-stage-outer">--}}
{{--                            <div class="owl-stage"--}}
{{--                                 style="transition: all 0.25s ease 0s; width: 4252px; transform: translate3d(-2125px, 0px, 0px);">--}}
{{--                                @foreach($overview as $image)--}}
{{--                                    <div class="owl-item cloned" style="width: 334.333px; margin-right: 20px;">--}}
{{--                                        <div class="client_review_single">--}}
{{--                                            <div class="client_review_text">--}}
{{--                                                <p>--}}
{{--                                                    {{$image->text1}}--}}

{{--                                                </p>--}}
{{--                                                <div class="client_review_img">--}}
{{--                                                    <img src="{{ asset("uploads/".$image->path)}}" alt="#"--}}
{{--                                                         data-pagespeed-url-hash="729397122">--}}
{{--                                                    <h4>{{$image->title}}</h4>--}}
{{--                                                    <div class="review_icon">--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="owl-nav disabled">--}}
{{--                            <button type="button" role="presentation" class="owl-prev"><span--}}
{{--                                    aria-label="Previous">‹</span></button>--}}
{{--                            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        --}}{{--                        <div class="owl-dots">--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot active"><span></span></button>--}}
{{--                        --}}{{--                            <button role="button" class="owl-dot"><span></span></button>--}}
{{--                        --}}{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


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
                            <p><a href="tel: {{ $contactInfo->telephone_number }}">{{ $contactInfo->telephone_number }}</a></p>
                            <p><a href = "mailto: {{ $contactInfo->po_box }}">{{ $contactInfo->po_box }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
