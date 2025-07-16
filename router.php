<?php
require_once 'init.php';

// Obtén la URL limpia
$request = $_GET['url'] ?? '';

// Rutas personalizadas
switch ($request) {
    case 'iniciar-sesion':
        $title = "Iniciar sesión | AcademiaLink";
        require ROOT_PATH . 'pages/web/iniciar-sesion.php';
        break;

    case 'admin':
        $title = "Bienvenido | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/admin.php';
        break;

    case 'consultar-usuarios':
        $title = "Usuarios | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/consultar-usuarios.php';
        break;

        case 'update-usuario':
        $title = "Usuarios | AcademiaLink";
        require ROOT_PATH . 'controllers/update-usuario.php';
        break;

        case 'getUsuario':
        require ROOT_PATH . 'controllers/GetUsuarios.php';
        break;

        case 'consultar-cursos':
        $title = "Cursos | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/consultar-cursos.php';
        break;

        case 'comprobacion':
        $title = "Comprobar usuario | AcademiaLink";
        require ROOT_PATH . 'controllers/comprobacion.php';
        break;

        case 'listado-materias':
        $title = "Listado de materias | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/listado-materias.php';
        break;

        case 'niveles-educativos':
        $title = "Niveles educativos | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/niveles-educativos.php';
        break;

        case 'guardar-nivel-educativo':
        $title = "Niveles educativos | AcademiaLink";
        require ROOT_PATH . 'controllers/guardar-nivel-educativo.php';
        break;

        case 'update-nivel-educativo':
        $title = "Niveles educativos | AcademiaLink";
        require ROOT_PATH . 'controllers/update-nivel-educativo.php';
        break;

        case 'GetNiveles':
        $title = "Niveles educativos | AcademiaLink";
        require ROOT_PATH . 'controllers/GetNiveles.php';
        break;

        case 'eliminar-nivel-educativo':
        $title = "Niveles educativos | AcademiaLink";
        require ROOT_PATH . 'controllers/eliminar-nivel-educativo.php';
        break;

        case 'solicitudes':
        $title = "Solicitudes | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/solicitudes.php';
        break;

        case 'guardar-solicitud':
        $title = "Solicitudes | AcademiaLink";
        require ROOT_PATH . 'controllers/guardar-solicitud.php';
        break;

        case 'GetSolicitudes':
        $title = "Solicitudes | AcademiaLink";
        require ROOT_PATH . 'controllers/GetSolicitudes.php';
        break;

        case 'update-solicitud':
        $title = "Solicitudes | AcademiaLink";
        require ROOT_PATH . 'controllers/update-solicitud.php';
        break;

        case 'eliminar-solicitud':
        $title = "Solicitudes | AcademiaLink";
        require ROOT_PATH . 'controllers/eliminar-solicitud.php';
        break;

        case 'tipos-trabajo':
        $title = "Tipos de trabajo | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/tipos-trabajo.php';
        break;

        case 'guardar-tipo-trabajo':
        $title = "Tipos de trabajo | AcademiaLink";
        require ROOT_PATH . 'controllers/guardar-tipo-trabajo.php';
        break;

        case 'GetTiposTrabajo':
        $title = "Tipos de trabajo | AcademiaLink";
        require ROOT_PATH . 'controllers/GetTiposTrabajo.php';
        break;

        case 'update-tipo-trabajo':
        $title = "Tipos de trabajo | AcademiaLink";
        require ROOT_PATH . 'controllers/update-tipo-trabajo.php';
        break;

        case 'eliminar-tipo-trabajo':
        $title = "Tipos de trabajo | AcademiaLink";
        require ROOT_PATH . 'controllers/eliminar-tipo-trabajo.php';
        break;

        case 'administrar-logotipo':
        $title = "Usuarios | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/administrar-logotipo.php';
        break;

        case 'update-logotipo':
        $title = "logotipo | AcademiaLink";
        require ROOT_PATH . 'controllers/update-logotipo.php';
        break;

        case 'materias':
        $title = "Listado de materias | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/listado-materias.php';
        break;

        case 'GetMaterias':
        $title = "Filtros | AcademiaLink";
        require ROOT_PATH . 'controllers/GetMaterias.php';
        break;

        case 'guardar-materia':
        $title = "Filtros | AcademiaLink";
        require ROOT_PATH . 'controllers/guardar-materia.php';
        break;

        case 'update-materia':
        $title = "Actualizar materia | AcademiaLink";
        require ROOT_PATH . 'controllers/update-materia.php';
        break;

        case 'eliminar-materia':
        $title = "Eliminar materia | AcademiaLink";
        require ROOT_PATH . 'controllers/eliminar-materia.php';
        break;
        /*PARA CONTROLLERS */

        case 'guardar-usuario':
        require ROOT_PATH . 'controllers/guardar-usuario.php';
        break;

        case 'update-usuario':
        require ROOT_PATH . 'controllers/update-usuario.php';
        break;

        case 'eliminar-user':
        require ROOT_PATH . 'controllers/eliminar-user.php';
        break;

    case 'guardar-curso':
        require ROOT_PATH . 'controllers/guardar-curso.php';
        break;

    case 'eliminar-curso':
        require ROOT_PATH . 'controllers/eliminar-curso.php';
        break;

        case 'update-curso':
        require ROOT_PATH . 'controllers/update-curso.php';
        break;

    case 'getCurso':
        require ROOT_PATH . 'controllers/GetCursos.php';
        break;

        case 'mis-cursos':
        $title = "Mis cursos | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/mis-cursos.php';
        break;

        case 'agregar-archivo-solicitud':
        $title = "Agregar archivo | AcademiaLink";
        require ROOT_PATH . 'controllers/agregar-archivo-solicitud.php';
        break;

        case 'update-archivo-solicitud':
        $title = "Actualizar archivo | AcademiaLink";
        require ROOT_PATH . 'controllers/update-archivo-solicitud.php';
        break;

        case 'eliminar-archivo-solicitud':
        $title = "Eliminar archivo | AcademiaLink";
        require ROOT_PATH . 'controllers/eliminar-archivo-solicitud.php';
        break;

        case 'asignar-asesor':
        $title = "Asignar asesor | AcademiaLink";
        require ROOT_PATH . 'controllers/asignar-asesor.php';
        break;

        case 'GetSolicitudesEstudiante':
        $title = "Filtro de solicitudes | AcademiaLink";
        require ROOT_PATH . 'controllers/GetSolicitudesEstudiante.php';
        break;

        case 'enviar-cotizacion':
        $title = "enviar cotización | AcademiaLink";
        require ROOT_PATH . 'controllers/enviar-cotizacion.php';
        break;
        case 'cotizaciones':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/cotizaciones.php';
        break;

        case 'update-cotizacion':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/update-cotizacion.php';
        break;

        case 'cambiar-estado-notificacion':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/cambiar-estado-notificacion.php';
        break;
        case 'GetCotizaciones':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/GetCotizaciones.php';
        break;

        case 'GetCotizacionesEstudiante':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/GetCotizacionesEstudiante.php';
        break;
        case 'obtener-mensajes':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/obtener-mensajes.php';
        break;

        case 'registrar-mensaje':
        $title = "Cotizaciones | AcademiaLink";
        require ROOT_PATH . 'controllers/registrar-mensaje.php';
        break;
        case 'aceptar-propuesta':
        $title = "Aceptar propuesta | AcademiaLink";
        require ROOT_PATH . 'controllers/aceptar-propuesta.php';
        break;

        case 'rechazar-propuesta':
        $title = "Rechazar propuesta | AcademiaLink";
        require ROOT_PATH . 'controllers/rechazar-propuesta.php';
        break;

        case 'agregar-avance':
        $title = "Agregar avance | AcademiaLink";
        require ROOT_PATH . 'controllers/agregar-avance.php';
        break;

        case 'sala-chat':
        $title = "Sala de chats | AcademiaLink";
        require ROOT_PATH . 'pages/dashboard/sala-chat.php';
        break;

        
        case 'logout':
        $title = "Bienvenido | AcademiaLink";
        require ROOT_PATH . 'controllers/logout.php';
        break;


    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
