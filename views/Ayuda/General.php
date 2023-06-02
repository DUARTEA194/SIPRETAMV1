<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0">Ayuda a usuario</h1>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Acerca de</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Preguntas frecuentes</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card mb-2">
            <div class="card-body p-0">
                <div class="tab-content">
                    <div id="opcion1" class="tab-pane fade show active">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="card-title">General</h5>
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Manual de usuario
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">

                                                <p class="text-justify">
                                                    <b>Ingreso al sistema al Sistema</b><br>
                                                    El ingreso al sistema se lleva a cabo a través del formulario de ingreso el cual se encuentra disponible en la liga <a href="http://localhost:3000/">http://sipretam/LoginRegistro.php.</a>
                                                </p>
                                                <p class="text-justify"><b>¡Importante!</b><br>
                                                    El ingreso al sistema puede ser desde cualquier navegador, y también está desarrollado para
                                                    que se pueda ingresar desde diferentes dispositivos móviles. Para poder hacer uso del
                                                    sistema el usuario debe de estar familiarizado con aspectos básicos como: <br>
                                                    • uso de mouse <br>
                                                    • manejo de ventanas (abrir, cerrar, etc.). <br>
                                                    • Uso de botones <br>
                                                    Además de ello el usuario debe de estar previamente registrado en el sistema (ver. registro
                                                    en el sistema).</p>
                                                <p class="text-justify">En el caso de que un usuario intente
                                                    ingresar al sistema sin contar con un
                                                    registro previo, el sistema negará su
                                                    ingreso y mandará la siguiente alerta.
                                                    Para el caso en que un usuario intente
                                                    ingresar y se equivoque o ingrese datos
                                                    erróneos, el sistema mostrará la misma
                                                    alerta.
                                                    Una vez que el usuario ingrese se
                                                    mostrará el formulario de ingreso
                                                    (imagen.1) en el cual debe de colocar sus datos de usuario en los inputs de texto.
                                                </p>
                                                <p class="text-justify">
                                                    <b>Campo de usuario:</b> Se trata de un input de
                                                    tipo email en el cual el usuario debe de
                                                    ingresar su usuario. Nota: En el sistema, el
                                                    nombre de usuario corresponde al correo
                                                    institucional del usuario. <br>
                                                    <b>Campo contraseña:</b> Se trata de un input
                                                    de tipo password en el cual el usuario debe
                                                    de ingresar su contraseña. Nota: En el
                                                    sistema, la contraseña corresponde al
                                                    número de cuenta del usuario.
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                Some placeholder content for the second accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="opcion2" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Preguntas frecuentes</h4>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div id="opcion3" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Acerca de</h4>
                                <hr>
                                <div>
                                    <h5 class="text-center">Aviso de privacidad</h5>
                                    <hr>
                                    <h5 class="text-center">Aviso de terceros</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card mb-2">
            <div class="card-body p-0">
                <div class="tab-content">
                    <div id="opcion1" class="tab-pane fade show active">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="card-title">Acerca de</h5>
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Manual de usuario
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">

                                                <p class="text-justify">
                                                    <b>Ingreso al sistema al Sistema</b><br>
                                                    El ingreso al sistema se lleva a cabo a través del formulario de ingreso el cual se encuentra disponible en la liga <a href="http://localhost:3000/">http://sipretam/LoginRegistro.php.</a>
                                                </p>
                                                <p class="text-justify"><b>¡Importante!</b><br>
                                                    El ingreso al sistema puede ser desde cualquier navegador, y también está desarrollado para
                                                    que se pueda ingresar desde diferentes dispositivos móviles. Para poder hacer uso del
                                                    sistema el usuario debe de estar familiarizado con aspectos básicos como: <br>
                                                    • uso de mouse <br>
                                                    • manejo de ventanas (abrir, cerrar, etc.). <br>
                                                    • Uso de botones <br>
                                                    Además de ello el usuario debe de estar previamente registrado en el sistema (ver. registro
                                                    en el sistema).</p>
                                                <p class="text-justify">En el caso de que un usuario intente
                                                    ingresar al sistema sin contar con un
                                                    registro previo, el sistema negará su
                                                    ingreso y mandará la siguiente alerta.
                                                    Para el caso en que un usuario intente
                                                    ingresar y se equivoque o ingrese datos
                                                    erróneos, el sistema mostrará la misma
                                                    alerta.
                                                    Una vez que el usuario ingrese se
                                                    mostrará el formulario de ingreso
                                                    (imagen.1) en el cual debe de colocar sus datos de usuario en los inputs de texto.
                                                </p>
                                                <p class="text-justify">
                                                    <b>Campo de usuario:</b> Se trata de un input de
                                                    tipo email en el cual el usuario debe de
                                                    ingresar su usuario. Nota: En el sistema, el
                                                    nombre de usuario corresponde al correo
                                                    institucional del usuario. <br>
                                                    <b>Campo contraseña:</b> Se trata de un input
                                                    de tipo password en el cual el usuario debe
                                                    de ingresar su contraseña. Nota: En el
                                                    sistema, la contraseña corresponde al
                                                    número de cuenta del usuario.
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                Some placeholder content for the second accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="opcion2" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Preguntas frecuentes</h4>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div id="opcion3" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Acerca de</h4>
                                <hr>
                                <div>
                                    <h5 class="text-center">Aviso de privacidad</h5>
                                    <hr>
                                    <h5 class="text-center">Aviso de terceros</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><div class="card mb-2">
            <div class="card-body p-0">
                <div class="tab-content">
                    <div id="opcion1" class="tab-pane fade show active">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="card-title">Preguntas frecuentes</h5>
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Manual de usuario
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">

                                                <p class="text-justify">
                                                    <b>Ingreso al sistema al Sistema</b><br>
                                                    El ingreso al sistema se lleva a cabo a través del formulario de ingreso el cual se encuentra disponible en la liga <a href="http://localhost:3000/">http://sipretam/LoginRegistro.php.</a>
                                                </p>
                                                <p class="text-justify"><b>¡Importante!</b><br>
                                                    El ingreso al sistema puede ser desde cualquier navegador, y también está desarrollado para
                                                    que se pueda ingresar desde diferentes dispositivos móviles. Para poder hacer uso del
                                                    sistema el usuario debe de estar familiarizado con aspectos básicos como: <br>
                                                    • uso de mouse <br>
                                                    • manejo de ventanas (abrir, cerrar, etc.). <br>
                                                    • Uso de botones <br>
                                                    Además de ello el usuario debe de estar previamente registrado en el sistema (ver. registro
                                                    en el sistema).</p>
                                                <p class="text-justify">En el caso de que un usuario intente
                                                    ingresar al sistema sin contar con un
                                                    registro previo, el sistema negará su
                                                    ingreso y mandará la siguiente alerta.
                                                    Para el caso en que un usuario intente
                                                    ingresar y se equivoque o ingrese datos
                                                    erróneos, el sistema mostrará la misma
                                                    alerta.
                                                    Una vez que el usuario ingrese se
                                                    mostrará el formulario de ingreso
                                                    (imagen.1) en el cual debe de colocar sus datos de usuario en los inputs de texto.
                                                </p>
                                                <p class="text-justify">
                                                    <b>Campo de usuario:</b> Se trata de un input de
                                                    tipo email en el cual el usuario debe de
                                                    ingresar su usuario. Nota: En el sistema, el
                                                    nombre de usuario corresponde al correo
                                                    institucional del usuario. <br>
                                                    <b>Campo contraseña:</b> Se trata de un input
                                                    de tipo password en el cual el usuario debe
                                                    de ingresar su contraseña. Nota: En el
                                                    sistema, la contraseña corresponde al
                                                    número de cuenta del usuario.
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                Some placeholder content for the second accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="opcion2" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Preguntas frecuentes</h4>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div id="opcion3" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Acerca de</h4>
                                <hr>
                                <div>
                                    <h5 class="text-center">Aviso de privacidad</h5>
                                    <hr>
                                    <h5 class="text-center">Aviso de terceros</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
</div>