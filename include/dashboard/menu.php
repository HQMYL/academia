<?php 
if ($rol == "1") 
{ ?>
  <li class="nav-item">
            <a href="<?= BASE_URL ?>consultar-usuarios" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>consultar-cursos" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cursos
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>solicitudes" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Solicitudes
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>tipos-trabajo" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Tipos de trabajo
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>listado-materias" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Materias
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>niveles-educativos" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Niveles educativos
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>administrar-logotipo" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Logotipo
                
              </p>
            </a>
          </li>
<?php }

elseif ($rol == "2") 
{ ?>
  <li class="nav-item">
            <a href="<?= BASE_URL ?>solicitudes" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Solicitudes
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>cotizaciones" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cotizaciones
                
              </p>
            </a>
          </li>
<?php }

elseif ($rol == "3") 
{ ?>
  <li class="nav-item">
            <a href="<?= BASE_URL ?>mis-cursos" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mis cursos
                
              </p>
            </a>
          </li>
  <li class="nav-item">
            <a href="<?= BASE_URL ?>solicitudes" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Solicitudes
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>cotizaciones" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cotizaciones
                
              </p>
            </a>
          </li>

<?php }
?>
