<?php

namespace App\Http\Middleware;

use App\Models\ScholarshipRun;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'is_admin' => $request->user() != null && $request->user()->role_id == 1,
            ],
            'flash' => function () use ($request) {
                return [
                    'status' => $request->session()->get('status'),
                    'message' => $request->session()->get('message'),
                    'success' => $request->session()->get('success'),
                ];
            },
            'program' => ScholarshipRun::whereIsActive(true)->first() ?? null,
            'breadcrumbs' => $request->segments(),
            'settings' => $this->settings($request),
        ]);
    }

    private function settings(Request $request)
    {
        return [
            'show_quote' => true,
            'quote' => 'Keep Learning..',

            'app_name' => setting('site.title'),
            'app_name_short' => setting('site.name_short'),
            'app_initials' => setting('site.initials'),
            'app_url' => setting('site.base_url'),

            'description' => setting('site.description'),
            'description_short' => setting('site.description_short'),

            'phone' => setting('site.phone_number'),
            'phone_styled' => setting('site.phone_styled'),
            'email' => setting('site.email_address'),
            'address' => setting('site.address'),
            'address_url' => setting('site.address_url'),

            'home_about' => setting('site.home_about'),
            'eligibility_1' => setting('site.scholarship_eligibility_1'),
            'eligibility_2' => setting('site.scholarship_eligibility_2'),
            'requirements' => setting('site.scholarship_requirements'),
            'covidSafetySM' => setting('site.covid_safety_quote_sm'),
            'covidSafetyLG' => setting('site.covid_safety_quote_lg'),
            'showCovidBanners' => setting('site.show_covid_banners'),
            'showBottomBanner' => setting('site.show_bottom_banner'),
            'max_passport_size' => setting('site.max_passport_size'),
            'max_upload_size' => setting('site.max_upload_size'),
            'document_mimes' => [
                "image/png",
                "image/jpeg",
                "image/jpg",
                "application/pdf",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ],
        ];
    }
}
