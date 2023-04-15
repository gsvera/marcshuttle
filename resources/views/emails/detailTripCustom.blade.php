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
            background-image:url(/img/banners/traslados-cancun.webp);
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
            margin: -220px auto 0;
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
        .arrivaldate{

        }
        .departuredate{
            
        }
</style>
</head>
<body>
    <div class="bg-principal">
        <div style="background-color:rgba(0,0,0,0.4);height:450px;">
            <div style="display:flex;">
                <img class="img-logo" src="https://templatekits.themewarrior.com/transpo/wp-content/uploads/sites/64/2022/08/logo-light-transpo-1.png"/>
            </div>
        </div>
    </div>
    <div class="card">
        <div><h1 style="text-align:center;">Reservation especial</h1></div>
        <div class="flex">
            <div class="card-gray">
                <ul style="list-style:none;padding:0;">
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Nombre completo:</strong> 
                        <br>
                        <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">Nombre que va aqui</div>
                    </li>
                    <br>
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Email:</strong> 
                        <br>
                        <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">email@email.com</div>
                    </li>
                    <br>
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Telefono:</strong> 
                        <br>
                        <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">11123456789</div>
                    </li>
                    <br>                    
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> departure:</strong> 
                        <br>
                        <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{14/04/2023}</div>
                    </li>
                    <br>
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-blue" aria-hidden="true"></i> Hora:</strong> 
                        <br>
                        <div class="text-gray strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">5:14 pm</div>
                    </li>                    
                </ul>
            </div>
            <div class="card-blue">
                <ul style="list-style:none;padding:0;">                                        
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {Hotel / Airbnb / Location (origen)}</strong>
                        <br>
                        <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{Hotel Ryu}</div>
                    </li>
                    <br>
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> {Hotel / Airbnb / Location (destino)}</strong>
                        <br>
                        <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">{Hotel palace}</div>
                    </li>
                    <br>
                    <li>
                        <strong class="text-orange"><i class="fa fa-check text-orange" aria-hidden="true"></i> Pax</strong>
                        <br>
                        <div class="text-white strong" style="margin-left:10px;margin-top:5px;font-size:1.1em;">10</div>
                    </li>
                </ul>
            </div>
        </div>
        <div style="width:80%; margin: 10px auto;">
            <div class="text-blue strong" style="font-size:1.3em;">Comentarios</div>
            <div class="text-gray strong" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae sit cumque ipsam temporibus optio quaerat dolorum impedit ex natus placeat fuga aspernatur molestiae rem nemo consectetur, repellat velit, rerum voluptatem.</div>
        </div>
    </div>    
</body>
</html>