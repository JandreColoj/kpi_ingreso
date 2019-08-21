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
                <div class="p-s">
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
                            <th scope="col">Apellido</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Tipo de Cliente</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat = 'cliente in clientes'>
                                <th scope="row">@{{ $index + 1 }}</th>
                                <td contenteditable="true" id="td_@{{cliente.nombre}}"> @{{cliente.nombre}}</td>
                                <td contenteditable="true" id="td_@{{cliente.apellido}}">@{{cliente.apellido}}</td>
                                <td contenteditable="true" id="td_@{{cliente.telefono}}">@{{cliente.telefono}}</td>
                                <td>@{{cliente.tipoCliente}}</td>
                                <td>
                                    <a class="mdl-navigation__link" href="#" ng-click="editarCliente(cliente)"> 
                                        <i class="material-icons">create</i> 
                                    </a>
                                    <a class="mdl-navigation__link" href="#" ng-click="eliminarCliente(cliente)">
                                        <i class="material-icons">delete_sweep</i> 
                                    </a>
                                </td>
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
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat = 'producto in productos'>
                                <th scope="row">@{{ $index + 1 }}</th>
                                <td contenteditable="true" id="td_@{{producto.nombre}}">@{{producto.nombre}}</td>
                                <td contenteditable="true" id="td_@{{producto.descripcion}}">@{{producto.descripcion | limitTo:15 }}. . .</td>
                                <td contenteditable="true" id="td_@{{producto.precio}}">@{{producto.precio}}</td>
                                <td contenteditable="true" id="td_@{{producto.existencia}}">@{{producto.existencia}}</td>
                                <td>
                                    <a class="mdl-navigation__link" href="#" ng-click="editarProducto(producto)"> 
                                        <i class="material-icons">create</i> 
                                    </a>
                                    <a class="mdl-navigation__link" href="#" ng-click="eliminarProducto(producto)">
                                        <i class="material-icons">delete_sweep</i> 
                                    </a>
                                </td>
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
