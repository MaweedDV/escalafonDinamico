<nav id="sidebar" aria-label="Main Navigation">
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <a class="fw-semibold text-white tracking-wide" href="/admin/dashboard">
                <span class="smini-visible">
                    E<span class="opacity-75">M</span>
                </span>
                <span class="smini-hidden">
                    Escalafón <span class="opacity-75">Municipal</span>
                </span>
            </a>
            <div>
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                    data-target="#dark-mode-toggler" data-class="far fa" onclick="Dashmix.layout('dark_mode_toggle');">
                    <i class="far fa-moon" id="dark-mode-toggler"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-heading">Administrador</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-angles-up"></i>
                        <span class="nav-main-link-name">Ascensos</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-file-pen"></i>
                        <span class="nav-main-link-name">Calificación</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('escalafon.index') }}">
                        <i class="nav-main-link-icon fa fa-list-ol"></i>
                        <span class="nav-main-link-name">Escalafón</span>
                    </a>
                </li>
                <li class="nav-main-heading">Mantenedores</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-users-gear"></i>
                        <span class="nav-main-link-name">Usuarios del Sistema</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-building-user"></i>
                        <span class="nav-main-link-name">Funcionarios</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-file-pen"></i>
                        <span class="nav-main-link-name">Nombres de Cargos</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-id-card"></i>
                        <span class="nav-main-link-name">Cargos Escalafón (Nombre cargo y Grado)</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
