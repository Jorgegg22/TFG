<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Universidades</h1>
        <a href="<?= base_url('panel/crear') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Registro
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado Oficial</h6>
        </div>
        <?php if(!empty($universidades)):?>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Siglas</th>
                            <th>Ciudad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($universidades as $uni):?>
                        <tr>
                            <td><?= $uni['id']?></td>
                            <td><?= $uni['nombre']?></td>
                            <td><?= $uni['siglas']?></td>
                            <td><?= $uni['ciudad']?></td>

                            <td class="text-center">
                            
                                <a href="#" class="btn btn-warning btn-circle btn-sm shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-circle btn-sm btn-borrar shadow-sm" data-id="1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            
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

        <?php endif;?>
    </div>

</div>