<?php
require_once __DIR__ . '/../../init.php'; // Subes dos niveles hasta raíz
require_once ROOT_PATH . 'include/web/header.php';
?>

<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><b>Sistema académico</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Ingresa tus credenciales</p>

                <form id="fupForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="user" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-block btn-rounded submitBtn" value="Ingresar" />

                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="statusMsg"></div>
                </form>

                <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.php">Olvidaste tu contraseña?</a>
                </p>
                <p class="mb-0">
                    <a href="registro.php" class="text-center">Registráte</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>
<?php
require_once ROOT_PATH . 'include/web/footer.php';
?>