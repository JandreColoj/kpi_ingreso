@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="productos" ng-cloak >

        <!-- tercera linea -->
        <div class="row p-raw">
            <div class="col-md-4 trending">
            </div>

            <div class="col-md-4 trending panel">
                <div class="mdl-card__titl">
                    <h2 class="mdl-card__title-text" style="background:background-color !importat" >Nuevo Producto</h2>
                </div>
                <div class="scroll_table">
                    <form class="form-horizontal"  ng-submit="guardarProducto()">
                        <fieldset>
                            <div class="form-group pd_top">
                                <div class="col-md-12 ">
                                    <select class="form-control" id="sel1" ng-model="producto.categoria">
                                        <option value="1" select>Computadoras</option>
                                        <option value="2">Accesorios</option>
                                        <option value="3">Audio</option>
                                        <option value="4">Memorias</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="name" name="name" type="text" 
                                           placeholder="Nombre del producto" class="form-control" ng-model="producto.nombre" required>
                                </div>
                            </div>
                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="precio" name="precio" type="text" 
                                           placeholder="Precio del producto" class="form-control" ng-model="producto.precio" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <input id="exitencia" name="existencia" type="number" 
                                    placeholder="Existencia" class="form-control" ng-model="producto.existencia" required>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12">
                                    <textarea name="textarea" rows="5" cols="20" class="form-control" ng-model="producto.descripcion" required>
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group pd_top">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Guardar Producto</button>
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
    <script type="text/javascript" src="{{asset('js/Controllers/productos.js')}}"></script>
@endpush
