                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .text-white > a{
            color:white !important;
        }
        .text-blue{
            color:#1346A8;
        }
        .text-orange{
            color:black;
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
            justify-content:center;
        }
        .card-gray{
            width:45%;
            background-color:#F5F7F9;
            border-radius:5px;
            /* margin: 7px; */
            padding: 5px 11px;
        }
        .card-blue{
            width:55%;
            background-color:#1346A8;
            border-radius:5px;
            /* margin: 7px; */
            padding: 5px 0 5px 11px;
        }
        .flex{
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
        }
        .invert-color-logo{
            filter: invert(1);
        }
        .text-center{
            text-align:center;
        }
        .d-flex-img{
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .content-img{
            width: 250px;
            height: 150px;
            margin: 0 40px;
            padding: 0;
        }
        .size-img{
            width: 250px;
            height: 150px;
        }
        .mb-2{
            margin-bottom: 30px;
        }
        .card-body{
            display: flex;
        }
</style>
</head>
<body>
    <div class="bg-principal" style="margin-bottom:-200px">
        <div style="background-color:rgba(0,0,0,0.4);height:450px;">
            <div style="display:flex;">
                <img class="img-logo invert-color-logo" src="{{env('APP_URL')}}/img/logos/logo-marcshuttle-black.png" width="200px"/>
            </div>
        </div>
    </div>
    <div style="display:flex; justify-content:center;margin-top:-13%">
        <div class="card">
            <div><h1 style="text-align:center;">{{__('Email.titulo-especial')}}</h1></div>
            <div class="card">
                <div class="card-body">
                    <div class="card-gray">
                        <ul style="list-style:none;padding:0;">
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i>{{__('Email.type_service')}}</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i>Folio:</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.nombre')}}:</strong> 
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Email:</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.telefono')}}:</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i>{{__('Email.pasajeros')}}</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i>{{__('MotorBusqueda.silla-bebe')}}</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.zona')}}</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {{__('Email.a')}}</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.salida')}}:</strong>
                            </li>
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> {{__('Email.hora_salida')}}:</strong>
                            </li>                    
                            <br>
                            <li>
                                <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i>{{__('Email.status-pay')}}</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="card-blue">
                        <ul style="list-style:none;padding:0;">        
                            <li>
                                <div class="text-white strong">{{__('Email.titulo-especial')}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$folio}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong" >{{$item['first_name']. ' '.$item['last_name']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong" >{{$item['email']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong" >{{$item['phone']}}</div>
                            </li>
                            <br>                    
                            <li>
                                <div class="text-white strong">{{$item['pax']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$item['sillaBebe'] == 1 ? __('MotorBusqueda.si') : "No"}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$item['origin']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$item['destination']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$item['departure_date']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{$item['departure_time']}}</div>
                            </li>
                            <br>
                            <li>
                                <div class="text-white strong">{{__('Email.pendiente')}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="width:80%; margin: 10px auto;">
                <div class="text-blue strong" style="font-size:1.3em;">{{__('MotorBusqueda.comentarios')}}</div>
                <div class="text-gray strong" style="text-align: justify;">{{$item['comments']}}</div>
            </div>
        </div>    
    </div>
    <div>
        <h4 class="text-cente mb-2">{{__('Email.pdf-text-extra')}}</h4>
        <p>{{__('Email.pdf-text-extra-1')}}</p>
        <p>{{__('Email.pdf-text-extra-2')}}</p>
        <div class="d-flex-img">
            <div class="content-img">
                <img class="size-img" src="{{env('APP_URL')}}/img/assets/img-pdf-1.jpeg" alt="">
            </div>
            <div class="content-img">
                <img class="size-img" src="{{env('APP_URL')}}/img/assets/img-pdf-2.jpeg" alt="">
            </div>
            <div class="content-img">
                <img class="size-img" src="{{env('APP_URL')}}/img/assets/img-pdf-3.jpeg" alt="">
            </div>
        </div>
        <h4 class="text-center mb-2">{{__('Email.pdf-text-extra-3')}}</h4>
        <p>{{__('Email.pdf-text-extra-4')}}</p>
        <h4 class="text-center mb-2">{{__('Email.pdf-text-extra-5')}}</h4>
        <p>{{__('Email.pdf-text-extra-6')}}</p>
        <h4 class="text-center mb-2">{{__('Email.pdf-text-extra-7')}}</h4>
        <p>{{__('Email.pdf-text-extra-8')}}</p>
        <p>{{__('Email.pdf-text-extra-9')}}</p>
        <p>{{__('Email.pdf-text-extra-10')}}</p>
        <p>{{__('Email.pdf-text-extra-11')}}</p>
        <p>{{__('Email.pdf-text-extra-12')}}</p>
        <p>{{__('Email.pdf-text-extra-13')}}</p>
    </div>
</body>
</html>