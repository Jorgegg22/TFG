<style>
.custom-file-input:lang(es)~.custom-file-label::after {
    content: "Buscar";
}

.file-select-custom {
    border: 2px dashed #d1d3e2;
    border-radius: 10px;
    padding: 10px;
    transition: all 0.3s;
    background-color: #f8f9fc;
}

.file-select-custom:hover {
    border-color: #4e73df;
    background-color: #fff;
}

.img-preview-edit {
    height: 50px;
    border-radius: 5px;
    margin-top: 10px;
    border: 1px solid #ddd;
}
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($inmueble) ? 'Editar Inmueble' : 'Añadir Nuevo Inmueble' ?></h1>
        <a href="<?= base_url('admin/inmuebles') ?>" class="btn btn-sm btn-secondary shadow-sm">
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
            <form class="form-reset" action="<?= base_url('admin/inmuebles/guardar') ?>" method="POST"
                enctype="multipart/form-data">

                <?php if(isset($inmueble)): ?>
                <input type="hidden" name="id" value="<?= $inmueble['id'] ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="titulo" class="form-label font-weight-bold">Título del Inmueble</label>
                        <input type="text" class="form-control" id="titulo" name="titulo"
                            value="<?= $inmueble['titulo'] ?? '' ?>" placeholder="Ej: Piso luminoso..." >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label font-weight-bold">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                            value="<?= $inmueble['direccion'] ?? '' ?>" placeholder="Calle, número, piso...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="descripcion" class="form-label font-weight-bold">Descripción Detallada</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"
                            rows="3"><?= $inmueble['descripcion'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="precio" class="form-label font-weight-bold">Precio (€)</label>
                        <input type="number" class="form-control" id="precio" name="precio"
                            value="<?= $inmueble['precio'] ?? '' ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="metros" class="form-label font-weight-bold">Metros²</label>
                        <input type="number" class="form-control" id="metros" name="metros"
                            value="<?= $inmueble['metros'] ?? '' ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="habitaciones" class="form-label font-weight-bold">Hab.</label>
                        <input type="number" class="form-control" id="habitaciones" name="habitaciones"
                            value="<?= $inmueble['habitaciones'] ?? '' ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="banios" class="form-label font-weight-bold">Baños</label>
                        <input type="number" class="form-control" id="banios" name="banios"
                            value="<?= $inmueble['banios'] ?? '' ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="n_personas" class="form-label font-weight-bold">Plazas</label>
                        <input type="number" class="form-control" id="n_personas" name="n_personas"
                            value="<?= $inmueble['n_personas'] ?? '' ?>">
                    </div>
                </div>

               <div class="row">

    <!-- PROPIETARIOS -->
    <div class="col-md-6 mb-3">
        <label for="propietario_id" class="form-label font-weight-bold">
            Propietarios
        </label>

        <select class="form-control" id="propietario_id" name="propietario_id">
            <option value="" disabled
                <?= !isset($inmueble) ? 'selected' : '' ?>>
                Propietario del inmueble
            </option>

            <?php foreach($propietarios as $prop): ?>
                <option value="<?= $prop['id'] ?>"
                    <?= (isset($inmueble) && $inmueble['propietario_id'] == $prop['id']) ? 'selected' : '' ?>>
                    <?= $prop['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- UNIVERSIDADES -->
    <div class="col-md-6 mb-3">
        <label for="universidad_id" class="form-label font-weight-bold">
            Universidad Cercana
        </label>

        <select class="form-control" id="universidad_id" name="universidad_id">
            <option value="" disabled
                <?= !isset($inmueble) ? 'selected' : '' ?>>
                Seleccione una universidad...
            </option>

            <?php foreach($universidades as $uni): ?>
                <option value="<?= $uni['id'] ?>"
                    <?= (isset($inmueble) && $inmueble['universidad_id'] == $uni['id']) ? 'selected' : '' ?>>
                    <?= $uni['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

</div>


                <hr>
                <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-images mr-1"></i> Galería de Imágenes
                </h6>

                <div class="row">
                    <?php 
                    $fotos = ['imagen_principal', 'imagen1', 'imagen2', 'imagen3', 'imagen4'];
                    foreach($fotos as $index => $foto): 
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="file-select-custom text-center">
                            <label for="<?= $foto ?>"
                                class="form-label font-weight-bold small <?= $foto == 'imagen_principal' ? 'text-success' : 'text-gray-600' ?>">
                                <?= $foto == 'imagen_principal' ? '<i class="fas fa-star mr-1"></i> Principal' : 'Secundaria ' . $index ?>
                            </label>
                            <input type="file" class="form-control-file" id="<?= $foto ?>" name="<?= $foto ?>"
                                value=<?= $inmueble[$foto] ?? '' ?> accept="image/*">

                            <?php if(isset($inmueble) && !empty($inmueble[$foto])): ?>
                            <img src="<?= base_url('uploads/' . $inmueble[$foto]) ?>"
                                class="img-preview-edit d-block mx-auto">
                            <small class="text-muted d-block mt-1">Archivo actual</small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="col-md-4 mb-4 d-flex align-items-center">
                        <div class="p-3 bg-light border-left-info shadow-sm w-100"
                            style="border-left: 5px solid #36b9cc; border-radius: 5px;">
                            <div class="d-flex align-items-center small text-muted">
                                <i class="fas fa-info-circle text-info mr-2"></i>
                                <span>JPG/PNG máx. 2MB. Al subir una nueva, se reemplaza la anterior.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-light btn-reset">Limpiar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> <?= isset($inmueble) ? 'Actualizar' : 'Guardar' ?> Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>