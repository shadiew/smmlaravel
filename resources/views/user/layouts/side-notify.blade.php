<div class="fixed-icon rfixedicon">
    <i class="fa fa-envelope-open"></i>
</div>

<div class="fixedsidebar rfixed">
    <div class="fs-header d-flex align-items-center justify-content-between">
        <h5 class="text-white">@lang("What's new on $basic->site_title")</h5>
        <div class="btn-close close-sidebar">&times;</div>
    </div>
    <div class="fs-wrapper">
        @foreach($notices as $notice)
        <div class="content">
            <div class="featureDate">
                <div class="category categoryNew new">
                    @lang($notice->highlight_text)
                </div>
                <span>{{dateTime($notice->created_at,'d M, Y')}}</span>
            </div>

            <h3 class="featureTitle">
                @lang($notice->title)
            </h3>


            <div class="featureContent">
                <p>
                    @lang($notice->details)

                </p>
            </div>
        </div>
        @endforeach

    </div>
</div>
