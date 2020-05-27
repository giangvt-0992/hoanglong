<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\DistrictRepository;
use App\Contracts\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Models\District;

class DistrictController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;

    public function __construct(
        DistrictRepository $districtRepository,
        ProvinceRepository $provinceRepository
    ) {
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {
        $this->authorize('district.viewAny');

        $districts = $this->districtRepository->allWithProvince();
        $provinces = $this->provinceRepository->all();
        
        return view('admin.district.index', [
            'districts' => $districts,
            'provinces' => $provinces,
            ]);
        }
        
    public function create()
    {
        $this->authorize('district.create');
            
        $provinces = $this->provinceRepository->all();
        return view('admin.district.create', [
            'provinces' => $provinces
        ]);
    }

    public function store(DistrictRequest $request)
    {
        $this->authorize('district.create');
        // try {
            $province = $this->provinceRepository->find($request->province_id);
            $checkNameIsUse = $this->districtRepository->checkNameIsUse($province, $request->name);
            if ($checkNameIsUse) {
                return redirect()->back()->withInput()->with('error', 'Tên tỉnh thành này đã được sử dụng');
            }
            $data = $request->all(['province_id', 'name']);
            $data['slug'] = $this->districtRepository->createSlug($province->slug, $data['name']);
            $this->districtRepository->store($data);
        // } catch (\Throwable $throw) {
            // return redirect()->back()->withInput()->with('error', 'Thêm quận huyện thất bại');
        // }
        return redirect()->route('admin.district.index')->with('success', 'Thêm quận huyện thành thành công');
    }

    public function edit(District $district)
    {
        $this->authorize('district.update', $district);

        $provinces = $this->provinceRepository->all();
        return view('admin.district.edit', [
            'district' => $district,
            'provinces' => $provinces
        ]);
    }

    public function update(DistrictRequest $request, District $district)
    {
        $this->authorize('district.update', $district);

        try {
            $province = $this->provinceRepository->find($request->province_id);
            $checkNameIsUse = $this->districtRepository->checkNameIsUse($province, $request->name, $district->id);
            if ($checkNameIsUse) {
                return redirect()->back()->withInput()->with('warning', 'Tên tỉnh thành này đã được sử dụng');
            }
        } catch (\Throwable $th) {
            return redirect()->route('admin.district.index')->with('error', 'Cập nhật quận huyện thất bại'); 
        }
        return redirect()->route('admin.district.index')->with('success', 'Cập nhật quận huyện thành công'); 
    }

    public function destroy(District $district)
    {
        $this->authorize('district.delete', $district);
        try {
            $count = $district->places()->count();
            if ($count > 0) {
                return redirect()->route('admin.district.index')->with('warning', 'Xóa quận huyện thất bại! Quận huyện này đã có dữ liệu về các điểm đến - điểm đi');
            }
            $district->delete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.district.index')->with('error', 'Xóa quận huyện thất bại');
        }
        return redirect()->route('admin.district.index')->with('success', 'Xóa quận huyện thành công'); 
    }

    public function search(Request $request)
    {
        $this->authorize('district.viewAny');

        $data = $request->all();
        $districts = $this->districtRepository->search($data);
        $provinces = $this->provinceRepository->all();
        
        return view('admin.district.index', [
            'districts' => $districts,
            'provinces' => $provinces,
            ]);
        
    }
}
