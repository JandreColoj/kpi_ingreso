@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="KPICtrl" ng-cloak >

         <!-- primera linea  -->
        <div class="row p-raw">
            <div class="col-md-4 trending">
                <div class="mdl-card p-s">
                    <form name="f1"> 
                        <ul>
                            <li>
                                <div class="circle">
                                    <img src= "{{asset('images/mysql.jpg')}}"/>
                                </div>
                                <h4>Mysql</h4>
                                <input id="Mysql" type="checkbox" ng-click="seleccionar('Mysql')" checked/>
                                <label for="Mysql" ><i class="fa fa-check"></i></label>
                            </li>
                            <li>
                                <div class="circle"><img src= "{{asset('images/postgres.jpeg')}}"/>
                                </div>
                                <h4>Postgres</h4>
                                <input id="Postgres" type="checkbox" ng-click="seleccionar('Postgres')"/>
                                <label for="Postgres"><i class="fa fa-check" ></i></label>
                            </li>
                            <li>
                                <div class="circle"><img src= "{{asset('images/sqlserver.png')}}"/>
                                </div>
                                <h4>SQLServer</h4>
                                <input id="SQLServer" type="checkbox" ng-click="seleccionar('SQLServer')"/>
                                <label for="SQLServer"><i class="fa fa-check"></i></label>
                            </li>
                            <li >
                                <div class="circle"><img src= "{{asset('images/oracle.png')}}"/>
                                </div>
                                <h4>Oracle</h4>
                                <input id="Oracle" type="checkbox" ng-click="seleccionar('Oracle')"/>
                                <label for="Oracle"><i class="fa fa-check"></i></label>
                            </li>
                        </ul>
                    </form> 
                </div>
            </div>
            
            <div class="col-md-4 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Filtros</h2>
                </div>
                <div class="mdl-card">
                    <form name="frm" class="content_filtro">
                        <div class="col-md-12">
                            <label for="">Fecha inicial:</label>
                            <input type="date" class="form-control" name="fini" ng-model="filtro.finicio" required>
                        </div>
                        <div class="col-md-12">
                            <label for="">Fecha final:</label>
                            <input type="date" class="form-control" name="ffin" ng-model="filtro.ffin" required>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn_filtro" ng-click="init()" ng-disabled="frm.$invalid">Filtrar</button>
                            <span style="color:red" ng-if="msj">@{{msj}}</span>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-md-4 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Resumen</h2>
                </div>
                <div class="mdl-resumen">
                    <p>CLIENTES: <span style="color: #03A9F4;"> @{{total_clientes}}</span> </p>
                    <p>PRODUCTOS: <span style="color: #03A9F4;"> @{{total_productos}}</span> </p>
                    <p>VENTAS EN  $ : <span style="color: #03A9F4;"> @{{total_ventaUSD | number:2}}</span> </p>
                    <p>VENTAS EN  Q : <span style="color: #03A9F4;"> @{{total_ventaGTQ | number:2}}</span> </p>
                    <p>PRODUCTO MAS VENDIDO : <span style="color: #03A9F4;"> @{{producto_top}}</span> </p>
                </div>
            </div>
        </div>

        <!-- segunda linea  -->
        <div class="row p-raw">
            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text"> Clientes </h2>
                </div>
                <div class="mdl-card pd-chrt">
                <canvas id="pie-chart"></canvas>
                </div>
            </div>
            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Listado de clientes</h2>
                </div>
                <div class="mdl-card scroll_table">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Tipo de Cliente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat = 'cliente in clientes'>
                                <th scope="row">@{{ $index + 1 }}</th>
                                <td>@{{cliente.nombre}} @{{cliente.apellido}}</td>
                                <td>@{{cliente.telefono}}</td>
                                <td>@{{cliente.tipoCliente}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- tercera linea -->
        <div class="row p-raw">
            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Categorias de productos</h2>
                </div>
                <div class="mdl-card">
                    <canvas id="doughnut-chart" width="800" height="450"></canvas>
                </div>
            </div>

            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Listado de productos</h2>
                </div>
                <div class="mdl-card scroll_table">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Existencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat = 'producto in productos'>
                                <th scope="row">@{{ $index + 1 }}</th>
                                <td>@{{producto.nombre}}</td>
                                <td>@{{producto.descripcion}}</td>
                                <td>@{{producto.precio}}</td>
                                <td>@{{producto.stock}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- cuarta linea -->
        <div class="row p-raw">
            <div class="col-md-12 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Existencia de productos</h2>
                </div>
                <div class="mdl-card">
                    <canvas id="bar-chart-productos" width="800" height="290"></canvas>
                </div>
            </div>
        </div>

        <!-- quinta linea -->
        <div class="row p-raw">
            <div class="col-md-12 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Ventas diarias</h2>
                </div>
                <div class="mdl-card">
                    <canvas id="line-chart" width="800" height="200"></canvas>  
                </div>
            </div>
        </div>
       
       <!-- sexta linea -->
        <div class="row p-raw">
            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Ventas por mes</h2>
                </div>
                <div class="mdl-card">
                <canvas id="bar-chart-grouped" width="800" height="375"></canvas>
                </div>
            </div>
            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Productos mas vendidos</h2>
                </div>
                <div class="mdl-card">
                    <canvas id="bar-chart-horizontal" width="800" height="375"></canvas>
                </div>
            </div>
        </div>

    </main>
    
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/Controllers/kpi.js')}}"></script>
@endpush
