<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Marvifet
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-html5-1.5.6/datatables.min.css"/>

  <style type="text/css">
    select.form-control:not([size]):not([multiple]) {
         height: 100% !important;
    }
    .form-control2 {
    background-color: #FFFFFF;
    border: 1px solid #DDDDDD;
    border-radius: 4px;
    color: #66615b;
    line-height: normal;
    font-size: 14px;
    -webkit-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    -moz-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    -o-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    -ms-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.form-control2 {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Marvifet
          <!-- <div class="logo-image-big">
            <img src="assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="?tk">
              <i class="fa fa-upload"></i>
              <p>Subir ticket</p>
            </a>
          </li>

         <!-- <li>
            <a href="?his">
              <i class="nc-icon nc-watch-time"></i>
              <p>Historial</p>
            </a>
          </li>
          <li>
            <a href="?qr">
              <i class="fa fa-qrcode"></i>
              <p>QR</p>
            </a>
          </li>
          <li>
            <a href="?config">
              <i class="fa fa-cogs"></i>
              <p>Configuracion</p>
            </a>
          </li>
          <!--<li>
            <a href="./notifications.html">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li>
            <a href="./tables.html">
              <i class="nc-icon nc-tile-56"></i>
              <p>Table List</p>
            </a>
          </li>
          <li>
            <a href="./typography.html">
              <i class="nc-icon nc-caps-small"></i>
              <p>Typography</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li>-->
        </ul>
      </div>
    </div>
<?php
      /*$host= $_SERVER["HTTP_HOST"];
      $url= $_SERVER["REQUEST_URI"];
      $urlexplode = explode("/", $host . $url);
      $clave = array_search('index.php', $urlexplode); 
      if(isset($urlexplode[$clave+1])){
          $modulo=$urlexplode[$clave+1];
          echo "<h1>" . $modulo.'/</h1><br>';

          switch ($modulo) {
            case 'usr':
              echo "sd";
              $pagina='clientes';
            break;
            case 'his':
            echo "aa";

              $pagina='his';
            break;
            default:
            echo "bbb";

              $pagina='inicio';
            echo "<h1>" . $modulo.$pagina.'</h1><br>';
          }
          require_once($pagina.'.html');
      }*/
      if(isset($_REQUEST['tk'])){
        include('ticket.html');
      }
      /*
      if(isset($_REQUEST['his'])){
        include('historial.html');
      }
      if(isset($_REQUEST['qr'])){
        include('qr.html');
      }
      if(isset($_REQUEST['config'])){
        include('config.html');
      }*/
      

    ?>
  

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
           <!-- <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>-->
            <div class="credits ml-auto">
              <span class="copyright" >
                 <a href="#" style="color:red" class="salir"><i class="fa fa-power-off"></i> Cerrar sesion</a>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script type="text/javascript" src="assets/js/sweet.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
  <script type="text/javascript" src="jsback/funciones_globales.js"></script>
  <script src="jsback/ticket.js"></script>
  <script src="jsback/consumos_ticket.js"></script>


</body>

</html>
