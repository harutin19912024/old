@extends('layouts.site')

@section('content')

    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
{{--                            <p>home. elements</p>--}}
                            <h2>Галерея</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="lightbox-gallery">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Меню</h2>
                <p class="text-center">Важнейшее место в меню занимает мясо, приготовленное на открытом огне с добавлением восточных пряностей. </p>
            </div>
            <div class="row photos">
                @foreach($gallery as $image)
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{ asset("uploads/".$image->logo)}}" data-lightbox="photos"><img class="img-fluid" src="{{ asset("uploads/".$image->logo)}}"></a></div>
                @endforeach
            </div>
        </div>
    </div>







    </div>
    </div>
    </div>




@endsection
