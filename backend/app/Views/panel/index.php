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
                <?php if ($usuarios): ?>
                    <h2 class="value"><?= count($usuarios) ?></h2>
                <?php endif; ?>
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
                <?php if ($inmuebles): ?>
                    <h2 class="value"><?= count($inmuebles) ?></h2>
                <?php endif; ?>
            </div>

        </div>

        <div class="glass-card stat-item">
            <div class="stat-icon-wrapper green">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <div class="stat-text">
                <span class="label">Matches Totales</span>
                <?php if ($matches): ?>
                    <h2 class="value"><?= count($matches) ?></h2>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="management-section">

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow border-0" style="border-radius: 20px;">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-tasks mr-2 text-primary"></i>
                            Administrar Tablas</h6>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('admin/universidades') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-university text-info mr-2"></i> Gestionar Universidades
                        </a>
                        <a href="<?= base_url('admin/carreras') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-graduation-cap text-warning mr-2"></i> Listado de Carreras
                        </a>
                        <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-users text-success mr-2"></i> Administrar Usuarios
                        </a>
                        <a href="<?= base_url('admin/inmuebles') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-building text-danger mr-2"></i> Administrar Inmuebles
                        </a>
                        <a href="<?= base_url('admin/atributos') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px;">
                            <i class="fas fa-tags text-secondary mr-2"></i> Gestionar Atributos
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
                        <a href="<?= base_url('admin/inmuebles/crear') ?>"
                            class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #007bff;">
                            <i class="fas fa-home text-primary mr-2"></i> Registrar Nuevo Inmueble
                        </a>
                        <a href="<?= base_url('admin/usuarios/crear') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #6f42c1;">
                            <i class="fas fa-user-plus text-purple mr-2"></i> Crear Nuevo Usuario
                        </a>
                        <a href="<?= base_url('admin/universidades/crear') ?>"
                            class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #17a2b8;">
                            <i class="fas fa-plus text-info mr-2"></i> Añadir Universidad
                        </a>
                        <a href="<?= base_url('admin/carreras/crear') ?>" class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #ffc107;">
                            <i class="fas fa-plus text-warning mr-2"></i> Añadir Carrera
                        </a>
                        <a href="<?= base_url('admin/atributos/crear') ?>"
                            class="btn btn-light btn-block text-left mb-2"
                            style="border-radius: 12px; padding: 12px; border-left: 4px solid #6c757d;">
                            <i class="fas fa-plus text-secondary mr-2"></i> Nuevo Atributo
                        </a>
                    </div>
                </div>
            </div>
        </div>v>
</div>
</section>
</div>