<div class="container-fluid">

    <div class="card shadow mb-4 border-0">
    <div class="card-header py-4 bg-white">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Listado Usuarios - <?= count($usuarios) ?></h6>
            </div>
            </div>
    </div>

    <?php if (!empty($usuarios)): ?>
        <?php
        $num_registros = count($usuarios);
        $registros = 10;
        $paginaActual = $_REQUEST["num"] ?? 1;

        $inicio = (($paginaActual - 1) * $registros);
        $paginas = ceil($num_registros / $registros);
        $usuarios_paginados = array_slice($usuarios, $inicio, $registros);
        
        
        $params = $_GET;
        ?>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios_paginados as $us): ?>
                            <tr>
                                <td><?= $us['id'] ?></td>
                                <td><?= esc($us['nombre']) ?></td>
                                <td><?= esc($us['email']) ?></td>
                                <td><span class="badge badge-light text-dark border"><?= strtoupper($us['rol']) ?></span></td>
                                <td class="text-center">
                                    <?php if ($us['rol'] !== "admin"): ?>
                                        <a href="<?= base_url("admin/usuarios/editar/" . esc($us['id'])) ?>"
                                            class="btn btn-warning btn-circle btn-sm shadow-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url("admin/usuarios/borrar/" . esc($us['id'])) ?>"
                                            class="btn btn-danger btn-circle btn-sm shadow-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="badge badge-info shadow-sm"><i class="fas fa-shield-alt"></i> Protegido</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3 border-top-0">
            <nav aria-label="Navegación de usuarios">
                <ul class="pagination justify-content-end mb-0">
                    
                    <?php if ($paginaActual > 1): ?>
                        <?php $params['num'] = $paginaActual - 1; ?>
                        <li class="page-item">
                            <a class="page-link shadow-none" href="<?= base_url('admin/usuarios') . '?' . http_build_query($params) ?>">Anterior</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $paginas; $i++): ?>
                        <?php $params['num'] = $i; ?>
                        <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                            <a class="page-link shadow-none" href="<?= base_url('admin/usuarios') . '?' . http_build_query($params) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($paginaActual < $paginas): ?>
                        <?php $params['num'] = $paginaActual + 1; ?>
                        <li class="page-item">
                            <a class="page-link shadow-none" href="<?= base_url('admin/usuarios') . '?' . http_build_query($params) ?>">Siguiente</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente</span>
                        </li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    <?php else: ?>
        <div class="p-5 text-center">
            <i class="fas fa-users-slash fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No se encontraron usuarios registrados.</p>
        </div>
    <?php endif; ?>
</div>

</div>