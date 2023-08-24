<?php
use App\Models\Utils;

$total = Utils::asDollars($item['amount']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marc Shuttle</title>
    <script src="https://use.fontawesome.com/97a88bff0a.js"></script>
    <style>
        table.roundedCorners { 
        border-radius: 13px; 
        border-spacing: 0;
        }
        table.roundedCorners td, 
        table.roundedCorners th {
        padding: 10px; 
        }
        table.roundedCorners tr:last-child > td {
        border-bottom: none;
        }
        span, strong, h1, div{
            font-family: sans-serif;
        }
        .bg-principal{
            
            height:450px;
            border:0;
            align:center;
            background-image:url({{env('APP_URL')}}/img/banners/traslados-cancun.webp);
            background-repeat:no-repeat;
            background-size:cover;
        }
        .img-logo{
            margin: 100px auto;
        }
        .text-white{
            color:white;
        }
        .text-blue{
            color:#1346A8;
        }
        .text-orange{
            color:#FE7A30;
        }
        .text-gray{
            color:#788399;
        }
        .strong{
            font-weight:bold;
        }
        .card{
            border-radius:5px;
            background-color: white;
            width: 70%;
            margin: 0 auto 0;
            padding: 15px 10px;            
        }
        .card-gray{
            width:45%;
            background-color:#F5F7F9;
            border-radius:5px;
            /* margin: 7px; */
            padding: 5px 11px;
        }
        .card-blue{
            width:45%;
            background-color:#1346A8;
            border-radius:5px;
            /* margin: 7px; */
            padding: 5px 11px;
        }
        .flex{
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
        }        
        .content-cards{
            display:flex; 
            justify-content:center;
            margin-top:-13%;
        }        
</style>
</head>
<body>
    <div class="bg-principal" style="margin-bottom:-200px">
        <div style="background-color:rgba(0,0,0,0.4);height:450px;">
            <div style="display:flex;">
                <img class="img-logo" src="{{env('APP_URL')}}/img/logos/Logo-Marcshuttle.webp" width="200px"/>
            </div>
        </div>
    </div>
    <div class="content-cards">
        <div class="card">
            <div><h1 style="text-align:center;">{{$typetransfer}}</h1></div>
            <div class="flex">
                <div class="card-gray">
                    <ul style="list-style:none;padding:0;">
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.nombre')}}</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['first_name']. ' '. $item['last_name']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Email:</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['email']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.telefono')}}:</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['phone']}}</div>
                        </li>
                        <br>
                        @if($item['type_transfer'] == 1 || $item['type_transfer'] == 3)
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.llegada')}}:</strong> 
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['arrival_date']}}</div>
                            </li>
                            <br >
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.hora')}}:</strong> 
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['arrival_time']}}</div>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.info-vuelo')}}:</strong>
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['arrival_info']}}</div>
                            </li>
                            <br>
                        @endif
                        @if($item['type_transfer'] == 2 || $item['type_transfer'] == 3)
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.salida')}}:</strong> 
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['departure_date']}}</div>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.hora')}}:</strong> 
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['departure_time']}}</div>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.info-vuelo')}}:</strong>
                                <br>
                                <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['departure_info']}}</div>
                            </li>
                        @endif                        
                    </ul>
                </div>
                <div class="card-blue">
                    <ul style="list-style:none;padding:0;">
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Folio:</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$folio}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.zona')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$nameZone}}</div>
                        </li>
                        @if ($item['type_transfer'] == 1 || $item['type_transfer'] == 3)
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.a')}}</strong>
                                <br>
                                <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['destination']}}</div>
                            </li>
                        @else
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.de')}}</strong>
                                <br>
                                <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['origin']}}</div>
                            </li>
                        @endif
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.pasajeros')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['pax']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('MotorBusqueda.silla-bebe')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['sillaBebe'] == 1 ? __('MotorBusqueda.si') : "No"}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.metodo-pago')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['pay_method'] == 'efectivo' ? __('Email.efectivo') : __('Email.tarjeta')}}</div>
                        </li>
                        <br>
                        @if($item['pay_method'] == 'card')
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Order Id</strong>
                                <br>
                                <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['order_id']}}</div>
                            </li>
                            <br>
                        @endif
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i>{{__('Email.status-pay')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$statusPay == 'pendiente' ? __('Email.pendiente') : $statusPay}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.monto')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$total}}</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="width:80%; margin: 10px auto;">
                <div class="text-blue strong" style="font-size:1.3em;">{{__('Email.comentarios')}}</div>
                <div class="text-gray strong" style="text-align: justify;">{{$item['comments']}}</div>
            </div>
        </div>    
    </div>
</body>
</html>