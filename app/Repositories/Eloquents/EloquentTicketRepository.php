<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\TicketRepository;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class EloquentTicketRepository extends EloquentBaseRepository implements TicketRepository
{
    protected $model;

    public function __construct(
        Ticket $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('images')->orderBy('index', 'ASC')->get();
    }
    
    public function paginate($items = null)
    {
        return $this->model->orderBy('index', 'ASC')->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function createTicket($data)
    {
        $passengerInfo = [
            'passengerName' => $data['passengerName'],
            'passengerPhone' => $data['passengerPhone'],
            'passengerEmail' => $data['passengerEmail'],
            'passengerAddress' => $data['passengerAddress'],
        ];
        
        $code = $this->generateRandomCode(11);
        $ticket = [
            'trip_depart_date_id' => $data['tddId'],
            'quantity' => $data['quantity'],
            'unit_price' => $data['price'],
            'total' => $data['price'] * $data['quantity'],
            'brand_id' => $data['brandId'],
            'user_id' => $data['userId'],
            'passenger_info' => json_encode($passengerInfo),
            'list_seat' => json_encode([]),
            'code' => $code
        ];

        return $this->model->create($ticket);
    }

    public function generateRandomCode($length)
    {
        $code = '';
        do {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, $charactersLength - 1)];
            }

            $count = $this->model->where('code', $code)->count();
        } while ($count >  0);
        return $code;
    }
}
