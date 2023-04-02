@extends('web.layouts.layout')
@section('content')
    <div class="layer-home back-slider-home"></div>
    <div class="d-flex mt-4 elementup">
        <div class="col-md-6 mt-5 row" style="align-items:center;padding-left:80px;">
            <div>
                <p class="text-cian ls2">TRANSPO</p>
                <h1 class="font-weight-bold text-white fsize-xl">{{__('Home.titulo-inicio')}}</h1>
                <p class="font-weight-bold text-white">{{__('Home.texto-principal')}}</p>
                <button class="btn btn-white-contac btn-lg font-weight-bold">{{__('Home.contactanos')}}</button>
            </div>
        </div>
        <div class="col-md-6">
            <div id="motorbusqueda"></div>
        </div>        
    </div>
    <div class="d-flex col-md-11 mx-auto mt-5 elementup">
        <div class="col-md-3">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/book-confirm.png" alt="book confirm"></span>
                </div>
                <h5 class="font-weight-bold">Book Direct</h5>
                <p class="text-gray">Purus porta feugiat ege lectus diam sed ipsum.</p>
                <span class="text-blue font-weight-bold">Cheap Coach Tickets <i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-white row">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/verified_user.png" alt="virified user"></span>
                </div>
                <h5 class="font-weight-bold">Keeping You Safe</h5>
                <p class="text-gray">Purus porta feugiat ege lectus diam sed ipsum.</p>
                <span class="text-blue font-weight-bold">Explore now <i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-white">
                <div class="my-3">
                    <span class="icon-cian"><img src="/img/icons/currency_exchange.png" alt="currency exchange"></span>
                </div>
                <h5 class="font-weight-bold">No Booking Fees</h5>
                <p class="text-gray">Purus porta feugiat ege lectus diam sed ipsum.</p>
                <span class="text-blue font-weight-bold">Sing up or Login <i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-img">
                <div class="card-img-blue row">
                    <div>
                        <h5 class="text-white font-weight-bold mb-4" style="font-size:1.7em;">Travel now. Pay later. <br />Always interest-free.</h5>
                        <button class="btn btn-white-contac btn-lg font-weight-bold">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="d-flex justify-content-center">
            <div class="col-md-7 text-center">
                <div class="text-center text-blue font-weight-bold ls2">{{strtoupper(__('MotorBusqueda.servicios'))}}</div>
                <h2 class="fsize-md font-weight-bold">Bus Rental & Shuttle <br /> Services</h2>
                <div class="line-sm-blue mx-auto my-3"></div>
                <p class="text-gray fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim orci. In lectus bibendum gravida aliquet faucibus id. Id gravida consectetur lectus imperdiet.</p>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="row col-md-10 mx-auto">
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">School Bus Rental</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">Wendding & Engagements</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">Corporate Travel</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-10 mx-auto mt-5">
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">School Bus Rental</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">Wendding & Engagements</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-back">
                    <div class="degradate-black row align-items-end" style="padding:0;margin:0;">
                        <div class="col text-center">
                            <p class="font-weight-bold text-white fsize-mds">Corporate Travel</p>
                            <div class="row justify-content-center">
                                <div class="icon-orange">
                                    <i class="fa fa-arrow-right text-white fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="banner-bus">
            <div class="d-flex">
                <div class="col-md-6 row" style="padding:5% 0 5% 3%;">
                    <div class="text-white ls2">WHY</div>
                    <h2 class="text-white font-weight-bold fsize-md">Why Transpo Charters?</h2>
                    <div class="line-sm-white my-3" style="margin-left: calc(var(--bs-gutter-x) * 0.5);"></div>
                    <p class="text-white fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim orci. In lectus bibendum gravida aliquet faucibus id. Id gravida consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque posuere. Vitae eleifend id tellus</p>
                    <ul style="list-style:none;">
                        <li class="text-white fsize-mds font-weight-bold">1. Traveling from coast to coast? <span class="text-cian">Covered.</span></li>
                        <li class="text-white fsize-mds font-weight-bold">2. Need a quick shuttle service? <span class="text-cian">We’ve got you.</span></li>
                        <li class="text-white fsize-mds font-weight-bold">3. Traveling from coast to coast? <span class="text-cian">No worries.</span></li>
                    </ul>                    
                </div>
                <div class="col-md-6 row justify-content-center" style="padding:5% 0 5% 5%;">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card-white row">
                                <div class="my-3">
                                    <span class="icon-cian"><img src="/img/icons/directions_bus.png" alt="virified user"></span>
                                </div>
                                <h4 class="font-weight-bold">5,000+</h4>
                                <p class="text-gray fsize-sm">Transportation</p>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-white row">
                                <div class="my-3">
                                    <span class="icon-cian"><img src="/img/icons/groups.png" alt="virified user"></span>
                                </div>
                                <h4 class="font-weight-bold">700,000+</h4>
                                <p class="text-gray fsize-sm">Passengers delighted</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-white row">
                                <div class="my-3">
                                    <span class="icon-cian"><img src="/img/icons/map.png" alt="virified user"></span>
                                </div>
                                <h4 class="font-weight-bold">25,000+</h4>
                                <p class="text-gray fsize-sm">Charter bus trips</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-white row">
                                <div class="my-3">
                                    <span class="icon-cian"><img src="/img/icons/favorite.png" alt="virified user"></span>
                                </div>
                                <h4 class="font-weight-bold">100%</h4>
                                <p class="text-gray fsize-sm">Satisfied passengers</p>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>            
        </div>
        <div class="banner-driver">
            <div class="">
                <div class="col-md-6 row"  style="padding:5% 0 5% 5%;">
                    <div class="text-blue ls2 font-weight-bold">{{strtoupper(__('MotorBusqueda.acerca-de-nosotros'))}}</div>
                    <h2 class="font-weight-bold fsize-md">About Transpo Charter Bus Company</h2>
                    <div class="line-sm-blue my-3" style="margin-left: calc(var(--bs-gutter-x) * 0.5);"></div>                    
                    <p class="text-gray fsize-sm mb-5">Purus porta feugiat egestas a diam sed ipsum, enim. In lectus bibendum gravida aliquet faucibus id gravida consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque posuere. Vitae eleifend id tellus</p>
                    <p class="text-gray fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim. In lectus bibendum gravida aliquet faucibus id gravida consectetur lectus imperdiet vulputate scelerisque. Tempor in aenean neque posuere. Vitae eleifend id tellus</p>                
                    <div>
                        <button type="button" class="btn btn-naranja btn-lg px-4 py2">{{__('MotorBusqueda.aprende-mas')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="col-md-10 text-center mx-auto">
            <div class="text-blue ls2 font-weight-bold">PARTNERS</div>
            <h2 class="font-weight-bold fsize-md">Our Partners</h2>
            <div class="line-sm-blue my-3 mx-auto"></div>
            <p class="text-gray fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim orci. In lectus bibendum <br /> gravida aliquet faucibus id. Id gravida consectetur lectus imperdiet.</p>
        </div>
        <div class="col-md-10 d-flex justify-content-between mx-auto mt-5">
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
            <div>
                <img src="/img/logos/logoipsum1.png" alt="logo">
            </div>
        </div>
    </div>    
    <div class="banner-lineal">
        <div class="text-center" style="padding:100px 50px">
            <div class="text-white ls2 font-weight-bold">BUSSES</div>
            <h2 class="text-white font-weight-bold fsize-md">Our Best Buses</h2>
            <div class="line-sm-white my-3 mx-auto"></div>
            <p class="text-white fsize-sm">Purus porta feugiat egestas a diam sed ipsum, enim orci. In lectus bibendum <br /> gravida aliquet faucibus id. Id gravida consectetur lectus imperdiet.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">        
        $('#motorbusqueda').load('/motorbusqueda');
    </script>
@endpush