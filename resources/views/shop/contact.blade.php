@extends('shop.layouts.shop')

@section('content')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                    <div id="gmap" class="contact-map">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                        <div style='overflow:hidden; height:440px;width:700px;'>
                            <div id='gmap_canvas' style='height:440px;width:700px;'></div>
                            <div>
                                <small><a href="embedgooglemaps.com/ru">https://embedgooglemaps.com/ru/</a></small>
                            </div>
                            <div>
                                <small><a href="https://mrpromokod.ru/">http://mrpromokod.ru/</a></small>
                            </div>
                        </div>
                        <script type='text/javascript'>function init_map() {
                                var myOptions = {
                                    zoom: 10,
                                    center: new google.maps.LatLng(50.4501, 30.523400000000038),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(50.4501, 30.523400000000038)
                                });
                                infowindow = new google.maps.InfoWindow({content: '<strong>Название</strong><br>киев<br>'});
                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);</script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>

                        @include('layouts.errors')
                        @include('layouts.session')

                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post"
                              action="{{ route('contact') }}">
                            @csrf
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required"
                                       placeholder="Name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required"
                                       placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required"
                                       placeholder="Subject" value="{{ old('subject') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="mess" id="message" required="required" class="form-control" rows="8"
                                          placeholder="Your Message Here">{{ old('mess') }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/#contact-page-->
@endsection
