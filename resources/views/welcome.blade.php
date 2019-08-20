@extends('layouts.app')

<script>
    var csrfToken ="{{csrf_token()}}";
</script>

@section('content')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

    @include('layouts.menu')

    <main class="mdl-layout__content" ng-controller="welcome" ng-cloak >

        <div class="row margin_w">

            <div class="col-md-4 trending">
                <div class="mdl-card__title">
                    <h2 class="title">Base de datos conectadas</h2>
                </div>
                <div class="mdl-card">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

            <div class="col-md-8 trending">
                <div class="mdl-card__title">
                    <h2 class="title">Conexion a las siguientes bases de datos</h2>
                </div>
                
                <div class="row">
                    <div class="contenedor_logos">
                        <div class="col-md-3 mysql-logo">                        
                        </div>
                        <div class="col-md-3 postgres-logo">                        
                        </div>
                        <div class="col-md-3 sqlserver-logo">                        
                        </div>
                        <div class="col-md-3 oracle-logo">                        
                        </div>
                    </div>                    
                </div>

            </div>
        </div>        

    </main>
    
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/Controllers/welcome.js')}}"></script>
@endpush
