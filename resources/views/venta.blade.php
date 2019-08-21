@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="venta" ng-cloak >

        <!-- tercera linea -->
        <div class="row p-raw">
            <div class="col-md-4 trending">
            </div>

            <div class="col-md-4 trending panel">
                <div class="mdl-card__titl">
                    <h2 class="mdl-card__title-text" style="background:background-color !importat" >Registro de Venta</h2>
                </div>
                <div class="scroll_table">
                    <form class="form-horizontal"  ng-submit="guardarVenta()">
                        <fieldset>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="fecha" name="fecha" type="date" class="form-control" ng-model="venta.fecha" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12 ">
                                    <label for="">Selecciona un cliente</label>
                                    <select class="form-control" ng-model="venta.cliente">
                                        <option selected ng-repeat="cliente in clientes" value="@{{cliente.id}}">@{{cliente.nombre}} @{{cliente.apellido}}</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12 ">
                                    <label for="">Selecciona un producto</label>
                                    <select class="form-control" ng-model="venta.producto">
                                        <option  ng-repeat="producto in productos" value="@{{producto.id}}">@{{producto.nombre}}</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <label for="">Tipo de moneda</label>
                                    <select class="form-control" ng-model="venta.moneda">
                                        <option value="GTQ" ng-selected="true">GTQ</option> 
                                        <option value="USD">USD</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="cantidad" name="cantidad" type="number" 
                                    placeholder="Cantidad del producto" class="form-control" ng-model="venta.cantidad" required>
                                </div>
                            </div>                          

                            <div class="form-group pd_top">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Registrar Venta</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                      
                </div>
            </div>
            
            <div class="col-md-4 trending">
            </div>
        </div>

    </main>
    
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/Controllers/venta.js')}}"></script>
@endpush
