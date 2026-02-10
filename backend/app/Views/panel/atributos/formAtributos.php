<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Añadir Nuevo Atributo</h1>
        <a href="<?= base_url('admin/atributos') ?>" class="btn btn-sm btn-secondary shadow-sm">
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
            <form class="form-reset" action="<?= base_url('admin/atributos/guardar') ?>" method="POST">

                <div class="row">


                    <?php if(isset($atributos)): ?>
                    <input type="hidden" name="id" value="<?= $atributos['id'] ?>">
                    <?php endif; ?>

                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label font-weight-bold">Nombre del Atributo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Pet Friendly"
                            value="<?= $atributos['nombre'] ?? '' ?>">
                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="d-flex ">
                            <span class="material-symbols-outlined">
                                <?= $atributos['icono'] ?? ''  ?> 
                            </span>
                            <label for="icono" class="form-label font-weight-bold d-flex justify-content-between  ml-2">
                                Icono (Material Icon)
                                <small><a href="https://fonts.google.com/icons?icon.set=Material+Icons" target="_blank"
                                        class="text-primary ml-5" >
                                        <i class="fas fa-external-link-alt"></i> Ver nombres aquí
                                    </a></small>
                            </label>
                        </div>


                        <input type="text" class="form-control" id="icono" name="icono" placeholder="Ej: pets..."
                            value="<?= $atributos['icono'] ?? '' ?>">


                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Debes copiar el nombre exacto en minúsculas (ej:
                            <code>hotel</code>).
                        </small>
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <button type="button" class="btn btn-light btn-reset">Limpiar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> Guardar Registro
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>