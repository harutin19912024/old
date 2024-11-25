@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            @csrf



                            <div class="form-group">
                                <label for="country">Страна, Город <strong class="text-danger"> &#42; </strong> </label>
                                @error('country')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="country"
                                       placeholder="Россия, Санкт-Петербург" name="country" value="{{old('country')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="factory_name">Улица<strong class="text-danger"> &#42; </strong> </label>
                                @error('factory_name')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="factory_name"
                                       placeholder="Невский 1/1" name="factory_name" value="{{old('factory_name')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone_number">Телефон<strong class="text-danger"> &#42; </strong> </label>
                                @error('telephone_number')
                                <p class="invalid-feedback text-danger phone_err" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <p class="invalid-feedback text-danger phone_err " style="display: none" role="alert"></p>
                                <input type="text" class="form-control" id="telephone_number"
                                       placeholder="+7777777777" name="telephone_number" value="{{old('telephone_number')}}" required>
                            </div>

                            <div class="form-group">
                                <label for="fax_number">Режим работы<strong class="text-danger"> &#42; </strong> </label>
                                @error('fax_number')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="fax_number"
                                       placeholder="12:00 - 23:00" name="fax_number" value="{{old('fax_number')}}" required>
                            </div>

                            <div class="form-group">
                                <label for="po_box">Почта</label>
                                @error('po_box')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="po_box"
                                       placeholder="pochta@mail.ru" name="po_box" value="{{old('po_box')}}" >
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light col-md-12">Save {{$title}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script>
        // $(document).ready(function () {
        //     $("#telephone_number").on('input', function () {
        //         regex = /^([0-9\s\-\+\(\)]*)$/;
        //         if (!$(this).val().match(regex)) {
        //             $('.phone_err').empty().append(`<strong>Please enter correct telephone number.</strong>`).show();
        //         }
        //         else{
        //             $('.phone_err').empty().hide();
        //         }
        //     })
        // })
    </script>
@endpush


