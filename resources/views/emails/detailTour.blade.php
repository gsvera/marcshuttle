<?php
use App\Models\Utils;

$lang = App::getLocale();
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
            background-image:url({{$item['host']}}/img/banners/traslados-cancun.webp);
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
            padding: 5px 11px;
        }
        .card-blue{
            width:45%;
            background-color:#1346A8;
            border-radius:5px;
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
                <img class="img-logo" src="{{$item['host']}}/img/logos/Logo-Marcshuttle.webp" width="200px"/>
            </div>
        </div>
    </div>
    <div class="content-cards">
        <div class="card">
            <div><h1 style="text-align:center;">{{__('tours.tour-reservado')}}</h1></div>
            <div class="flex">
                <div class="card-gray">
                    <ul style="list-style:none;padding:0;">
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.nombre')}}</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['firstName']. ' '.$item['lastName']}}</div>
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
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.salida')}}:</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['dateDeparture']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.hora')}}:</strong> 
                            <br>
                            <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['hourDeparture']}}</div>
                        </li>
                        <br>                        
                    </ul>
                </div>
                <div class="card-blue">
                    <ul style="list-style:none;padding:0;">
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Folio</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$folio}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Tour</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$tour['name']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Tours.descripcion')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$tour['descripcion_'.$lang]}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Tours.vehiculo')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$vehicle['name']}}</div>
                        </li>
                        <br>
                        <li>
                            <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.pasajeros')}}</strong>
                            <br>
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$vehicle['min_pax'].' - '.$vehicle['max_pax']}}</div>
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
                            <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['payMethod']=='efectivo'?__('Email.efectivo'):'Card'}}</div>
                        </li>
                        <br>
                        @if($item['payMethod'] == 'paypal')
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Order Id</strong>
                                <br>
                                <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{{$item['orderId']}}</div>
                            </li>
                            <br>
                        @endif
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