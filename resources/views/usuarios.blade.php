@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="usuariosCtrl" ng-cloak >

        <!-- tercera linea -->
        <div class="row p-raw">
            <div class="col-md-3 trending">
            </div>

            <div class="col-md-6 trending">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Usuarios</h2>
                </div>
                <div class="mdl-card scroll_table">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat = 'usuario in usuarios'>
                                <th scope="row">@{{ $index + 1 }}</th>
                                <td>@{{usuario.name}}</td>
                                <td>@{{usuario.email}}</td>
                                <td>@{{usuario.created_at}}</td>
                                <td>ACTIVO</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-md-3 trending">
            </div>
        </div>

    </main>
    
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/Controllers/usuarios.js')}}"></script>
@endpush
