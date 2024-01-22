<?php echo $this->extend('partials/layout'); ?>

<?php echo $this->section('titulo'); ?>
Editar usuario - <?php echo $usuario->nombre; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('contenido'); ?>

<section class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow bg-gray py-3 px-4">
                <form class="card-body needs-validation" novalidate="" id="fmVacante" action="<?php echo base_url('usuarios/actualizar/' .  $usuario->id_usuario); ?>" method="POST">

                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario; ?>">
                    <h1 class="text-center mb-5">Editar usuario</h1>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $usuario->nombre; ?>">
                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            </div>

                            <?php if (validation_show_error('nombre')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('nombre'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $usuario->apellidos; ?>">
                                <label for="apellido">Apellidos <span class="text-danger">*</span></label>
                            </div>

                            <?php if (validation_show_error('apellido')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('apellido'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input class="form-control" type="email" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" value="<?php echo $usuario->correo_electronico; ?>">
                                <label for="correo_electronico">Correo electrónico <span class="text-danger">*</span></label>
                            </div>
                            <?php if (validation_show_error('correo_electronico')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('correo_electronico'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input class="form-control" type="tel" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $usuario->telefono; ?>">
                                <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            </div>
                            <?php if (validation_show_error('telefono')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('telefono'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select name="sexo" id="sexo" class="form-select">
                                    <option value="" selected disabled>-- Seleccione una opción --</option>
                                    <option value="M" <?= ($usuario->sexo == 'M') ? 'selected' : '' ?>>Masculino</option>
                                    <option value="F" <?= ($usuario->sexo == 'F') ? 'selected' : '' ?>>Femenino</option>
                                </select>
                                </select>
                                <label for="sexo">Sexo <span class="text-danger">*</span></label>
                            </div>

                            <?php if (validation_show_error('sexo')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('sexo'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input class="form-control" type="text" name="codigo_postal" id="codigo_postal" placeholder="Código Postal" value="<?php echo $usuario->cp; ?>" title="Ingrese un código postal de 5 dígitos">
                                <label for="codigo_postal">Código Postal <span class="text-danger">*</span></label>
                                <a id="consultarBtn" class="btn btn-info btn-sm m-1" href="#">Consultar</a>
                            </div>

                            <?php if (validation_show_error('codigo_postal')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    <strong> <small><?php echo validation_show_error('codigo_postal'); ?></small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select id="colonia" disabled class="form-select" name="colonia">

                                    <option value="<?php $usuario->colonia ?>" selected><?php echo $usuario->colonia ?></option>

                                </select>
                                <label for="colonia">Colonia <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input class="form-control" type="text" name="municipio" id="municipio" placeholder="Delegación/Municipio" readonly value="<?php echo $usuario->municipio; ?>">
                                <label for="municipio">Delegación/Municipio <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado" readonly value="<?php echo $usuario->estado; ?>">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" name="tipo_usuario" id="tipo_usuario" required="">
                                    <option value="" disabled selected>-- Seleccione un tipo de usuario --</option>
                                    <?php foreach ($tipos_usuarios as $tipo_usuario) : ?>
                                        <option value="<?= $tipo_usuario->id_tipo_usuario; ?>" <?= ($usuario->id_tipo_usuario == $tipo_usuario->id_tipo_usuario) ? 'selected' : '' ?>>
                                            <?= $tipo_usuario->tipo_usuario; ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <label for="tipo_usuario">Tipo de usuario<span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 row justify-content-center">
                        <div class="col-md-3 text-center pt-2">
                            <div class="d-grid gap-2">
                                <button class="btn btn-secondary text-white" type="submit">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo base_url('js/apiCopomex.js'); ?>"></script>

<?php echo $this->endSection(); ?>