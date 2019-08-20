
<header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
        <div class="mdl-layout-spacer"></div>

        <div class="avatar-dropdown" id="icon">
        
            <img src={{ asset('css/images/Icon_header.png') }}>
        </div>
        <!-- Account dropdawn-->
        <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown"
            for="icon">
            <li class="mdl-menu__item mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                    <a href={{ url('logout') }}>Salir</a>
                </span>
            </li>
        </ul>
    </div>
</header>

<div class="mdl-layout__drawer">
    <header>darkboard</header>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link mdl-navigation__link--current" href={{ url('/') }}>
            <i class="material-icons" role="presentation">dashboard</i>
            Dashboard
        </a>
        <a class="mdl-navigation__link" href={{ url('kpi') }}>
            <i class="material-icons">multiline_chart</i>
            KPI
        </a>
        <a class="mdl-navigation__link" href={{ url('registrar')}}>
            <i class="material-icons" role="presentation">person</i>
            Nuevo Usuario
        </a>
        <a class="mdl-navigation__link" href={{ url('usuarios') }}>
            <i class="material-icons" role="presentation">person</i>
            Listado de usuario
        </a>

        <div class="mdl-layout-spacer"></div>
        <a class="mdl-navigation__link" href="https://github.com/JandreColoj/administracion_IT">
            <i class="material-icons" role="presentation">link </i>
            GitHub
        </a>
    </nav>
</div>


<!-- https://www.youtube.com/watch?v=D8jh4AYthH0 -->