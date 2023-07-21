<!-- Hero_area_start -->
@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
    <div class="hero_area">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="hero_text_area">
                        <div class="section_header">
                            <h1>@lang(@$hero->description->title)</h1>
                            <p>@lang(@$hero->description->short_description)</p>
                            <a href="{{@$hero->templateMedia()->button_link}}" class="custom_btn2 mt-30 top-right-radius-0">@lang($hero->description->button_name)</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-md-block d-none">
                    <div class="hero_image_area animation1">
                        <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="@lang('Hero Img')" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,224L40,218.7C80,213,160,203,240,213.3C320,224,400,256,480,256C560,256,640,224,720,208C800,192,880,192,960,208C1040,224,1120,256,1200,272C1280,288,1360,288,1400,288L1440,288L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>

    </div>
@endif
<!-- Hero_area_end -->
