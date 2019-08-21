@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="clientes" ng-cloak >

        <!-- tercera linea -->
        <div class="row p-raw">
            <div class="col-md-4 trending">
            </div>

            <div class="col-md-4 trending panel">
                <div class="mdl-card__titl">
                    <h2 class="mdl-card__title-text" style="background:background-color !importat" >Nuevo cliente</h2>
                </div>
                <div class="scroll_table">
                    <form class="form-horizontal"  ng-submit="guardarCliente()">
                        <fieldset>
                            <div class="form-group pd_top">
                                <div class="col-md-12 ">
                                    <select class="form-control" id="sel1" ng-model="cliente.tipoCliente">
                                        <option value="oro" select>Oro</option>
                                        <option value="plata">Plata</option>
                                        <option value="premium">Premium</option>
                                        <option value="basico">basico</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="name" name="name" type="text" 
                                           placeholder="Escriba el nombre del cliente" class="form-control" ng-model="cliente.nombre" required>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="apellido" name="apellido" type="text" 
                                           placeholder="Escriba el Apellido del cliente" class="form-control" ng-model="cliente.apellido" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="email" name="email" type="text" 
                                    placeholder="Direccion del cliente" class="form-control" ng-model="cliente.direccion" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="phone" name="phone" type="text" 
                                           placeholder="Telefono del cliente" class="form-control" ng-model="cliente.telefono" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Guardar Cliente</button>
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
    <script type="text/javascript" src="{{asset('js/Controllers/clientes.js')}}"></script>
@endpush
