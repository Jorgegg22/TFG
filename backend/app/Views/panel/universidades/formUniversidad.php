<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($universidad) ? 'Editar Universidad' : 'Añadir Nueva Universidad' ?></h1>
        <a href="<?= base_url('admin/universidades') ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow mb-4">
        <?php if(session('errores')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach(session('errores') as $error): ?>
                <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Registro</h6>
        </div>
        <div class="card-body">
            <form class="form-reset" action="<?= base_url('admin/universidades/guardar') ?>" method="POST">
                
                <?php if(isset($universidad)): ?>
                    <input type="hidden" name="id" value="<?= $universidad['id'] ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="nombre" class="form-label font-weight-bold">Nombre de la Universidad</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?= $universidad['nombre'] ?? '' ?>" placeholder="Ej: Universidad de Valencia..." required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="siglas" class="form-label font-weight-bold">Siglas</label>
                        <input type="text" class="form-control" id="siglas" name="siglas"
                            value="<?= $universidad['siglas'] ?? '' ?>" placeholder="Ej: UV">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="ciudad" class="form-label font-weight-bold">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad"
                            value="<?= $universidad['ciudad'] ?? '' ?>" placeholder="Ingrese la ciudad...">
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <button type="button" class="btn btn-light btn-reset">Limpiar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> <?= isset($universidad) ? 'Actualizar' : 'Guardar' ?> Registro
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>