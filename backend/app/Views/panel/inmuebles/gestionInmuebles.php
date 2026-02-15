<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Inmuebles</h1>
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert"
                style="border-left: 5px solid #1cc88a !important;">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading mb-1 font-weight-bold">¡Operación Exitosa!</h5>
                        <p class="mb-0"><?= session()->getFlashdata('mensaje') ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <a href="<?= base_url('admin/inmuebles/crear') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm px-3 rounded-pill">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuevo Registro
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-4 bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Listado Inmuebles - <?= count($inmuebles) ?></h6>
                </div>

                <div class="col-md-6 d-flex justify-content-end mt-3 mt-md-0">
                    <div class="input-group search-group" style="max-width: 300px;">
                        <input type="text" class="form-control search-input" placeholder="Buscar inmueble..." id="tableSearch">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-left-0">
                                <i class="fas fa-search text-gray-400"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($inmuebles)): ?>
            <?php
           
                $num_registros = count($inmuebles);
                $registros_por_pagina = 10;
                $paginaActual = $_REQUEST["num"] ?? 1;

                $inicio = (($paginaActual - 1) * $registros_por_pagina);
                $total_paginas = ceil($num_registros / $registros_por_pagina);
                $inmuebles_paginados = array_slice($inmuebles, $inicio, $registros_por_pagina);
                
               
                $params = $_GET;
            ?>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Propietario</th>
                                <th>Dirección</th>
                                <th>Precio</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inmuebles_paginados as $inm): ?>
                                <tr>
                                    <td><?= $inm['id'] ?></td>
                                    <td class="font-weight-bold text-dark"><?= esc($inm['titulo']) ?></td>
                                    <td>
                                        <i class="fas fa-user-tie fa-sm mr-1 text-gray-400"></i>
                                        <?= esc($inm['nombre_propietario']) ?>
                                    </td>
                                    <td><small><?= esc($inm['direccion']) ?></small></td>
                                    <td><span class="text-primary font-weight-bold"><?= number_format($inm['precio'], 0, ',', '.') ?> €</span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/inmuebles/editar/" . esc($inm['id'])) ?>" class="btn btn-warning btn-circle btn-sm shadow-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url("admin/inmuebles/borrar/" . esc($inm['id'])) ?>"
                                           class="btn btn-danger btn-circle btn-sm btn-borrar shadow-sm"
                                           onclick="return confirm('¿Estás seguro de que deseas eliminar este inmueble?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white py-3 border-top-0">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <small class="text-muted mb-2 mb-md-0">
                        Mostrando página <b><?= $paginaActual ?></b> de <b><?= $total_paginas ?></b>
                    </small>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                            
                            <?php if ($paginaActual > 1): ?>
                                <?php $params['num'] = $paginaActual - 1; ?>
                                <li class="page-item">
                                    <a class="page-link shadow-none" href="<?= base_url('admin/inmuebles') . '?' . http_build_query($params) ?>">Anterior</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                <?php $params['num'] = $i; ?>
                                <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                                    <a class="page-link shadow-none" href="<?= base_url('admin/inmuebles') . '?' . http_build_query($params) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($paginaActual < $total_paginas): ?>
                                <?php $params['num'] = $paginaActual + 1; ?>
                                <li class="page-item">
                                    <a class="page-link shadow-none" href="<?= base_url('admin/inmuebles') . '?' . http_build_query($params) ?>">Siguiente</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                            <?php endif; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        <?php else: ?>
            <div class="card-body text-center py-5">
                <i class="fas fa-home fa-3x text-gray-200 mb-3"></i>
                <p class="text-gray-500">No se encontraron inmuebles en la base de datos.</p>
            </div>
        <?php endif; ?>
    </div>
</div>