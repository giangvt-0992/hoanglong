<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;

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

    public function index()
    {
        $this->authorize('province.viewAny');
        $provinces = $this->provinceRepository->all();
        return view('admin.province.index', [
            'provinces' => $provinces
        ]);
    }

    public function create()
    {
        $this->authorize('province.create');
        return view('admin.province.create');
    }

    public function store(ProvinceRequest $request)
    {
        $this->authorize('province.create');

        $checkNameIsUse = $this->provinceRepository->checkNameIsUse($request->name);
        if ($checkNameIsUse) {
            return redirect()->back()->withInput()->with('error', 'Tên tỉnh thành này đã được sử dụng');
        }
        try {
            $data = [
                'name' => $request->name,
                'slug' => str_slug($request->name)
            ];
            $this->provinceRepository->store($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Thêm tỉnh thành thất bại');
        }
        
        return redirect()->route('admin.province.index')->with('success', 'Thêm tỉnh thành thành công');
    }

    public function edit(Province $province) {
        return view('admin.province.update', [
            'province' => $province
        ]);
    }

    public function update(ProvinceRequest $request, Province $province)
    {
        $checkNameIsUse = $this->provinceRepository->checkNameIsUse($request->name);

        if ($checkNameIsUse) {
            return redirect()->back()->withInput()->with('error', 'Tên tỉnh thành này đã được sử dụng');
        }
        try {
            $province->name = $request->name;
            $province->slug = str_slug($request->slug);
            $province->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Cập nhật tỉnh thành thất bại');
        }
        return redirect()->route('admin.province.index')->with('success', 'Cập nhật tỉnh thành thành công');
    }

    public function destroy(Province $province)
    {
        try {
            $countDistrict = $province->districts()->count();
            if ($countDistrict > 0) {
                return redirect()->back()->withInput()->with('error', 'Tình thành đã có dữ liệu về quận huyện. Vui lòng kiểm tra lại!'); 
            }

            $province->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Xóa tỉnh thành thất bại');
        }
        return redirect()->route('admin.province.index')->with('success', 'Xóa tỉnh thành thành công');
    }
}
