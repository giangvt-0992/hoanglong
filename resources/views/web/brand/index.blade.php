@extends('web.layout.master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url('../web_template/Content/themes/startravel/img/pages/page-title-cho-thue-xe.jpg');">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="titleTable">
          <div class="titleTableInner">
            <div class="pageTitleInfo">
              <h1> {{ __('Brand') }}</h1>
              <div class="under-border"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="mainContentSection blacktext singlePackage">
  <div class="container">
    <div class="row margin-bottom-10 margin-top-10">
      <div class="col-sm-12 col-xs-12">
        <div class="darkSection citiesPage">
          <div class="row gridResize">
            <div class="col-sm-3 col-xs-12">
              <div class="sectionTitleDouble">
                @if(app()->getLocale() == 'vi')
                <p style="color: #fff;">Nhà</p>
                <h2><span>Xe</span></h2>
                @else
                <p style="color: #fff;">Select</p>
                <h2><span>Brand</span></h2>
                @endif
              </div>
            </div>
            <div class="col-sm-7 col-xs-12">
            <form method="GET" action="{{route('brand', ['localce' => app()->getLocale()])}}" id="frLoadOfficeByCity" class="form" data-stop="">
                <div class="row">
                  <div class="col-sm-6 col-xs-12">
                    <div class="searchTour">
                      <select class="select2bootstrap select2-hidden-accessible" id="brand" name="id" tabindex="-1" aria-hidden="true">
                        <option value="">{{__('Brand')}}</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}" @if($brand->id == request('id')) selected @endif>{{$brand->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12">
                    <button type="submit" class="btn buttonCustomPrimary">{{__('Search')}}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if($searchBrand)
    @include('web.brand.info', [
      'searchBrand' => $searchBrand
    ]);
    @endif
  </div>
</section>
@endsection