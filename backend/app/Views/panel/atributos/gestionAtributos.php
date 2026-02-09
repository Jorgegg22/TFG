<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Atributos</h1>
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
        <a href="<?= base_url('admin/atributos/crear') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Registro
        </a>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-4 bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Listado Atributos - <?= count($atributos) ?></h6>
                </div>

                <div class="col-md-6 d-flex justify-content-end mt-3 mt-md-0">
                    <div class="filter-group d-flex align-items-center">
                        <div class="input-group search-group">
                            <input type="text" class="form-control search-input" placeholder="Buscar..."
                                id="tableSearch">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent border-left-0">
                                    <i class="fas fa-search text-gray-400"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($atributos)):?>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nombre Icono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($atributos as $atr):?>
                        <tr>
                            <td><?= $atr['id']?></td>
                            <td><?= $atr['nombre']?></td>
                            <td><?= $atr['icono']?></td>


                            <td class="text-center">

                                <a href="<?= base_url("admin/atributos/editar/" . esc($atr['id'])) ?>" class="btn btn-warning btn-circle btn-sm shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url("admin/atributos/borrar/" . esc($atr['id'])) ?>"
                                    class="btn btn-danger btn-circle btn-sm btn-borrar shadow-sm" data-id="1"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este atributo?');">
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
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled">
                        <a class="page-link shadow-none" href="#" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item">
                        <a class="page-link shadow-none" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php else:?>
        <div></div>

        <?php endif;?><div class="card-body">
        </div>

    </div>