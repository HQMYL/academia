<?php 
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH .  'config/conexiones.php';

?>
<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarUsuario" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar usuario</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarUsuario">
          <div class="row">
            <div class="col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre">
            </div>

            <div class="col-md-6">
              <label>Apellidos</label>
              <input type="text" class="form-control form-control-sm" name="apellidos" placeholder="Apellidos">
            </div>

            <div class="col-md-6">
              <label>Dirección</label>
              <input type="text" class="form-control form-control-sm" name="dir" placeholder="Dirección">
            </div>

            <div class="col-md-6">
              <label>Correo</label>
              <input type="text" class="form-control form-control-sm" name="correo" placeholder="Correo">
            </div>

            <div class="col-md-6">
              <label>Teléfono</label>

              <input type="text" class="form-control form-control-sm" name="tel" placeholder="Teléfono">

            </div>

            <div class="col-md-6">
              <label>Móvil</label>
              <input type="text" class="form-control form-control-sm" name="movil" placeholder="Móvil">
            </div>

            <div class="col-md-6">
              <label>Usuario</label>
              <input type="text" class="form-control form-control-sm" name="user" id="user" placeholder="Usuario">
              <h3 id="comprobar"></h3>

            </div>

            <div class="col-md-6">
              <label>Contraseña</label>
              <input class="form-control form-control-sm" type="password" name="pass" id="pass1">
            </div>

            <div class="col-md-6">

              <label for="cat">Confirmar contraseña:</label>

              <input class="form-control form-control-sm" type="password" id="pass2">

              <div id="respuesta" style="display: none;">
                <h3>Las contraseñas introducidas no son iguales</h3>
              </div>
            </div>

            <div class="col-md-6">
              <label>Tipo de usuario</label>
              <select class="form-control form-control-sm" name="cmbrol">
                <option value="">Seleccione...</option>
                <?php
                $sth = $con->prepare("SELECT * FROM roles ");
                #$sth->bindParam(1, $usuario);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_rol"]; ?>"><?= $row["rol"]; ?></option>

                <?php }
                }
                ?>
              </select>

            </div>

            <div class="col-md-6">

              <label for="cat">Estado:</label>
              <select class="form-control form-control-sm" name="cmbestado">
                <option value="">Seleccione...</option>
                <?php
                $sth = $con->prepare("SELECT * FROM estados ");
                #$sth->bindParam(1, $usuario);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id"]; ?>"><?= $row["estado"]; ?></option>

                <?php }
                }
                ?>
              </select>

            </div>

            <div class="col-md-6">

              <label for="cat">Foto de perfil:</label>

              <input class="form-control form-control-sm" type="file" name="archivo">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregarusuario"></div>
        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>-->

              <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregarusuario" value="Guardar" />
              </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarUsuario" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar usuario</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarUsuario">
          <div class="row">
            <div class="col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombre">
            </div>

            <div class="col-md-6">
              <label>Apellidos</label>
              <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" placeholder="Apellidos">
            </div>

            <div class="col-md-6">
              <label>Dirección</label>
              <input type="text" class="form-control form-control-sm" name="dir" id="dir" placeholder="Dirección">
            </div>

            <div class="col-md-6">
              <label>Correo</label>
              <input type="text" class="form-control form-control-sm" name="correo" id="correo" placeholder="Correo">
            </div>

            <div class="col-md-6">
              <label>Teléfono</label>

              <input type="text" class="form-control form-control-sm" name="tel" id="tel" placeholder="Teléfono">

            </div>

            <div class="col-md-6">
              <label>Móvil</label>
              <input type="text" class="form-control form-control-sm" name="movil" id="movil" placeholder="Móvil">
            </div>

            <div class="col-md-6">
              <label>Usuario</label>
              <input type="text" class="form-control form-control-sm" name="user" id="user2" placeholder="Usuario">
              <h3 id="comprobar"></h3>

            </div>

            <div class="col-md-6">
              <label>Contraseña</label>
              <input class="form-control form-control-sm" type="hidden" name="pass" id="pass0">
              <input class="form-control form-control-sm" type="password" name="pass11" id="pass11">
            </div>

            <div class="col-md-6">

              <label for="cat">Confirmar contraseña:</label>

              <input class="form-control form-control-sm" type="password" id="pass12">

              <div id="respuesta2" style="display: none;">
                <h3>Las contraseñas introducidas no son iguales</h3>
              </div>
            </div>

            <div class="col-md-6">
              <label>Tipo de usuario</label>
              <select class="form-control form-control-sm" name="cmbrol" id="cmbrol">
                <option value="">Seleccione...</option>
                <?php
                $sth = $con->prepare("SELECT * FROM roles ");
                #$sth->bindParam(1, $usuario);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_rol"]; ?>"><?= $row["rol"]; ?></option>

                <?php }
                }
                ?>
              </select>

            </div>

            <div class="col-md-6">

              <label for="cat">Estado:</label>
              <select class="form-control form-control-sm" name="cmbestado" id="cmbestado">
                <option value="">Seleccione...</option>
                <?php
                $sth = $con->prepare("SELECT * FROM estados ");
                #$sth->bindParam(1, $usuario);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id"]; ?>"><?= $row["estado"]; ?></option>

                <?php }
                }
                ?>
              </select>

            </div>
            <div class="col-md-6">

              <label for="cat">Foto de perfil actual:</label>
              <img src="" id="img" width="150" ; height="150" ;>
            </div>
            <div class="col-md-6">

              <label for="cat">Foto de perfil:</label>

              <input class="form-control form-control-sm" type="file" name="archivo">
              <img src="" name="imagen_actual" id="imagen_actual">
              <input class="form-control form-control-sm" type="hidden" name="id" id="id_usuario">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarusuario"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarusuario" value="Actualizar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarCurso" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar curso</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarCurso">
          <div class="row">
            <div class="col-md-6">
              <label>Curso</label>
              <input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre">
            </div>

            <div class="col-md-6">
              <label>Descripción</label>
              <textarea class="form-control form-control-sm" name="descripcion" cols="5"></textarea>

            </div>

            <div class="col-md-6">
              <label>Duración</label>
              <input type="text" class="form-control form-control-sm" name="duracion" placeholder="Duración">
            </div>

            <div class="col-md-6">
              <label>Profesor asignado</label>
              <select class="form-control form-control-sm" name="cmbusuario">
                <option value="">Seleccione...</option>
                <?php
                $asesor = "";
                $asesor = "2";
                $sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
                $sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?></option>

                <?php }
                }
                ?>
              </select><br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregarcurso"></div>
        

      </div>
      <div class="modal-footer">
         <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregarcurso" value="Guardar" />
         </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarCurso" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar curso</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarCurso">
          <div class="row">
            <div class="col-md-6">
              <label>Curso</label>
              <input type="text" class="form-control form-control-sm" name="nombre" id="nombre_curso" placeholder="Nombre">
            </div>

            <div class="col-md-6">
              <label>Descripción</label>
              <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="5"></textarea>

            </div>

            <div class="col-md-6">
              <label>Duración</label>
              <input type="text" class="form-control form-control-sm" name="duracion" id="duracion" placeholder="Duración">
            </div>

            <div class="col-md-6">
              <label>Profesor asignado</label>
              <select class="form-control form-control-sm" name="asignado" id="asignado">
                <option value="">Seleccione...</option>
                <?php
                $asesor = "";
                $asesor = "2";
                $sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
                $sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?></option>

                <?php }
                }
                ?>
              </select>
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_curso">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarcurso"></div>
        

      </div>
      <div class="modal-footer">
          <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarcurso" value="Actualizar" />
          </form>
      </div>
    </div>

  </div>
</div>

<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarTipo" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar tipo de trabajo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarTipo">
          <div class="row">
            <div class="col-md-6">
              <label>Tipo de trabajo</label>
              <input type="text" class="form-control form-control-sm" name="tipo" placeholder="Tipo de trabajo">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregartipo"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregartipo" value="Guardar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarTipo" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar tipo de trabajo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarTipo">
          <div class="row">
            <div class="col-md-6">
              <label>Tipo de trabajo</label>
              <input type="text" class="form-control form-control-sm" name="tipo" id="tipo">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_tipo_trabajo">
              <br>
            </div>


          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizartipo"></div>
        

      </div>
      <div class="modal-footer">
       <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizartipo" value="Actualizar" />
       </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarMateria" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar materia</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarMateria">
          <div class="row">
            <div class="col-md-6">
              <label>Materia</label>
              <input type="text" class="form-control form-control-sm" name="materia" placeholder="Materia">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregarmateria"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregarmateria" value="Guardar" />
        </form>

      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarMateria" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar materia</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarMateria">
          <div class="row">
            <div class="col-md-6">
              <label>Materia</label>
              <input type="text" class="form-control form-control-sm" name="materia" id="materia">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_materia">
              <br>
            </div>


          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarmateria"></div>
        
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarmateria" value="Actualizar" />
        </form>

      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarNivel" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar nivel educativo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarNivel">
          <div class="row">
            <div class="col-md-6">
              <label>Nivel educativo</label>
              <input type="text" class="form-control form-control-sm" name="nivel" placeholder="Nivel educativo">
              <br>
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregarnivel"></div>
        

      </div>
      <div class="modal-footer">
       <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregarnivel" value="Guardar" />
       </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarNivel" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar nivel educativo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarNivel">
          <div class="row">
            <div class="col-md-6">
              <label>Nivel educativo</label>
              <input type="text" class="form-control form-control-sm" name="nivel" id="nivel">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_nivel">
              <br>
            </div>


          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarnivel"></div>

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarnivel" value="Actualizar" />
        </form>

      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalActualizarLogotipo" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar logotipo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarLogotipo">
          <div class="row">
            <div class="col-md-6">
              <label>Nueva foto</label>
              <input type="file" class="form-control form-control-sm" name="archivo">
              <input type="hidden" class="form-control form-control-sm" name="imagen_actual" id="imagen_actual">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_logotipo">
              <br>
            </div>


          </div> <!--FINAL ROW-->
          
          <div class="statusMsglogotipo"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnlogotipo" value="Actualizar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarSolicitud" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar solicitud</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarSolicitud">
          <div class="row">
            <div class="col-md-6">
              <label>Título</label>
              <input type="text" class="form-control form-control-sm" name="titulo" placeholder="Título">
            </div>

            <div class="col-md-6">
              <label>Nivel educativo</label>
              <select class="form-control form-control-sm" name="cmbnivel">
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM niveles_educativos ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_nivel"]; ?>"><?= $row["nivel_educativo"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Tipo de trabajo</label>
              <select class="form-control form-control-sm" name="cmbtipo">
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM tipos_trabajo ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_tipo_trabajo"]; ?>"><?= $row["tipo_trabajo"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Materia relacionada</label>
              <select class="form-control form-control-sm" name="cmbmateria">
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM materias ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_materia"]; ?>"><?= $row["materia"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Fecha límite</label>

              <input type="text" class="form-control form-control-sm" name="fecha" id="fecha">

            </div>

            <div class="col-md-6">
              <label>Descripción</label>
              <textarea class="form-control form-control-sm" name="descripcion" cols="8">
  Descripción
</textarea>
              <input type="hidden" class="form-control form-control-sm" name="id_estudiante" value="<?= $usuario_id; ?>">
            </div>

            <div class="col-md-6">
              <label>Documentos</label>
              <div class="field_wrapper">
                <div>

                  <input type="file" class="form-control form-sm pdf" name="archivo[]">
                  <a href="javascript:void(0);" class="agregar_documento" title="Add field"> <img src="assets/dashboard/dist/img/iconos/add-icon.png" /></a>
                </div>
              </div>

            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregarsolicitud"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregarsolicitud" value="Guardar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarSolicitud" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar solicitud</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarSolicitud">
          <div class="row">
            <h2 id="titulo_cotizacion2"></h2>
            <div class="col-md-12">
    <div class="col-md-6">
     <?php 
   if ($rol == "2") 
    { ?>
     <button type="button" class="btn btn-success enviar_cotizacion">Enviar cotización</button>
   <?php }
  ?> 
    </div>
  </div>
            <div class="col-md-6">
              <label>Título</label>
              <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" <?php $resultado = $rol == "2" ? "readonly" : ""; ?> <?= $resultado; ?>>
            </div>
            <?php 
            if ($rol != "3") 
              { ?>
              <div class="col-md-6">
              <label>Asesor</label>
              <select class="form-control form-control-sm" name="cmbasesor" id="cmbprof2">
                <option value="">Seleccione...</option>
                <?php
                $asesor = "2";
                $sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ?");
                $sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>
            <?php }
            ?>
            

            <div class="col-md-6">
              <label>Nivel educativo</label>
              <select class="form-control form-control-sm" name="cmbnivel" id="cmbnivel" <?php $resultado = $rol == "2" ? "disabled" : ""; ?> <?= $resultado; ?>>
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM niveles_educativos ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_nivel"]; ?>"><?= $row["nivel_educativo"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Tipo de trabajo</label>
              <select class="form-control form-control-sm" name="cmbtipo" id="cmbtipo" <?php $resultado = $rol == "2" ? "disabled" : ""; ?> <?= $resultado; ?>>
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM tipos_trabajo ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_tipo_trabajo"]; ?>"><?= $row["tipo_trabajo"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Materia relacionada</label>
              <select class="form-control form-control-sm" name="cmbmateria" id="cmbmateria" <?php $resultado = $rol == "2" ? "disabled" : ""; ?> <?= $resultado; ?>>
                <option value="">Seleccione...</option>
                <?php

                $sth = $con->prepare("SELECT * FROM materias ");
                #$sth->bindParam(1, $asesor);
                $sth->execute();

                if ($sth->rowCount() > 0) {

                  foreach ($sth as $row) { ?>

                    <option value="<?= $row["id_materia"]; ?>"><?= $row["materia"]; ?></option>

                <?php }
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Fecha límite</label>

              <input type="text" class="form-control form-control-sm" name="fecha" id="fecha_limite" <?php $resultado = $rol == "2" ? "readonly" : ""; ?> <?= $resultado; ?>>

            </div>

            <div class="col-md-6">
              <label>Descripción</label>
              <textarea class="form-control form-control-sm" name="descripcion" id="descripcion_solicitud" cols="8" <?php $resultado = $rol == "2" ? "readonly" : ""; ?> <?= $resultado; ?>>
  Descripción
</textarea><br>
              <input type="hidden" class="form-control form-control-sm" name="id_estudiante" id="id_estudiante">
              <input type="hidden" class="form-control form-control-sm" name="id_solicitud" id="id_solicitud">
            </div>



          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarsolicitud"></div>
        
        <div class="col-md-12">
          <br>
          <h3>Documentos</h3>
          <button type="button" class="btn btn-success add_archivo">Agregar archivo</button>
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Archivo</th>
        <th>Actualizar</th>
        <th>Eliminar</th>
                </tr>
              </thead>
              <tbody id="relleno">

              </tbody>
            </table>
          </div>

        </div>
      </div>
      <div class="modal-footer">
       <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarsolicitud" value="Actualizar" />
       </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->
<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregarArchivo" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Agregar archivo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormAgregarArchivo">
          <div class="row">
            <div class="col-md-6">
              <label>Archivo</label>
              <input type="file" class="form-control form-control-sm pdf" name="archivo">

              <input type="hidden" class="form-control form-control-sm" name="id" id="id_archivo_solicitud">
            </div>


          </div> <!--FINAL ROW-->
          
          <div class="statusMsgagregararchivo"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnagregararchivo" value="Guardar" />
         </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->
<!-- Modal 1 -->
<div class="modal fade" id="myModalActualizarArchivo" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Actualizar archivo</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarArchivo">
          <div class="row">
            <div class="col-md-6">
              <label>Archivo</label>
              <input type="file" class="form-control form-control-sm pdf" name="archivo"><br>
              <input type="hidden" class="form-control form-control-sm" name="archivo_actual" id="archivo_actual_solicitud">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_sol">
            </div>

          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizararchivo"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizararchivo" value="Actualizar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 1 -->
<div class="modal fade" id="myModalEnviarCotizacion" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Enviar cotización</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormEnviarCotizacion">
          <div class="row">
            <div class="col-md-6">
              <label>Tiempo de entrega</label>
              <input type="text" class="form-control form-control-sm" name="tiempo_entrega">
                
            </div>
            <div class="col-md-6">
              <label>Costo total</label>
              <input type="text" class="form-control form-control-sm" name="costo_total" onkeypress="return validateFloatKeyPress(this,event);">
                
            </div>
            <div class="col-md-6">
              <label>Detalles de la cotización</label>
              <textarea class="form-control form-control-sm" name="detalles" cols="8">
                
              </textarea>
              <input type="hidden" class="form-control form-control-sm" name="id_asesor" id="id_asesor_solicitud" value="<?= $usuario_id; ?>">
              <input type="hidden" class="form-control form-control-sm" name="id_estudiante" id="id_estudiante_solicitud">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_cotizacion_solicitud"><br>
            </div>
            
          </div> <!--FINAL ROW-->
          
          <div class="statusMsgenviarcotizacion"></div>
        

      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnenviarcotizacion" value="Enviar" />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal 2 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizarCotizacion" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337AFF;">
        <p class="modal-title" style="color: #fff;">Detalles cotización</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="fupFormActualizarCotizacion">
          <div class="row">
            <div class="col-md-12">
             <h2 id="titulo_cotizacion"></h2><br>
             <?php 
             if ($rol == "3") 
              { ?>
               <button type="button" class="btn btn-success aceptar_propuesta">Aceptar propuesta</button>
               <button type="button" class="btn btn-danger rechazar_propuesta">Rechazar propuesta</button>
             <?php }

             ?>
             <br>
             <button type="button" class="btn btn-success enviar_mensaje">Enviar mensaje</button>
             
                
             

                         </div>
            <div class="col-md-6">
              <label>Tiempo de entrega</label>
              <input type="text" class="form-control form-control-sm" name="tiempo_entrega" id="tiempo_entrega2" <?php $resultado = ($rol == "3") ? "readonly" : ""; ?> <?= $resultado; ?>>
                
            </div>
            <div class="col-md-6">
              <label>Costo total</label>
              <input type="text" class="form-control form-control-sm" name="costo_total" id="costo_total2" onkeypress="return validateFloatKeyPress(this,event);" <?php $resultado = ($rol == "3") ? "readonly" : ""; ?> <?= $resultado; ?>>
                
            </div>
            <div class="col-md-12">
              <label>Detalles de la cotización</label>
              <textarea class="form-control form-control-sm" name="detalles" id="detalles2" cols="8" <?php $resultado = ($rol == "3") ? "readonly" : ""; ?> <?= $resultado; ?>>
              </textarea>
            </div>

            <div class="col-md-12">
              <label>Detalles de parte del estudiante</label>
              <textarea class="form-control form-control-sm" name="detalles_estudiante" id="detalles_estudiante" cols="8" <?php $resultado = ($rol == "2") ? "readonly" : ""; ?> <?= $resultado; ?>>
                
              </textarea>
              <input type="hidden" class="form-control form-control-sm" name="titulo_cotizacion" id="titulo_cotizacion2">
              <input type="hidden" class="form-control form-control-sm" name="creador_id" id="creador_id">
              <input type="hidden" class="form-control form-control-sm" name="usuario_id" id="usuario_id_cotizacion">
              <input type="hidden" class="form-control form-control-sm" name="propuesta_id" id="propuesta_id_cotizacion">
              <input type="hidden" class="form-control form-control-sm" name="estado_cotizacion" id="estado_cotizacion">
              <input type="hidden" class="form-control form-control-sm" name="id" id="id_cotizacion_solicitud2"><br>
            </div>
            
          </div> <!--FINAL ROW-->
          
          <div class="statusMsgactualizarcotizacion"></div>
        

      </div>
      <div class="modal-footer">
       <input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnactualizarcotizacion" value="Enviar" />
       </form>
      </div>
    </div>

  </div>
</div>

<!-- Modal 1 -->
<!-- modales -->