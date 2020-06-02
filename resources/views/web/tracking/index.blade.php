@extends('web.layout.master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url('../web_template/Content/themes/startravel/img/pages/page-title-bang-gia.jpg');">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="titleTable">
          <div class="titleTableInner">
            <div class="pageTitleInfo">
              <h1> {{ __('Tracking') }}</h1>
              <div class="under-border"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="mainContentSection packagesSection boxbooking">
  <div class="container">
    <div class="row tabsPart">
      <div class="col-sm-12">
        <div class="positiontop"></div>
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="darkSection citiesPage">
              <div class="row gridResize">
                <div class="col-sm-3 col-xs-12">
                  <div class="sectionTitleDouble">
                    <p>{{ __("Ticket") }}</p>
                    <h2><span>{{ __("Code") }}</span></h2>
                  </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                  <div class="row">
                    <form action="{{route('tracking', ['locale' => app()->getLocale()])}}" method="get" id="form">
                      <div class="col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-md-12">
                            <input type="text" style="
                            width: 100%;
                            height: 45px;
                            font-size: 18px;
                            padding: 5px 20px;
                            margin-top: 3px;
                            background: whitesmoke;
                            border: none;
                            border-radius: 4px;"
                            name="ticket_code"
                            value="{{request('ticket_code')}}"
                            >
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-sm-12 col-xs-12">
                            <button type="submit" class="btn buttonCustomPrimary" style="width: 100%" type="submit" >{{__('Tracking')}}</button>
                          </div>
                          
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
          @if (isset($ticket))
          <div class="panel panel-default pnlconfirminfo packagesFilter col-md-12">
            <div class="panel-heading" style="background: ">
              <h3 class="panel-title">{{__('Ticket information')}}</h3>
            </div>
            
            <div class="panel-body confirminfo row-fluid">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>
                      <span class="bold">{{ __('Ticket code') }}</span>
                    </td>
                    <td>
                      <span class="bold">{{$ticket->code}}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Fullname') }}
                    </td>
                    <td>
                      {{$ticket->passenger_info['name']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Phone') }}
                    </td>
                    <td>
                      {{$ticket->passenger_info['phone']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Email')}}
                    </td>
                    <td>
                      {{$ticket->passenger_info['phone']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Address')}}
                    </td>
                    <td>
                      {{$ticket->passenger_info['address']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Departure')}}
                    </td>
                    <td>
                      {{$ticket->trip_info['dep_province_name'] .' - ( '. $ticket->trip_info['depart_name'] . ' )'}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Destination')}}
                    </td>
                    <td>
                      {{$ticket->trip_info['des_province_name'] .' - ( '. $ticket->trip_info['des_name'] . ' )'}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Route')}}
                    </td>
                    <td>
                      {{$ticket->trip_info['trip_name']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>{{ __('Expected customers will board the car in :place at', ['place' => $ticket['pickup_place']])}}</b>
                    </td>
                    <td>
                      <span class="bold">{{$ticket->trip_info['pickup_time'] . ' - ' . date('d/m/Y', strtotime($ticket->tripDepartDate->depart_date))}}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Quantity') }}
                    </td>
                    <td>
                      <span class="bold">{{$ticket['quantity']}}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Ticket price') }}
                    </td>
                    <td>
                      <span class="bold">{{number_format($ticket['unit_price'])}} VND</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Total price') }}
                    </td>
                    <td>
                      <span class="bold">{{number_format($ticket['quantity']*$ticket['unit_price'])}} VND</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{ __('Payment method')}}
                    </td>
                    <td>
                      {{ __('Direct payment')}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          @else
          @if (request('ticket_code'))
          <p class="text-center" style="text-align: center">{{__('There is no result for the key')}} "{{request("ticket_code")}}"</p>
          @endif
          @endif
      </div>
      
    </div>
  </div>
</div>
</div>
</div>
</section>
@endsection