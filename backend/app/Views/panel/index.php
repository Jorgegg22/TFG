<div class="admin-container">
    <header class="admin-header">
        <div class="header-content">
            <h1>Panel de Control</h1>
            <p>Bienvenido de nuevo, Administrador</p>
        </div>

    </header>

    <section class="stats-grid">
        <div class="glass-card stat-item">
            <div class="stat-icon-wrapper blue">
                <i class="fa-solid fa-user-group"></i>
            </div>
            <div class="stat-text">
                <span class="label">Usuarios Activos</span>
                <h2 class="value">1,240</h2>
            </div>
            <div class="stat-chart-mini">
                <div class="mini-bar" style="height: 40%"></div>
                <div class="mini-bar" style="height: 60%"></div>
                <div class="mini-bar" style="height: 80%"></div>
            </div>
        </div>

        <div class="glass-card stat-item">
            <div class="stat-icon-wrapper purple">
                <i class="fa-solid fa-house-circle-check"></i>
            </div>
            <div class="stat-text">
                <span class="label">Pisos Publicados</span>
                <h2 class="value">456</h2>
            </div>
            <div class="stat-badge positive">+5 hoy</div>
        </div>

        <div class="glass-card stat-item">
            <div class="stat-icon-wrapper green">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <div class="stat-text">
                <span class="label">Matches Totales</span>
                <h2 class="value">89</h2>
            </div>
        </div>
    </section>

    <section class="management-section">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow border-0" style="border-radius: 20px; background: #0056b3;">
                    <div class="card-body p-4">
                        <h5 class="text-white font-weight-bold mb-3">
                            <i class="fas fa-user-search mr-2"></i> Buscar Usuarios
                        </h5>
                        <form class="d-flex shadow-sm" style="border-radius: 12px; overflow: hidden;">
                            <input type="text" class="form-control border-0 p-3"
                                placeholder="Introduce nombre del usuario..."
                                style="border-radius: 12px 0 0 12px; height: 50px;">
                            <button class="btn btn-dark px-4"
                                style="border-radius: 0 12px 12px 0; background-color: #1a1a1a;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow border-0" style="border-radius: 20px;">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-tasks mr-2 text-primary"></i>
                            Gestión del Sistema</h6>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-university text-info mr-2"></i> Gestionar Universidades
                        </a>
                        <a href="#" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-graduation-cap text-warning mr-2"></i> Listado de Carreras
                        </a>
                        <hr>
                        <div class="p-2">
                            <small class="text-muted d-block">Estado del Servidor</small>
                            <span class="text-success" style="font-size: 0.8rem;"><i class="fas fa-circle mr-1"></i>
                                Base de datos Conectada</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow border-0" style="border-radius: 20px;">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-plus-circle mr-2 text-success"></i>
                            Acciones de Creación</h6>
                    </div>
                    <div class="card-body">

                        <a href="#" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #0056b3;">
                            <i class="fas fa-home text-primary mr-2"></i> Registrar Nuevo Inmueble
                        </a>
                        <a href="#" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #6f42c1;">
                            <i class="fas fa-user-plus text-purple mr-2"></i> Crear Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>