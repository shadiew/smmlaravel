<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Configure;
use Illuminate\Http\Request;

use App\Http\Traits\Upload;
use Illuminate\Support\Facades\Artisan;
use Image;
use Session;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;

class ControlController extends Controller
{
    use Upload;


    public function index()
    {
        $timeZone = timezone_identifiers_list();
        $control =   Configure::firstOrNew();
        $control->time_zone_all = $timeZone;
        return view('admin.pages.basic-controls', compact('control'));
    }

    public function updateConfigure(Request $request)
    {
        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'site_title' => 'required',
            'time_zone' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'fraction_number' => 'required|integer',
            'paginate' => 'required|integer'
        ]);


        if($request->has('base_color')){
            config(['basic.base_color' =>  $reqData['base_color']]);
        }

        config(['basic.site_title' => $reqData['site_title']]);
        config(['basic.time_zone' => trim($reqData['time_zone'])]);
        config(['basic.currency' => $reqData['currency']]);
        config(['basic.currency_symbol' => $reqData['currency_symbol']]);
        config(['basic.fraction_number' => (int)$reqData['fraction_number']]);
        config(['basic.paginate' => (int)$reqData['paginate']]);
        config(['basic.is_active_cron_notification' => (int)$reqData['cron_set_up_pop_up']]);
        config(['basic.error_log' => (int)$reqData['error_log']]);
        config(['basic.maintenance' => (int)$reqData['maintenance']]);
        config(['basic.maintenance_message' => $reqData['maintenance_message']]);

        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);

        $reqData['is_active_cron_notification'] = (int)$reqData['cron_set_up_pop_up'];
        unset($reqData['cron_set_up_pop_up']);
        $configure->fill($reqData)->save();


        $envPath = base_path('.env');
        $env = file($envPath);
        $env = $this->set('APP_DEBUG', ($configure->error_log == 1) ?'true' : 'false', $env);
        $env = $this->set('APP_TIMEZONE', '"'.$reqData['time_zone'].'"', $env);

        $fp = fopen($envPath, 'w');
        fwrite($fp, implode($env));
        fclose($fp);

        session()->flash('success', ' Updated Successfully');
        Artisan::call('optimize:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return back();
    }


    public function colorSettings()
    {
        $configure = Color::firstOrNew();
        $control = $configure;
        return view('admin.pages.colors', compact('control'));
    }


    public function colorSettingsUpdate(Request $request)
    {

        $configure = Color::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));

        if(config('basic.theme') == 'minimal'){
            $request->validate([
                'primaryColor' => 'required',
                'subheading' => 'required',
                'bggrdleft' => 'required',
                'bggrdright' => 'required',
                'btngrdleft' => 'required',
                'bggrdleft2' => 'required',
                'copyrights' => 'required',
            ], [
                'primaryColor.required' => 'Primary color required',
                'subheading.required' => 'Subheading color required',
                'bggrdleft.required' => 'Background left color required',
                'bggrdright.required' => 'Background right color required',
                'btngrdleft.required' => 'Button gradient left color required',
                'bggrdleft2.required' => 'Background left 2 color required',
                'copyrights.required' => 'Copyrights Background color required',
            ]);


            config(['color.primaryColor' => str_replace('#','',$reqData['primaryColor']) ]);
            config(['color.subheading' => str_replace('#','',$reqData['subheading']) ]);
            config(['color.bggrdleft' => str_replace('#','',$reqData['bggrdleft']) ]);
            config(['color.bggrdright' =>str_replace('#','',$reqData['bggrdright']) ]);
            config(['color.bggrdleft2' => str_replace('#','',$reqData['bggrdleft2']) ]);
            config(['color.btngrdleft' =>str_replace('#','',$reqData['btngrdleft']) ]);
            config(['color.copyrights' =>str_replace('#','',$reqData['copyrights']) ]);


            $fp = fopen(base_path() . '/config/color.php', 'w');
            fwrite($fp, '<?php return ' . var_export(config('color'), true) . ';');
            fclose($fp);

            $configure->fill($reqData)->save();


        }else{

            $request->validate([
                'theme_color' => 'required',
                'theme_light_color' => 'required',
                'secondary_color' => 'required'
            ], [
                'theme_color.required' => 'Theme color required',
                'theme_light_color.required' => 'Theme light color required',
                'secondary_color.required' => 'Secondary color required',
            ]);

            config(['color.theme_color' => $reqData['theme_color'] ]);
            config(['color.theme_light_color' => $reqData['theme_light_color'] ]);
            config(['color.secondary_color' => $reqData['secondary_color'] ]);

            $fp = fopen(base_path() . '/config/color.php', 'w');
            fwrite($fp, '<?php return ' . var_export(config('color'), true) . ';');
            fclose($fp);


            $configure->fill($reqData)->save();
        }


        session()->flash('success', ' Updated Successfully');

        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back();
    }



    private function set($key, $value, $env)
    {
        foreach ($env as $env_key => $env_value) {
            $entry = explode("=", $env_value, 2);
            if ($entry[0] == $key) {
                $env[$env_key] = $key . "=" . $value . "\n";
            } else {
                $env[$env_key] = $env_value;
            }
        }
        return $env;
    }



    public function manageTheme()
    {
        $theme = config('theme');
        return view('admin.pages.manage-theme',compact('theme'));
    }

    public function activateTheme(Request $request, $name)
    {
        config(['basic.theme' => $name]);

        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);

        $configure = Configure::firstOrNew();
        $configure->theme = $name;
        $configure->save();

        session()->flash('success', 'Theme Activated Successfully');
        Artisan::call('optimize:clear');
        return back();
    }


    public function logoSeo()
    {
        $seo = (object)config('seo');
        return view('admin.pages.logo', compact('seo'));
    }


    public function logoUpdate(Request $request)
    {
        if ($request->hasFile('image')) {
            try {
                $old = 'logo.png';
                $this->uploadImage($request->image, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Logo could not be uploaded.');
            }
        }
        if ($request->hasFile('footer_image')) {
            try {
                $old = 'footer-logo.png';
                $this->uploadImage($request->footer_image, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Footer logo could not be uploaded.');
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $old = 'favicon.png';
                $this->uploadImage($request->favicon, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'favicon could not be uploaded.');
            }
        }
        return back()->with('success', 'Logo has been updated.');
    }


    public function breadcrumb()
    {
        return view('admin.pages.banner');
    }


    public function breadcrumbUpdate(Request $request)
    {
        if ($request->hasFile('banner')) {
            try {
                $old = 'banner.jpg';
                $this->uploadImage($request->banner, config('location.logo.path'), null, $old, null, $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Banner could not be uploaded.');
            }
        }
        return back()->with('success', 'Banner has been updated.');
    }


    public function seoUpdate(Request $request)
    {

        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'social_title' => 'required',
            'social_description' => 'required'
        ]);


        config(['seo.meta_keywords' => $reqData['meta_keywords']]);
        config(['seo.meta_description' => $request['meta_description']]);
        config(['seo.social_title' => $reqData['social_title']]);
        config(['seo.social_description' => $reqData['social_description']]);


        if ($request->hasFile('meta_image')) {
            try {
                $old = config('seo.meta_image');
                $meta_image = $this->uploadImage($request->meta_image, config('location.logo.path'), null, $old, null, $old);
                config(['seo.meta_image' => $meta_image]);
            } catch (\Exception $exp) {
                return back()->with('error', 'favicon could not be uploaded.');
            }
        }

        $fp = fopen(base_path() . '/config/seo.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('seo'), true) . ';');
        fclose($fp);

        Artisan::call('optimize:clear');
        return back()->with('success', 'Favicon has been updated.');

    }



    public function pluginConfig()
	{
        $control = Configure::firstOrNew();
        return view('admin.plugin_panel.pluginConfig', compact('control'));
	}

    public function tawkConfig(Request $request)
	{
        $basicControl = basicControl();

		if ($request->isMethod('get')) {
			// $currencies = Currency::select('id', 'code', 'name')->where('is_active', 1)->get();
			return view('admin.plugin_panel.tawkControl', compact('basicControl'));
		} elseif ($request->isMethod('post')) {
			$purifiedData = Purify::clean($request->all());

			$validator = Validator::make($purifiedData, [
				'tawk_id' => 'required|min:3',
				'tawk_status' => 'nullable|integer|min:0|in:0,1',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$purifiedData = (object)$purifiedData;

			$basicControl->tawk_id = $purifiedData->tawk_id;
			$basicControl->tawk_status = $purifiedData->tawk_status;
			$basicControl->save();

			return back()->with('success', 'Successfully Updated');
		}
	}

    public function fbMessengerConfig(Request $request)
	{
		$basicControl = basicControl();

		if ($request->isMethod('get')) {
			return view('admin.plugin_panel.fbMessengerControl', compact('basicControl'));
		} elseif ($request->isMethod('post')) {
			$purifiedData = Purify::clean($request->all());

			$validator = Validator::make($purifiedData, [
				'fb_messenger_status' => 'nullable|integer|min:0|in:0,1',
				'fb_app_id' => 'required|min:3',
				'fb_page_id' => 'required|min:3',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}
			$purifiedData = (object)$purifiedData;

			$basicControl->fb_app_id = $purifiedData->fb_app_id;
			$basicControl->fb_page_id = $purifiedData->fb_page_id;
			$basicControl->fb_messenger_status = $purifiedData->fb_messenger_status;

			$basicControl->save();

			return back()->with('success', 'Successfully Updated');
		}
	}

	public function googleRecaptchaConfig(Request $request)
	{
		$basicControl = basicControl();

		if ($request->isMethod('get')) {
			return view('admin.plugin_panel.googleReCaptchaControl', compact('basicControl'));
		} elseif ($request->isMethod('post')) {
			$purifiedData = Purify::clean($request->all());

			$validator = Validator::make($purifiedData, [
				'reCaptcha_status_login' => 'nullable|integer|min:0|in:0,1',
				'reCaptcha_status_registration' => 'nullable|integer|min:0|in:0,1',
				'NOCAPTCHA_SECRET' => 'required|min:3',
				'NOCAPTCHA_SITEKEY' => 'required|min:3',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}
			$purifiedData = (object)$purifiedData;

			$basicControl->reCaptcha_status_login = $purifiedData->reCaptcha_status_login;
			$basicControl->reCaptcha_status_registration = $purifiedData->reCaptcha_status_registration;
			$basicControl->save();


			$envPath = base_path('.env');
			$env = file($envPath);
			$env = $this->set('NOCAPTCHA_SECRET', $purifiedData->NOCAPTCHA_SECRET, $env);
			$env = $this->set('NOCAPTCHA_SITEKEY', $purifiedData->NOCAPTCHA_SITEKEY, $env);
			$fp = fopen($envPath, 'w');
			fwrite($fp, implode($env));
			fclose($fp);

			Artisan::call('config:clear');
			Artisan::call('cache:clear');

			return back()->with('success', 'Successfully Updated');
		}
	}

	public function googleAnalyticsConfig(Request $request)
	{
		$basicControl = basicControl();

		if ($request->isMethod('get')) {
			return view('admin.plugin_panel.analyticControl', compact('basicControl'));
		} elseif ($request->isMethod('post')) {
			$purifiedData = Purify::clean($request->all());

			$validator = Validator::make($purifiedData, [
				'MEASUREMENT_ID' => 'required|min:3',
				'analytic_status' => 'nullable|integer|min:0|in:0,1',
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}
			$purifiedData = (object)$purifiedData;

			$basicControl->MEASUREMENT_ID = $purifiedData->MEASUREMENT_ID;
			$basicControl->analytic_status = $purifiedData->analytic_status;
			$basicControl->save();

			return back()->with('success', 'Successfully Updated');
		}
	}




}
