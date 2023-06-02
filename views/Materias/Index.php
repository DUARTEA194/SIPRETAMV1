<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0">Lista de Materias</h1>
    <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
        <div>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#ModalCargaMasiva" onclick="AgregarMateria()"><i class="fas fa-fw fa-plus "></i> Importar registros</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#ModalRegistroMateria" onclick="AgregarMateria()"><i class="fas fa-fw fa-plus "></i> Agregar materia</a>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tasks"></i> Operaciones
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive-xl">
            <table class="table table-striped table-sm" id="TablaMaterias">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Grupo</th>
                        <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
                            <th scope="col" style="min-width:150px" data-name='Acciones'>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal de registro-->

<div class="modal fade" id="ModalRegistroMateria" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Registrar nueva Materia</h5>
                <button class="close" id="ButtonClose" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="FormularioRegistroMateria" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="InputIdMateria" name="InputIdMateria">

                    <div class="position-relative mb-3">
                        <label class="mb-0" for="InputClaveMateria">Clave</label>
                        <input class="form-control form-control-sm" type="text" id="InputClaveMateria" placeholder="Clave" name="InputClaveMateria" required>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="mb-0" for="InputNombreMateria">Nombre</label>
                        <input class="form-control form-control-sm" type="text" id="InputNombreMateria" placeholder="Nombre" name="InputNombreMateria" required>
                        <div id="lista-resultados"></div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="mb-0" for="InputProfesor">Profesor</label>
                        <input class="form-control form-control-sm" type="text" id="InputProfesor" placeholder="Profesor" name="InputProfesor" required>
                    </div>

                    <div class="position-relative mb-3" id="ContenedorGrupo">
                        <label class="mb-0" for="InputGrupo">Grupo</label>
                        <select name="InputGrupo" id="InputGrupo" class="form-select form-select-lg col-12" required>
                            <option value="" disabled selected hidden>Seleccione un grupo</option>
                            <option value="1">C001</option>
                            <option value="2">C002</option>
                            <option value="3">C003</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ButtonCancel" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="ButtonAgregarMateria">Agregar</button>
                    <button type="submit" class="btn btn-info d-none" id="ButtonEditarMateria">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del Modal de registro-->



<div class="modal fade" tabindex="-1" id="ModalCargaMasiva">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col border p-0 rounded">
                        <input class="form-control-file form-control-sm p-1" type="file" id="csv-file-input">
                    </div>
                    <div class="col-2">
                    <button class="btn btn-sm btn-success" id="load-csv-button">Cargar CSV</button>
                    <button class="btn btn-sm btn-danger d-none" id="BtnLimpiarCargaMasiva">Limpiar</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="csv-table" class="table table-sm">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Nombre</th>
                                <th>Profesor</th>
                                <th>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>