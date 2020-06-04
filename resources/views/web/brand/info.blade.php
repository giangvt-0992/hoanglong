<div role="tabpanel" class="countryTabs">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#schedules" aria-controls="" role="tab" data-toggle="tab" aria-expanded="false">{{__('Information')}}</a></li>
    <li role="presentation" class=""><a href="#coachestype" aria-controls="" role="tab" data-toggle="tab" aria-expanded="true">{{__('Image')}}</a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="schedules">
      <div id="lich-trinh">
        <p><b>{{__('Description')}}</b></p>
        <p>
          {{$searchBrand->description ?? __('There is no description')}}
        </p>
        <br />
        <p><b>{{__('Phone number')}} <i class="fa fa-phone"></i>: {{$searchBrand->phoneString}}</b></p>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="coachestype">
      <div class="row">
        <div class="col-sm-12 col-xs-12" id="xegiuongnam" style="display: block;">
          <div class="row galleryCarousel">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div id="xekinhlonggiuong" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    @foreach($searchBrand->images as $image)
                  <li data-target="#xekinhlonggiuong" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif"><img src="{{url($image->url)}}" width="110" height="60"></li>
                    @endforeach
                  </ol>
                  <div class="carousel-inner">
                    @foreach($searchBrand->images as $image)
                    <div class="item @if($loop->first) active @endif">
                      <img alt="First slide" src="{{url($image->url)}}" width="1174" height="580">
                    </div>
                    @endforeach
                  </div>
                  <a class="left carousel-control" href="#xekinhlonggiuong" data-slide="prev"><span class="glyphicon glyphicon-menu-left"></span></a>
                  <a class="right carousel-control" href="#xekinhlonggiuong" data-slide="next"><span class="glyphicon glyphicon-menu-right"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div><!--end xegiuongnam-->
      </div>
    </div>
  </div>
</div>