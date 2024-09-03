<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\Utils;
use App\Models\Respuesta;
use App\Models\Folio;
use App\Models\Cupones;
use App;

class BookingTrip extends Model
{
    use HasFactory;
    protected $table = 'bookings_trip';
    public $timestamps = false;

    public function _MakeDirectTrip($data)
    {
        $resp = new Respuesta;

        try{
            $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('GOOGLE_PRIVATE_KEY'),
                'response' => $data['gRecaptchaResponse']
            ]);
            $body = json_decode($response->getBody());

            if (!$body->success){
                $resp->Error = true;
                $resp->Message = __('MotorBusqueda.recaptcha-requerido');
            }
            else {
                $resp = $this->_SaveBookingTrip($data);

                if(!$resp->Error)
                {
                    $this->_SendBookingTrip($resp->data, 'pendiente');
                }
            }
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _MakeDirectCustomTrip($data)
    {
        $resp = new Respuesta;

        try {
            $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('GOOGLE_PRIVATE_KEY'),
                'response' => $data['gRecaptchaResponse']
            ]);
            $body = json_decode($response->getBody());

            if (!$body->success) {
                $resp->Error = true;
                $resp->Message = __('MotorBusqueda.recaptcha-requerido');
                return $resp;
            }
            else {
                $resp = $this->_SaveBookingCustomTrip($data);

                if(!$resp->Error)
                {
                    $this->_SendBookingCustomTrip($resp->data, 'pendiente');
                }
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _SaveBookingTrip($data){
        $folio = new Folio;
        $booking = new BookingTrip;
        $resp = new Respuesta;
        $cupon = new Cupones;

        try{
            $lang = App::getLocale();
            $folio = $folio->_GetFolio();
            $folioBooking = $folio->folio .''.$folio->count;

            if($data['cupon_clave'] !== '' && $data['cupon_amount'] > 0) {
                $cupon->_addCuponUsed($data['cupon_clave']);
            }

            $booking->folio = $folioBooking;
            $booking->first_name = $data['firstName'];
            $booking->last_name = $data['lastName'];
            $booking->email = $data['email'];
            $booking->phone = $data['phone'];
            $booking->comments = $data['comments'];
            $booking->id_destination = $data['idZone'];
            $booking->type_transfer = $data['typetransfer'];
            $booking->pax = $data['pax'];
            $booking->pay_method = $data['payMethod'];
            $booking->amount = $data['amount'];
            $booking->silla_bebe = $data['sillaBebe'];
            $booking->lang = $lang;
            $booking->cupon_clave = $data['cupon_clave'];
            $booking->cupon_amount = $data['cupon_amount'];

            if($data['typetransfer'] == 1 || $data['typetransfer'] == 3)
            {
                $booking->arrival_date = $data['dateArrival'];
                $booking->arrival_time = $data['hourArrival'];
                $booking->arrival_info = $data['infoArrival'];
            }
            if($data['typetransfer'] == 2 || $data['typetransfer'] == 3)
            {
                $booking->departure_date = $data['dateDeparture'];
                $booking->departure_time = $data['hourDeparture'];
                $booking->departure_info = $data['infoDeparture'];
            }

            if($data['typetransfer'] == 1 || $data['typetransfer'] == 3)
            {
                $booking->destination = $data['destination'];
            }
            else
            {
                $booking->origin = $data['origin'];
            }

            if($data['payMethod'] == 'card')
            {
                $booking->order_id = $data['orderId']; // Campos para paypal
                $booking->status_pay = 1;
                $booking->payer_id = $data['payerId'];  // Campos para paypal
                $booking->payment_id = $data['paymentId'];  // Campos para paypal
                $booking->status_paypal = $data['statusPaypal'];    // Campos para paypal
            }
            else
            {
                $booking->status_pay = 0;
            }

            $booking->save();

            $folio->count = $folio->count + 1;
            $folio->save();

            $resp->Error = false;
            $resp->data = $booking;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _UpdateBookingTripByConektaData($checkoutId, $orderId, $statusPay)
    {
        $resp = new Respuesta;
        try {
            $booking = $this->where('order_id', $orderId)->where('checkout_id', $checkoutId)->first();
            // SIGNIFICADO DEL STATUS DE PAGO: 1 => PAGADO, 2 => PAGO PENDIENTE, -1 => ERROR EN PAGO, 0 => PENDIETE
            switch($statusPay) {
                case 'paid':
                    $booking->status_pay = 1;
                    break;
                case 'pending_payment':
                    $booking->status_pay = 2;
                    break;
                case 'error':
                    $booking->status_pay = -1;
                    break;
            }
            $booking->save();
            $datos = [
                "lang" => $booking->lang,
                "statusPay" => $booking->status_pay,
                "folio" => $booking->folio
            ];


            if($booking->status_pay != -1 && $booking->email_confirm == 0)
            {
                $this->_SendBookingTrip($booking, $statusPay);
                $booking->email_confirm = 1;
                $booking->save();
            }
            $resp->Error = false;
            $resp->data = $datos;

        } catch(Exception $e) {
            $res->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _MakeBookingByPaypal($data) {
        $resp = new Respuesta;

        try {
            $resp = $this->_SaveBookingTrip($data);

            if(!$resp->Error)
            {
                $this->_SendBookingTrip($resp->data, $data['statusPaypal']);
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }


    public function _SendBookingTrip($booking, $statusPay)
    {
        $resp = new Respuesta;
        $destination = new Destination;
        $subject = "";

        try {
            switch($booking->type_transfer)
            {
                case 1:
                    $subject = __('MotorBusqueda.reservacion-aeropuerto-hotel');
                    break;
                case 2:
                    $subject = __('MotorBusqueda.reservacion-hotel-aeropuerto');
                    break;
                case 3:
                    $subject = __('MotorBusqueda.reservacion-redondo-aeropuerto');
                    break;
            }

            $copia = env('MAIL_USERNAME');
            $email = $booking->email;
            $nameZone = $destination->_GetDestinationById($booking->id_destination)->name;

            Mail::send('emails.detailTrip',
                [
                    'item'=>$booking,
                    'folio' => $booking->folio,
                    'typetransfer' => $subject,
                    'nameZone' => $nameZone,
                    'statusPay' => $statusPay
                ], function($mensaje) use ($copia, $email, $subject){
                    $mensaje->to([$copia, $email])->subject($subject);
                }
            );
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _SaveBookingCustomTrip($data)
    {
        $folio = new Folio;
        $booking = new BookingTrip;
        $resp = new Respuesta;

        try {
            $lang = App::getLocale();
            $folio = $folio->_GetFolio();
            $folioBooking = $folio->folio . '' . $folio->count;

            $booking->lang = $lang;
            $booking->folio = $folioBooking;
            $booking->first_name = $data['firstName'];
            $booking->last_name = $data['lastName'];
            $booking->email = $data['email'];
            $booking->phone = $data['phone'];
            $booking->comments = $data['comments'];
            $booking->type_transfer = $data['typetransfer'];
            $booking->origin = $data['origin'];
            $booking->destination = $data['destination'];
            $booking->pax = $data['pax'];
            $booking->departure_date = $data['dateDeparture'];
            $booking->departure_time = $data['hourDeparture'];
            $booking->pay_method = "efectivo";
            $booking->silla_bebe = $data['sillaBebe'];
            $booking->status_pay = 1;
            $booking->save();

            $folio->count = $folio->count + 1;
            $folio->save();

            $resp->Error = false;
            $resp->data = $booking;

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _SendBookingCustomTrip($booking, $statusPay)
    {
        $resp = new Respuesta;

        try {
            $subject = __('MotorBusqueda.subject-custom');
            $copia = env('MAIL_USERNAME');
            $email = $booking->email;

            Mail::send('emails.detailTripCustom',
                [
                    'item'=>$booking,
                    'folio' => $booking->folio,
                    'statusPay' => $statusPay
                ], function($mensaje) use ($email, $copia, $subject){
                $mensaje->to([$copia, $email])->subject($subject);
            });
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _getBookingsTrip($params) {
        $resp = new Respuesta();
        try {
            $query = $this->leftJoin('transfer_catalog as tc', 'bookings_trip.type_transfer', 'tc.id');

            if($params['typeTransfer'] != 0) {
                $query->where('bookings_trip.type_transfer', $params['typeTransfer']);
            }

            if($params['payMethod'] != '0') {
                $query->where('bookings_trip.pay_method', 'like', '%'.$params['payMethod'].'%');
            }

            if(!is_null($params['dataArrivalStart'])) {
                $query->where('bookings_trip.arrival_date', '>=', $params['dataArrivalStart']);
            }

            if(!is_null($params['dataArrivalEnd'])) {
                $query->where('bookings_trip.arrival_date', '<=', $params['dataArrivalEnd']);
            }

            if(!is_null($params['dataDepartureStart'])) {
                $query->where('bookings_trip.departure_date', '>=', $params['dataDepartureStart']);
            }

            if(!is_null($params['dataDepartureEnd'])) {
                $query->where('bookings_trip.departure_date', '<=', $params['dataDepartureEnd']);
            }

            $resp->data = $query->select('bookings_trip.*', 'tc.name_es as name_type_transfer')->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _ResendBookingTrip($data) {
        $resp = new Respuesta;

        try {
            $bookingTrip = $this->find($data['idReservation']);
            $bookingTrip->email = $data['email'];

            if($bookingTrip->type_transfer == 4) {
                $resp = $this->_SendBookingCustomTrip($bookingTrip, $bookingTrip->status_pay);
            }
            else {
                $resp = $this->_SendBookingTrip($bookingTrip, $bookingTrip->status_pay);
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _getBookingTripByFolio($folio) {
        $resp = new Respuesta;
        $booking = new BookingTrip;
        $destination = new Destination;
        try {
            $booking= BookingTrip::where('folio', $folio)->first();

            if ($booking->type_transfer !== 4) {
                $nameZone = $destination->_GetDestinationById($booking->id_destination);
            }

            $subject = "";
            switch($booking->type_transfer)
            {
                case 1:
                    $subject = __('MotorBusqueda.reservacion-aeropuerto-hotel');
                    break;
                case 2:
                    $subject = __('MotorBusqueda.reservacion-hotel-aeropuerto');
                    break;
                case 3:
                    $subject = __('MotorBusqueda.reservacion-redondo-aeropuerto');
                    break;
                    case 4:
                        $subject = __('Email.titulo-especial');
                        break;
            }

            $resp->data = [
                'item'=> $booking,
                'folio' => $booking->folio,
                'typetransfer' => $subject,
                'nameZone' => $nameZone->name ?? '',
                'statusPay' => 'pendiente',
                'type' => $booking->type_transfer,
                'specialtransfer' => __('Email.titulo-especial'),
                'nombre' => __('Email.nombre'),
                'telefono' => __('Email.telefono'),
                'salida' => __('Email.salida'),
                'hora' => __('Email.hora'),
                'hotelorigen' => __('MotorBusqueda.origen'),
                'hoteldestino' => __('MotorBusqueda.destino'),
                'pasajeros' => __('MotorBusqueda.pasajeros'),
                'sillabebe' => __('MotorBusqueda.silla-bebe'),
                'si' => __('MotorBusqueda.si'),
                'statuspay' => __('Email.status-pay'),
                'pendiente' => __('Email.pendiente'),
                'comentarios' => __('MotorBusqueda.comentarios'),
                'arrival' => __('Email.llegada'),
                'infovuelo' => __('Email.info-vuelo'),
                'zona' => __('Email.zona'),
                'a' => __('Email.a'),
                'de' => __('Email.de'),
                'pax' => __('Email.pax'),
                'metododepago' => __('Email.metodo-pago'),
                'efectivo' => __('Email.efectivo'),
                'terminal' => __('Email.terminal'),
                'transfer' => __('Email.transfer'),
                'tarjeta' => __('Email.tarjeta'),
                'amount' => __('Email.monto'),
                'cupon' => __('Email.cupon'),
                'text-extra-0' => __('Email.pdf-text-extra'),
                'text-extra-1' => __('Email.pdf-text-extra-1'),
                'text-extra-2' => __('Email.pdf-text-extra-2'),
                'text-extra-3' => __('Email.pdf-text-extra-3'),
                'text-extra-4' => __('Email.pdf-text-extra-4'),
                'text-extra-5' => __('Email.pdf-text-extra-5'),
                'text-extra-6' => __('Email.pdf-text-extra-6'),
                'text-extra-7' => __('Email.pdf-text-extra-7'),
                'text-extra-8' => __('Email.pdf-text-extra-8'),
                'text-extra-9' => __('Email.pdf-text-extra-9'),
                'text-extra-10' => __('Email.pdf-text-extra-10'),
                'text-extra-11' => __('Email.pdf-text-extra-11'),
                'text-extra-12' => __('Email.pdf-text-extra-12'),
                'text-extra-13' => __('Email.pdf-text-extra-13')
            ];
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
