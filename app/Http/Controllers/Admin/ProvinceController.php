<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    protected $provinceRepository;

    public function __construct(
        ProvinceRepository $provinceRepository
    ) {
        $this->provinceRepository = $provinceRepository;
    }

    public function places(Request $request)
    {
        // $admin = getAuthAdmin();
        $province = $this->provinceRepository->find($request->provinceId);
        $places = $province->places()->where('places.brand_id', getAuthAdminBrandId())->get();

        return response()->json([
            'status' => 200,
            'data' => $places
        ]);
    }
}
