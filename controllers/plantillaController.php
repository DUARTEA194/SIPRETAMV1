<?php
class Plantilla{
    //pagina principal
    public function index()
    {
        include_once 'views/principal.php';
    }
    //pagina principal de alumnos
    public function indexAlumnos()
    {
        include_once 'views/usuarios/DashboardAlumnos.php';
    }
     //pagina Ayuda general
     public function general()
     {
         include_once 'views/Ayuda/General.php';
     }
     //pagina preguntas frecuentes
     public function preguntasFrecuentes()
     {
         include_once 'views/Ayuda/Preguntas.php';
     }
     //pagina preguntas acerca de 
     public function acerca_de()
     {
         include_once 'views/Ayuda/Acercade.php';
     }
    //pagina clientes
    public function clientes()
    {
        include_once 'views/clientes/index.php';
    }
    //pagina usuarios
    public function usuarios()
    {
        include_once 'views/usuarios/index.php';
    }
    //pagina perfil
    public function perfil()
    {
        include_once 'views/Perfil/Index.php';
    }
    //pagina Maquinas
    public function Maquinas()
    {
        include_once 'views/Maquinas/Index.php';
    }
    //pagina Maquinas
    public function Herramientas()
    {
        include_once 'views/Herramientas/Index.php';
    }
    //pagina Maquinas
    public function Prestamos()
    {
        include_once 'views/Prestamos/Historial.php';
    }
    //pagina Maquinas
    public function Nuevo_Prestamo()
    {
        include_once 'views/Prestamos/Index.php';
    }
    //pagina Materias
    public function Materias()
    {
        include_once 'views/Materias/Index.php';
    }
    //calendario
    public function Calendario()
    {
        include_once 'views/Calendario/Calendario.php';
    }
    //pagina configuracion
    public function configuracion()
    {
        include_once 'views/usuarios/configuracion.php';
    }
    //pagina ventas
    public function ventas()
    {
        include_once 'views/ventas/index.php';
    }
    //vista reporte ticket
    public function reporte()
    {
        include_once 'views/ventas/reporte.php';
    }
    //historial ventas
    public function historial()
    {
        include_once 'views/ventas/historial.php';
    }
    //##########productos
    public function productos()
    {
        include_once 'views/productos/index.php';
    }

    public function notFound()
    {
        include_once 'views/errors.php';
    }

    public function proveedor()
    {
        include_once 'views/proveedor/index.php';
    }
    public function NoDisponible(){
        include_once 'views/NoDisponible.php';
    }

    ###### compras
    public function compras()
    {
        include_once 'views/compras/index.php';
    }
    //vista reporte ticket
    public function reporte_compra()
    {
        include_once 'views/compras/reporte.php';
    }
    //historial ventas
    public function historial_compras()
    {
        include_once 'views/compras/historial.php';
    }

}
?>