<?php
namespace App\Services;

use App\Enums\TicketStatus;
use App\Jobs\CancelTripJob;
use App\Mail\CancelTripMail;
use App\Models\Ticket;
use App\Models\TripDepartDate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CancelTripService
{
  public static function cancelTrip($listTripDepartDateId = []) {
    // get tripDepartDate doesn't run and has ticket
      $tdds = TripDepartDate::whereIn('id', $listTripDepartDateId)
      ->has('tickets')
      ->whereHas('tickets', function (Builder $query) {
        $query->where('status', '!=', TicketStatus::getValue('Cancel'));
      })
      ->whereDate('depart_date', '>', date('Y-m-d'))
      ->with([
        'trip:id,name',
        'tickets' => function($q) {
          $q->select(['id', 'trip_depart_date_id', 'passenger_info->email as email', 'code', 'passenger_info->locale as locale']);
          $q->where('status', '!=', TicketStatus::getValue('Cancel'));
          return $q;
        }
        ])->get();
        
        foreach ($tdds as $tdd) {
          foreach ($tdd->tickets as $ticket) {
            $data = [
              'to' => $ticket->email,
              'trip' => $tdd->trip->name,
              'locale' => $ticket->locale,
              'code' => $ticket->code,
            ];
            CancelTripJob::dispatch($data);
          }        
        }
        
        $listTDDId = $tdds->pluck("id")->toArray();
        
        DB::transaction(function () use ($listTDDId) {
          self::rollbackTicket($listTDDId);
          self::rollbackTripDepartDateData($listTDDId);
        });
    }
    
    public static function rollbackTicket($listTripDepartDateId)
    {
      return Ticket::whereIn('trip_depart_date_id', $listTripDepartDateId)->update(['status' => TicketStatus::getValue('Cancel')]);
    }
    
    public static function rollbackTripDepartDateData($listTripDepartDateId)
    {
      return DB::table('trip_depart_dates as tdd')
      ->select('tdd.*')
      ->join('trips as t', 'tdd.trip_id', 't.id')
      ->join('car_types as c', 't.car_type_id', 'c.id')
      ->whereIn('tdd.id', $listTripDepartDateId)
      ->update([
        'tdd.seat_map' => DB::raw('c.seat_map'),
        'tdd.available_seats' => DB::raw('c.total_seats'),
        ]);
      }
    }