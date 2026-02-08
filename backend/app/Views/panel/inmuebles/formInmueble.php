<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Añadir Nuevo [Nombre de Entidad]</h1>
        <a href="<?= base_url('panel/gestion' . $entidad) ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Registro</h6>
        </div>
        <div class="card-body">
            <form id="formCrear<?= $entidad ?>" novalidate>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="campo1" class="form-label font-weight-bold">Dato Principal</label>
                        <input type="text" class="form-control" id="campo1" name="campo1" placeholder="Ingrese el nombre..." required>
                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="campo2" class="form-label font-weight-bold">Dato Secundario</label>
                        <input type="text" class="form-control" id="campo2" name="campo2" placeholder="Ingrese detalle...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="selector" class="form-label font-weight-bold">Categoría / Tipo</label>
                        <select class="form-control" id="selector" name="selector">
                            <option value="" selected disabled>Seleccione una opción...</option>
                            <option value="1">Opción A</option>
                            <option value="2">Opción B</option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <button type="reset" class="btn btn-light">Limpiar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> Guardar Registro
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>