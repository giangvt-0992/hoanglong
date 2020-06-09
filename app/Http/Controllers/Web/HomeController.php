<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }

    public function changeLanguage(Request $request, $language)
    {
        app()->setLocale($language);

        $previousRouteName = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        return redirect()->route($previousRouteName, ['locale' => app()->getLocale()]);
    }

    public function getTicketGuidePage()
    {
        return view('web.ticket_guide.index');
    }
}
