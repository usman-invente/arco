<!-- CTA -->
<div class="section cta">
    <div class="content-wrap-20">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="cta-1">
                        <div class="body-text">
                            <h3>{{__('footer.tag_line')}}</h3>
                        </div>
                        <div class="body-action">
{{--                            <a href="#" class="btn btn-secondary">DONATE NOW</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer" data-background="{{ asset('public/images/'.$footer->footer_image) }}"  @if(LaravelLocalization::getCurrentLocale() === 'ar') style="text-align: right;" @endif>
    <div class="content-wrap">
        <div class="container">

            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="footer-item">
                        <?php 
                         $logo = DB::table('logos')->select('logo')->where('position','footer')->first();
                        ?>
                        <img src="{{ asset('public/upload/web-logo/'.$logo->logo) }}" alt="logo bottom" class="logo-bottom">
                        <div class="spacer-30"></div>
                         <p>{!!  $footer->description !!}</p>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="footer-item">
                        <div class="footer-title">
                            {{__('footer.title1')}}
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <ul class="list">
                                    @if(!empty($static_pages))
                                        @foreach($static_pages as $page)
                                            <li><a href="{{ URL('page/'.$page->id) }}" title="Couses">@if(LaravelLocalization::getCurrentLocale() === 'ar') {{ $page->title_ar }} @else {{ $page->title_en }} @endif</a></li>
                                        @endforeach
                                   @endif
                                </ul>
                            </div>
{{--                            <div class="col-sm-6 col-md-6">--}}
{{--                                <ul class="list">--}}
{{--                                    <li><a href="our-team.html" title="Our Team">Our Team</a></li>--}}
{{--                                    <li><a href="events.html" title="Events">Events</a></li>--}}
{{--                                    <li><a href="contact.html" title="Contact Us">Contact Us</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="footer-item">
                        <div class="footer-title">
                            {{__('footer.title2')}}
                        </div>
                        <ul class="list-info">
                            <li>
                                <div class="info-icon">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="info-text">{{ $contact_us->main_address }}</div> </li>
                            <li>
                                <div class="info-icon">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="info-text">{{ $contact_us->main_phone }}</div>
                            </li>
                            <li>
                                <div class="info-icon">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <div class="info-text">{{ $contact_us->email }}</div>
                            </li>
                            <li>
                                <div class="info-icon">
                                    <span class="fa fa-clock-o"></span>
                                </div>
                                <div class="info-text">{{ $contact_us->time }}</div>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="footer-item">
                        <div class="footer-title">
                            {{__('footer.title3')}}
                        </div>
                        <p>{{__('footer.social_description')}}</p>
                        <div class="sosmed-icon primary">
                            <a href="{{ $footer->facebook }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $footer->twitter }}"><i class="fa fa-twitter"></i></a>
                            <a href="{{ $footer->instagram }}"><i class="fa fa-instagram"></i></a>
                            <a href="{{ $footer->youtube }}"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fcopy">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <p class="ftex">Copyright 2020 &copy; <span class="color-primary">ARCO (ARAB RED CRESENT AND RED CROSS)</span>. </p>
                </div>
            </div>
        </div>
    </div>

</div>
