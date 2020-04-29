@extends('admin.layout.app')
@section('content')
<div class="right_col" trip="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<p>Home / Chuyến / Thêm chuyến</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Thêm chuyến</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.trip.store')}}">
                @csrf
                <div class="form-group">
                  <label>Tuyến</label>
                <select
                class="form-control select2"
                name="routeId"
                id="slRouteId"
                data-get-passing-places="{{route('admin.route.passingPlaces')}}"
                >
                <option value=""></option>
                  @foreach ($routes as $route)
                      <option 
                      value="{{$route->id}}"
                      data-duration-hours={{$route->duration->hours}}
                      data-duration-minutes={{$route->duration->minutes}}
                      >{{$route->name}} - Thời gian {{$route->duration->hours}}h{{$route->duration->minutes}}'</option>
                  @endforeach
                </select>
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Tên chuyến</label>
                <input type="text" class="form-control" placeholder="Tên chuyến" name="name" value="{{old('name')}}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group col-md-6 pl-0">
                  <label>Giờ đi</label>
                  <input type="text" class="form-control timepicker" name="departTime" id="departTime" placeholder="Giờ đi" readonly>
                </div>
                <div class="form-group col-md-6 pr-0">
                  <label>Giờ đến</label>
                  <input type="text" class="form-control timepicker" name="desTime" id="desTime" placeholder="Giờ đến" readonly>
                </div>
                <div class="clear"></div>
                <div id="scheduleWrapper">
                  <label>Lịch đón khách dự kiến</label>
                  <div class="form-group schedule">
                    <div class="col-md-4 pl-0">
                      <input type="text" class="form-control timepicker" name="departTime[]" id="departTime1" placeholder="Thời gian" readonly>
                    </div>
                    <div class="col-md-7 pr-0">
                      <select class="form-control select2 list-place" name="placeId[]" id="slGetOffPlaceId1">
                      </select>
                    </div>
                    <div class="col-md-1">
                      <button class="btn btn-success" id="btnAddSchedule"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Loại xe</label>
                  <select class="form-control" name="carTypeId" id="">
                    @foreach ($carTypes as $carType)
                        <option value="{{$carType->id}}">{{$carType->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="clear"></div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.user.index', ['tab' => 'trip'])}}" >Hủy</button>
                  </div>
                </div>
              </form>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('after-scripts')
<script>
  $("#departTime1").timepicker();

  $('#departTime').timepicker({
    format: 'HH:MM',
  });

  $('#desTime').timepicker({
    format: 'HH:MM'
  });

  $('.timepicker').click(function () {
    $(this).next('i').click();
  });

  

  $("#slRouteId").select2();
  $("#slGetOffPlaceId").select2();

  $("#btnAddSchedule").click(function (e) {
    e.preventDefault();
    const count = $('.schedule').length + 1;
    let template = `
    <div class="form-group schedule">
      <div class="col-md-4 pl-0">
        <input type="text" class="form-control timepicker" name="departTime[]" id="departTime${count}" placeholder="Thời gian" readonly>
      </div>
      <div class="col-md-7 pr-0">
        <select class="form-control select2 list-place" name="placeId[]" onChange="checkSchedule(this)" id="slGetOffPlaceId${count}">
        </select>
      </div>
      <div class="col-md-1">
        <button class="btn btn-danger" onClick="removeSchedule(this)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
    `;
    $("#scheduleWrapper").append(template);

    var $options = $("#slGetOffPlaceId1 > option").clone();
    $(`#slGetOffPlaceId${count}`).append($options);
    $(`#departTime${count}`).timepicker({
      format: 'HH:MM'
    });
    $(`#departTime${count}`).bind("click", function () {
      $(this).next('i.clock').click();
    });
  });

  function removeSchedule(e) {
    const divParent = e.parentNode;
    $(divParent.parentNode).remove();
    return false;
  }

  function calcuteArriveTime() {
    if ($("#slRouteId").val() && $("#departTime").val()){
      const durationHours = parseInt($("#slRouteId option:selected").attr("data-duration-hours"));
      const durationMinutes = parseInt($("#slRouteId option:selected").attr("data-duration-minutes"));

      const time = $('#departTime').val().split(':');
      const currentHours = parseInt(time[0]);
      const currentMinutes = parseInt(time[1]);

      const arriveHours = (durationHours % 24 + currentHours + Math.floor((durationMinutes+currentMinutes)/60)) % 24;
      const arriveMinutes = (durationMinutes+currentMinutes)%60;

      $('#desTime').val(`0${arriveHours}`.slice(-2) + ':' + `0${arriveMinutes}`.slice(-2));
    }
  }

  function removeAllSchedule() {
    $('div.schedule').each(function ( index ) {
      if (index != 0) {
        $(this).remove();
      }
    })
  }
  $("#slRouteId").change(function () {
    calcuteArriveTime();
    removeAllSchedule();
    $.ajax({
      type: "POST",
      url: $(this).attr('data-get-passing-places'),
      data: {
        routeId: $(this).val()
      },
      success: function(response) {
        console.log(response);
        
        if (response.status === 200) {
          $("#slGetOffPlaceId1").empty();
          $("#slGetOffPlaceId1").append(`<option value=""></option>`);
          for (const iterator of response.data) {
            $("#slGetOffPlaceId1").append(`<option value="${iterator.id}">${iterator.name}</option>`);
          }
          
        }
      },
      error: function (error) {
      }
    });
  });

  $("#departTime").change(function () {
    calcuteArriveTime();
  });

  $(".list-place").change(function () {
    checkSchedule(this);
  });

  function checkSchedule(event) {
    const listPlaceId = $('.list-place').map(function () {
      return this.value;
    }).get();

    const currentValue = $(event).val();
    console.log(currentValue);
    

    const x = listPlaceId.filter((item, index) => {
      if (item == currentValue) return item;
    });
    // const currentValue = $(this).val();
    if (x.length > 1) {
      new PNotify({
                title: "Điểm đón khách không hợp lệ",
                text: `Các điểm đón khách không được trùng nhau`,
                type: "warning",
                styling: "bootstrap3"
            });
    }
  }
 
</script>
@endsection
