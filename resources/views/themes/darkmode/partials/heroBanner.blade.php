@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
    <section class="home-section">
        <div class="overlay h-100">
        <div class="container h-100">
            <div class="row h-100 align-items-center gy-5 g-lg-4">
                <div class="col-lg-6">
                    <div class="text-box">
                    <h2>@lang($hero->description->title)</h2>
                    <p>@lang($hero->description->short_description)</p>
                    <a href="{{@$hero->templateMedia()->button_link}}" class="btn-smm">
                        @lang($hero->description->button_name)
                    </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img-box">
                    <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="@lang('Hero Img')" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endif
