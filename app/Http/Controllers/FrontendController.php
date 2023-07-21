<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Content;
use App\Models\ContentDetails;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\Order;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->theme = template();
    }

    public function index()
    {
        $templateSection = ['hero', 'about-us', 'how-it-work', 'service', 'counter', 'call-to-action', 'testimonial', 'blog', 'gateway'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['about-us', 'feature', 'how-it-work', 'service', 'counter', 'testimonial', 'blog'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by')->get();
        return view($this->theme . 'home', $data);
    }


    public function blog()
    {
        $data['title'] = "Blog";
        $contentSection = ['blog'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        return view($this->theme . 'blog', $data);
    }


    public function blogDetails($slug = null, $id)
    {
        $getData = Content::findOrFail($id);

        $contentSection = [$getData->name];
        $contentDetail = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');


        $singleItem['title'] = @$contentDetail[$getData->name][0]->description->title;
        $singleItem['description'] = @$contentDetail[$getData->name][0]->description->description;
        $singleItem['d'] = dateTime(@$contentDetail[$getData->name][0]->created_at, 'd');
        $singleItem['M'] = dateTime(@$contentDetail[$getData->name][0]->created_at, 'M');
        $singleItem['date'] = dateTime(@$contentDetail[$getData->name][0]->created_at, 'd M Y');
        $singleItem['image'] = getFile(config('location.content.path') . @$contentDetail[$getData->name][0]->content->contentMedia->description->image);

        $contentSectionPopular = ['blog'];
        $popularContentDetails = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', '!=', $getData->id)
            ->whereHas('content', function ($query) use ($contentSectionPopular) {
                return $query->whereIn('name', $contentSectionPopular);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');
        return view($this->theme . 'blogDetails', compact('singleItem', 'popularContentDetails'));
    }


    public function apiDocs()
    {
        $title = 'API Docs';

        if (Auth::check()) {
            return redirect()->route('user.api.docs');
        }
        return view($this->theme . 'api-docs', compact('title'));
    }


    public function services()
    {
        $categories = Category::with(['service' => function ($query) {
            return $query->where('service_status', 1)->userRate();
        }])->where('status', 1)->get();

        return view($this->theme . 'services.show-service', compact('categories'));
    }


    public function serviceSearch(Request $request)
    {
        $categories = Category::with('service')->get();
        $search = $request->all();
        $services = Service::where('service_status', 1)->userRate()
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->where('service_title', 'LIKE', "%{$search['service']}%");
            })
            ->when(isset($search['category']), function ($query) use ($search) {
                return $query->where('category_id', $search['category']);
            })
            ->with(['category', 'provider'])
            ->get()
            ->groupBy('category.category_title');

        return view($this->theme . 'services.search-service', compact('services', 'categories'));
    }


    public function about()
    {
        $templateSection = ['about-us', 'service', 'testimonial', 'counter', 'gateway'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['about-us', 'feature', 'counter', 'testimonial'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by')->get();
        return view($this->theme . 'about', $data);

    }


    public function faq()
    {
        $templateSection = ['faq'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['faq'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['increment'] = 1;
        return view($this->theme . 'faq', $data);
    }


    public function contact()
    {
        $templateSection = ['contact-us'];
        $templates = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        $title = 'Contact Us';
        $contact = @$templates['contact-us'][0]->description;
        return view($this->theme . 'contact', compact('title', 'contact'));
    }


    public function contactSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:91',
            'subject' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);
        $requestData = Purify::clean($request->except('_token', '_method'));

        $basic = (object)config('basic');
        $basicEmail = $basic->sender_email;

        $name = $requestData['name'];
        $email_from = $requestData['email'];
        $subject = $requestData['subject'];
        $message = $requestData['message'] . "<br>Regards<br>" . $name;
        $from = $email_from;

        $headers = "From: <$from> \r\n";
        $headers .= "Reply-To: <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $to = $basicEmail;

        if (@mail($to, $subject, $message, $headers)) {
            // echo 'Your message has been sent.';
        } else {
            //echo 'There was a problem sending the email.';
        }

        return back()->with('success', 'Mail has been sent');
    }


    public function getLink($getLink = null, $id)
    {
        $getData = Content::findOrFail($id);

        $contentSection = [$getData->name];
        $contentDetail = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');


        $title = @$contentDetail[$getData->name][0]->description->title;
        $description = @$contentDetail[$getData->name][0]->description->description;
        return view($this->theme . 'getLink', compact('contentDetail', 'title', 'description'));
    }


    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:subscribers'
        ]);

        $data = new Subscriber();
        $data->email = $request->email;
        $data->save();
        return redirect(url()->previous() . '#subscribe')->with('success', 'Subscribe successfully');
    }


    public function language($code)
    {
        $language = Language::where('short_name', $code)->first();
        if (!$language) $code = 'en';
        session()->put('trans', $code);
        session()->put('rtl', $language ? $language->rtl : 0);
        return redirect()->back();
    }
}
