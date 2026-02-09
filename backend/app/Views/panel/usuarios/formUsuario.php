<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($usuario) ? 'Editar Usuario' : 'Añadir Nuevo Usuario' ?></h1>
        <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Registro</h6>
        </div>
        <div class="card-body">
            <form class="form-reset" action="<?= base_url('admin/usuarios/guardar') ?>" method="POST" enctype="multipart/form-data">
                
                <?php if(isset($usuario)): ?>
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label font-weight-bold">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?= $usuario['nombre'] ?? '' ?>" placeholder="Ingrese el nombre..." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $usuario['email'] ?? '' ?>" placeholder="ejemplo@correo.com" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label font-weight-bold">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono"
                            value="<?= $usuario['telefono'] ?? '' ?>" placeholder="Número de contacto...">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="rol" class="form-label font-weight-bold">Rol de Usuario</label>
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="" disabled <?= !isset($usuario) ? 'selected' : '' ?>>Seleccione un rol...</option>
                            <option value="admin" <?= (isset($usuario) && $usuario['rol'] == 'admin') ? 'selected' : '' ?>>Administrador</option>
                            <option value="estudiante" <?= (isset($usuario) && $usuario['rol'] == 'estudiante') ? 'selected' : '' ?>>Estudiante</option>
                            <option value="propietario" <?= (isset($usuario) && $usuario['rol'] == 'propietario') ? 'selected' : '' ?>>Propietario</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label font-weight-bold">
                            Contraseña <?= isset($usuario) ? '<small class="text-muted">(Dejar en blanco para no cambiar)</small>' : '' ?>
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Mínimo 8 caracteres..." <?= isset($usuario) ? '' : 'required' ?>>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto_perfil" class="form-label font-weight-bold">Foto de Perfil (URL)</label>
                        <input type="text" class="form-control" id="foto_perfil" name="foto_perfil"
                            value="<?= $usuario['foto_perfil'] ?? '' ?>" placeholder="Ruta de la imagen...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="universidad_id" class="form-label font-weight-bold">Universidad</label>
                        <select class="form-control" id="universidad_id" name="universidad_id">
                            <option value="" <?= !isset($usuario['universidad_id']) ? 'selected' : '' ?>>Ninguna / No aplica</option>
                            <?php foreach($universidades as $uni): ?>
                                <option value="<?= $uni['id'] ?>" <?= (isset($usuario) && $usuario['universidad_id'] == $uni['id']) ? 'selected' : '' ?>>
                                    <?= $uni['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="id_carreara" class="form-label font-weight-bold">Carrera</label>
                        <select class="form-control" id="id_carreara" name="id_carreara">
                            <option value="" <?= !isset($usuario['id_carrera']) ? 'selected' : '' ?>>Ninguna / No aplica</option>
                            <?php foreach($carreras as $car): ?>
                                <option value="<?= $car['id'] ?>" <?= (isset($usuario) && $usuario['id_carrera'] == $car['id']) ? 'selected' : '' ?>>
                                    <?= $car['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="descripcion" class="form-label font-weight-bold">Biografía / Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                            placeholder="Cuéntanos algo sobre el usuario..."><?= $usuario['descripcion'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="link_instagram" class="form-label font-weight-bold"><i class="fab fa-instagram"></i> Instagram</label>
                        <input type="text" class="form-control" id="link_instagram" name="link_instagram"
                            value="<?= $usuario['link_instagram'] ?? '' ?>" placeholder="@usuario">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="link_x" class="form-label font-weight-bold"><i class="fab fa-twitter"></i> X (Twitter)</label>
                        <input type="text" class="form-control" id="link_x" name="link_x"
                            value="<?= $usuario['link_x'] ?? '' ?>" placeholder="@usuario">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="link_spotify" class="form-label font-weight-bold"><i class="fab fa-spotify"></i> Spotify</label>
                        <input type="text" class="form-control" id="link_spotify" name="link_spotify"
                            value="<?= $usuario['link_spotify'] ?? '' ?>" placeholder="Link a perfil">
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <button type="button" class="btn btn-light btn-reset">Limpiar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> <?= isset($usuario) ? 'Actualizar' : 'Guardar' ?> Registro
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>