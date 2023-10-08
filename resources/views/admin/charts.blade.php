<div class="px-5 pb-5">
    <div class="d-flex justify-content-end col-12">
        <div class="d-flex col-6">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="month-chart" class="font-weight-bold text-gray">Mes</label>
                <select class="form-control" id="month-chart" onchange="handleMonthChart()">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="mounth-chart" class="font-weight-bold text-gray">Año</label>
                <select class="form-control" id="year-chart" onchange="handleMonthChart()">
                    
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ventas Trip (<span class="currentMonthTrip"></span>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 pl-3" id="total-trip"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas Tour (<span class="currentMonthTour"></span>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 pl-3" id="total-tour"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Trips para <span class="currentMonthTrip"></span></div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 pl-3" id="count-trips"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tours para <span class="currentMonthTour"></span></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 pl-3" id="count-tour"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mt-3">
        <div class="col-12 col-md-6 col-sm-12" >
            <h4>Gráfica de transfers</h4>
            <div style="min-height:300px">
                <canvas id="myChartTrip"></canvas>
            </div>
        </div>
        <div class="col-12 col-md-6 col-sm-12">
            <h4>Gráfica de tours</h4>
            <div style="min-height:300px">
                <canvas id="myChartTour"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/Chart.js')}}"></script>
<script src="{{ asset('js/admin/chart.js')}}"></script>
