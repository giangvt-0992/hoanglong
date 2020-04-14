<div class="darkSection">
    <div class="container">
        <div class="row gridResize">
            <form action="{{route('booking', ['locale' => app()->getLocale()])}}" method="get" id="form">
                {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                <div class="col-sm-3 col-xs-12">
                    <div class="sectionTitleDouble">
                        <p>Choose</p>
                        <h2>your <br/><span>destination</span></h2>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="departure" name="departure_id">
                                    <option value="">{{__('Departure')}}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="destination" name="destination_id"><option value="">{{ __('Destination') }}</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="input-group date ed-datepicker">
                                <input type="text" name="depart_date" id="datebook" data-culture="vi" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" readonly="readonly" value="{{$nextdate}}">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select name="quantity" class="select2bootstrap" id="quantity">
                                    <option value="0">{{__('Quantity')}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <input type="submit" class="btn btn-block buttonCustomPrimary btnSearchShift" value="{{__('Search route')}}" data-blank="1"/>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>