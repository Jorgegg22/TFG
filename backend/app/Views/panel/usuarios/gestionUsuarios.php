<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Usuarios</h1>
        <a href="<?= base_url('admin/usuarios/crear') ?>" class="btn btn-sm btn-primary shadow-sm px-3 py-2 rounded-pill">
            <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Nuevo Registro
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-4 bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Listado Usuarios</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end mt-3 mt-md-0">
                    <div class="filter-group d-flex align-items-center">
                        <select class="form-control custom-select-modern mr-2" id="filterSelect">
                            <option selected disabled>Filtrar por...</option>
                            <option value="1">Dato 1</option>
                            <option value="2">Dato 2</option>
                        </select>
                        <div class="input-group search-group">
                            <input type="text" class="form-control search-input" placeholder="Buscar..." id="tableSearch">
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

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dato 1</th>
                            <th>Dato 2</th>
                            <th>Dato 3</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ejemplo A</td>
                            <td>Ejemplo B</td>
                            <td>Ejemplo C</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-circle btn-sm shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-circle btn-sm btn-borrar shadow-sm" data-id="1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
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
    </div>

</div>