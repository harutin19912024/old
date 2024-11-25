@extends('layouts.site')

@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
{{--                            <p>Контакты</p>--}}
                            <h2>Контакты</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-section section_padding">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4" >


                <div id="map" style="width: 100%; height: 300px"></div>



                 <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>" type="text/javascript"></script>
                <script >
                    ymaps.ready(init);

                    function init() {
                        var myMap = new ymaps.Map("map", {
                                center: [59.943142, 30.322228],
                                zoom: 14
                            }, {
                                searchControlProvider: 'yandex#search'
                            }),

                            // Создаем геообъект с типом геометрии "Точка".
                            myGeoObject = new ymaps.GeoObject({
                                // Описание геометрии.
                                geometry: {
                                    type: "Point",
                                    coordinates: [55.8, 37.8]
                                },
                                // Свойства.
                                properties: {
                                    // Контент метки.
                                    iconContent: 'Я тащусь',
                                    hintContent: 'Ну давай уже тащи'
                                }
                            }, {
                                // Опции.
                                // Иконка метки будет растягиваться под размер ее содержимого.
                                preset: 'islands#blackStretchyIcon',
                                // Метку можно перемещать.
                                draggable: true
                            }),
                            myPieChart = new ymaps.Placemark([
                                55.847, 37.6
                            ], {
                                // Данные для построения диаграммы.
                                data: [
                                    {weight: 8, color: '#0E4779'},
                                    {weight: 6, color: '#1E98FF'},
                                    {weight: 4, color: '#82CDFF'}
                                ],
                                iconCaption: "Диаграмма"
                            }, {
                                // Зададим произвольный макет метки.
                                iconLayout: 'default#pieChart',
                                // Радиус диаграммы в пикселях.
                                iconPieChartRadius: 30,
                                // Радиус центральной части макета.
                                iconPieChartCoreRadius: 10,
                                // Стиль заливки центральной части.
                                iconPieChartCoreFillStyle: '#ffffff',
                                // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                                iconPieChartStrokeStyle: '#ffffff',
                                // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                                iconPieChartStrokeWidth: 3,
                                // Максимальная ширина подписи метки.
                                iconPieChartCaptionMaxWidth: 200
                            });

                        myMap.geoObjects
                            .add(myGeoObject)
                            .add(new ymaps.Placemark([59.943142, 30.322228], {
                                balloonContent: 'цвет <strong>голубой</strong>',
                                iconCaption: 'Ресторан 1001 ночь'
                            }, {
                                preset: 'islands#blueCircleDotIconWithCaption',
                                iconCaptionMaxWidth: '50'
                            }));
                    }

                </script>
            </div>



            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Для заявки на банкеты свяжитесь с нами</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form"
                          action="/site/contactus" method="post"
                          id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                          onfocus="this.placeholder = &#39;&#39;"
                                          onblur="this.placeholder = &#39;Enter Message&#39;"
                                          placeholder="Текст"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                           onfocus="this.placeholder = &#39;&#39;"
                                           onblur="this.placeholder = &#39;Enter your name&#39;"
                                           placeholder="Имя">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                           onfocus="this.placeholder = &#39;&#39;"
                                           onblur="this.placeholder = &#39;Enter email address&#39;"
                                           placeholder="Почта">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                           onfocus="this.placeholder = &#39;&#39;"
                                           onblur="this.placeholder = &#39;Enter Subject&#39;" placeholder="Заголовок">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_4">
                                Отправить письмо
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{ $contactInfo->country }}</h3>
                            <p>{{ $contactInfo->factory_name }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><a href="tel: {{ $contactInfo->telephone_number }}">{{ $contactInfo->telephone_number }}</a></h3>
                            <p>{{ $contactInfo->fax_number }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href = "mailto: {{ $contactInfo->po_box }}">{{ $contactInfo->po_box }}</a></h3>
                            <p>Отправьте нам свой запрос в любое время!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
