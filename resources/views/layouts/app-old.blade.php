<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Black Shield | Application</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ asset('uploads/logo.jpg') }}" />
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/bootstrap/dist/css/bootstrap.min.css"> --}}
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/font-awesome/css/font-awesome.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('')}}bower_components/Ionicons/css/ionicons.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- View head -->
  @yield('head')

  <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/blackStyle.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('')}}dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('')}}dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/morris.js/morris.css"> --}}
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"> --}}
  <!-- jvectormap -->
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/jvectormap/jquery-jvectormap.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/1.2.2/jquery-jvectormap.min.css">
  <!-- Date Picker -->
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('')}}bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.css"> --}}
  <link rel="stylesheet" href="{{asset('')}}bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.print.min.css"> --}}
    <!-- Select2 -->
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/select2/dist/css/select2.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">

</head>

<style>
  #notification{
    position: absolute;
    right: 0;
    z-index: 5;
  }
  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }
  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #868282;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  /* Mark the active step: */
  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #00ce08;
  }

  .select2-selection__rendered li.select2-selection__choice{
    color: #464646 !important;
    background: #3C8DBC;
  }

  .select2-container--default .select2-selection--single{
    border-radius: 0;
    height: 20px;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <span class="logo-mini"><b>A</b>LT</span> --}}
      <span class="logo-mini"><b>BSS</b></span>
      <!-- logo for regular state and mobile devices -->
      {{-- <span class="logo-lg"><b>Admin</b>LTE</span> --}}
      <span class="logo-lg"><b>BLACK SHIELD </b>SECURITE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('')}}assets/img/logo.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->nom.' '.Auth::user()->prenoms}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('')}}assets/img/logo.png" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->nom.' '.Auth::user()->prenoms}} - Responsable de BSS
                  <small>Depuis Janvier 2013</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Deconnexion
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>

              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      <a href="{{route('planning.create')}}" class="btn bg-red text-bold text-uppercase" role="button" style="position:relative; transform:translateY(25%);">Planifier un agent</a>

      </div>
    </nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('')}}assets/img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->nom.' '.Auth::user()->prenoms}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Barre de navigation</li>
        <li class="{{Request::is('tableau-de-bord') ? 'active' : null}}">
          <a href="{{route('home')}}" >
            <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
          </a>
        </li>
        <li class="{{Request::is('gestion-des-agents/*') ? 'active' : null}} treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Gestion des Agents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::is("gestion-des-agents/ajouter-un-agent")) ? 'active' : null}}"><a href="{{route('ajout.agent')}}" {{-- onclick="getPage('{{route('agent.create')}}')" --}}><i class="fa fa-circle-o {{(Request::is('agents/ajouter/*')) ? 'text-aqua' : null}}"></i>Ajouter un agent</a></li>
            <li class="{{(Request::is('gestion-des-agents/registre-unique-du-personnel')) ? 'active' : null}}"><a href="{{route('agent.index')}}" {{-- onclick="getPage('{{route('agent.index')}}')" --}}><i class="fa fa-circle-o {{Request::is('agents') ? 'text-aqua' : null}}"></i>Registre Unique du Personnel</a></li>
          </ul>
        </li>
        <li class="treeview {{Request::is('gestion-des-absences/*') ? 'active' : null}}">
          <a href="#">
            <i class="fa fa-warning"></i>
            <span>Gestion des Absences</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::is('gestion-des-absences/enregistrer-une-absence/enregistrer')) ? 'active' : null}}"><a href="{{route('absence.ajout')}}"><i class="fa fa-circle-o {{Request::is('gestion-des-absences/enregistrer-une-absence/enregistrer') ? 'text-aqua' : null}}"></i>Enregistrer une absence</a></li>
            <li class="{{(Request::is('gestion-des-absences/liste-des-agents-absents')) ? 'active' : null}}"><a href="{{route('absence.index')}}"><i class="fa fa-circle-o {{Request::is('gestion-des-absences/liste-des-agents-absents') ? 'text-aqua' : null}}"></i>Liste des Agents absent</a></li>
          </ul>
        </li>
        <li class="treeview {{(Request::is('sites-de-deploiements*')) ? 'active' : null}}">
          <a href="#">
            <i class="fa fa-sitemap"></i>
            <span>Sites de Déploiements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::is('sites-de-deploiements/ajouter-un-site')) ? 'active' : null}}"><a href="{{route('site.create')}}" {{-- onclick="getPage('{{route('site.create')}}')" --}}><i class="fa fa-circle-o {{(Request::is('sites/ajouter')) ? 'text-aqua' : null}}"></i>Ajouter un site</a></li>
            <li class="{{(Request::is('sites-de-deploiements')) ? 'active' : null}}"><a {{-- onclick="getPage('{{route('site.index')}}')" --}} href="{{route('site.index')}}"><i class="fa fa-circle-o {{Request::is('sites') ? 'text-aqua' : null}}"></i> Liste des sites</a></li>
            <li class="{{(Request::is('gestion-des-sites/liste-des-agents')) ? 'active' : null}}"><a {{-- onclick="getPage('{{route('site.index')}}')" --}} href="{{route('liste-site-agent')}}"><i class="fa fa-circle-o {{Request::is('gestion-des-sites/liste-des-agents') ? 'text-aqua' : null}}"></i> Agents déployés</a></li>
          </ul>
        </li>
        <li class="treeview {{Request::is('planification-des-agents/*') ? 'active' : null}}">
          <a href="#">
            <i class="fa fa-street-view"></i>
            <span>Planification Agent</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::is('planification-des-agents/plannings-provisoires/planifier-un-agent')) ? 'active' : null}}"><a href="{{route('planning.create')}}" {{-- onclick="getPage('{{route('planning.create')}}')" --}}><i class="fa fa-circle-o {{Request::is('planning/provisoires/creer') ? 'text-aqua' : null}}"></i>Planifier un Agent</a></li>

            {{-- <li class="{{(Request::is('planification-des-agents/plannings-provisoires')) ? 'active' : null}}"><a href="{{route('planning.index')}}"><i class="fa fa-circle-o {{Request::is('planning/provisoires') ? 'text-aqua' : null}}"></i>Plannings Provisoires (old)</a></li> --}}

            <li class="{{(Request::is('gestion-des-plannings/planning-provisoire')) ? 'active' : null}}"><a href="{{route('planning-provisoire')}}" {{-- onclick="getPage('{{route('planning.index')}}')" --}}><i class="fa fa-circle-o {{Request::is('gestion-des-plannings/planning-provisoire') ? 'text-aqua' : null}}"></i>Plannings Provisoires</a></li>

            {{--<li class="{{(Request::is('planification-des-agents/plannings-definitifs')) ? 'active' : null}}"><a href="{{route('planning.index_definitives')}}"><i class="fa fa-circle-o {{(Request::is('planning/definitifs')) ? 'text-aqua' : null}}"></i>Plannings Définitifs (old)</a></li>--}}

            <li class="{{(Request::is('gestion-des-plannings/planning-definitif')) ? 'active' : null}}"><a href="{{route('planning-definitif')}}" {{-- onclick="getPage('{{route('planning.index_definitives')}}')" --}}><i class="fa fa-circle-o {{(Request::is('gestion-des-plannings/planning-definitif')) ? 'text-aqua' : null}}"></i>Plannings Définitifs</a></li>

            <li class="{{(Request::is('gestion-des-plannings/plannings-archives')) ? 'active' : null}}"><a href="{{route('plannings-archives')}}" {{-- onclick="getPage('{{route('planning.index_archive')}}')" --}}><i class="fa fa-circle-o {{(Request::is('gestion-des-plannings/plannings-archives')) ? 'text-aqua' : null}}"></i>Plannings Archivés</a></li>

          </ul>
        </li>
          {{-- @if() --}}
        @if(Auth::user()->is_admin) 
        <li class="treeview {{Request::is('gestion-des-comptes/*') ? 'active' : null}}">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Gestion des comptes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::is('gestion-des-comptes/ajouter-un-admin')) ? 'active' : null}}"><a href="{{route('account.create')}}" {{-- onclick="getPage('{{route('planning.create')}}')" --}}><i class="fa fa-circle-o {{Request::is('gestion-des-comptes/adjouter-un-admin') ? 'text-aqua' : null}}"></i>Ajouter un compte </a></li>
            <li class="{{(Request::is('gestion-des-comptes/')) ? 'active' : null}}"><a href="{{route('account.list')}}" {{-- onclick="getPage('{{route('planning.create')}}')" --}}><i class="fa fa-circle-o {{Request::is('gestion-des-comptes/') ? 'text-aqua' : null}}"></i>Liste des utilisateurs</a></li>
            <li class="{{(Request::is('activite-des-comptes/')) ? 'active' : null}}"><a href="{{route('logactivity.list')}}" {{-- onclick="getPage('{{route('planning.create')}}')" --}}><i class="fa fa-circle-o {{Request::is('activite-des-comptes/') ? 'text-aqua' : null}}"></i>Historique des utilisateurs</a></li>
          </ul>
        </li>
        @endif 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="pageContent">
    @if (session()->has('notification'))
      {{-- <div class="container"> --}}
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Notification :</strong> {{ session()->get('notification') }}
        </div>
      {{-- </div> --}}
    @endif

      @yield('content')
      <!-- /.content-wrapper -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
      <!-- Delete modal -->

    <div class="modal modal-danger fade" id="modal-delete-element">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Supprimer un élément</h4>
          </div>
          <div class="modal-body">
            <p>Etes vous sûr de vouloir supprimer ce élément ? </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-outline btn-ok">Supprimer</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('')}}bower_components/jquery/dist/jquery.min.js"></script>
{{-- <script src="{{asset('')}}bower_components/jquery-ui/jquery-ui.js"></script> --}}
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('')}}bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> --}}
<!-- Bootstrap 3.3.7 -->
{{-- <script src="{{asset('')}}bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
{{-- <script src="{{asset('')}}bower_components/raphael/raphael.min.js"></script> --}}
{{-- <script src="{{asset('')}}bower_components/morris.js/morris.min.js"></script> --}}
<!-- Sparkline -->
{{-- <script src="{{asset('')}}bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> --}}
<!-- jvectormap -->
{{-- <script src="{{asset('')}}plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> --}}
{{-- <script src="{{asset('')}}plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{asset('')}}bower_components/jquery-knob/dist/jquery.knob.min.js"></script> --}}
<!-- daterangepicker -->
<script src="{{asset('')}}bower_components/moment/min/moment.min.js"></script>
<script src="{{asset('')}}bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
{{-- PRINCIPAL --}}
<script src="{{asset('')}}bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js"></script> --}}
<!-- Bootstrap WYSIHTML5 -->
{{-- <script src="{{asset('')}}plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> --}}
<!-- Slimscroll -->
<script src="{{asset('')}}bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('')}}bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('')}}dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('')}}dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('')}}dist/js/demo.js"></script>
{{-- <script src="{{asset('')}}bower_components/select2/dist/js/select2.full.min.js"></script> --}}

<!-- TimePicker -->
{{-- <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/timePicker.css"> --}}

{{-- <script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.js"></script>
<script src="{{asset('bower_components/fullcalendar/dist/locale-all.js')}}"></script>
{{-- cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

{{-- <script type="text/javascript" src="{{asset('')}}assets/js/jquery-timepicker.js"></script> --}}
<script type="text/javascript">
  $().ready(function(e) {
    $(".time-picker").hunterTimePicker();
  });
</script>

<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
  $(document).ready(function() {
    $('.select2').select2({
    tags: true,
    tokenSeparators: [',', ' ']
});
  });
</script>
<script type="text/javascript">

  $('#modal-delete-element').on('show.bs.modal', function(e) {
      // $(this).find('.btn-ok').attr('onClick', $(e.relatedTarget).data('href'));
      $(this).find('.btn-ok').attr('onClick', "deleteElement('"+$(e.relatedTarget).data('link')+"','"+$(e.relatedTarget).data('div_refresh')+"')");
  });
  //Supprimer un élément
  function deleteElement(link,div_refresh){
    $('#modal-delete-element').modal('hide')
    //Supprimer un planning
    $.ajax({
        url: link,
        data: {
        "_token": "{{ csrf_token() }}",
        // "id":  planning_id
        },
        type: "DELETE",
        beforeSend: function(){
          $("div.close").show()
        },
        success: function (data) {
          // alert(data.new_content)
          $('#'+div_refresh).html(data.new_content)
        },
        error:function(){
          $("div.close").hide()
          alert("Echec")
        }
    });
  }
</script>

<script type="text/javascript">
  function getPage(link){
    // alert($(this).attr('onclick'))
    // e.preventDefault()
    $.ajax({
        url: link,
        type    : 'GET',
        // data    : {
        //   "id":  planning_id,
        // },
        // dataType: 'json',
        success: function (data) {
          // alert('Succes')
          $('head').append(data.content.head);
          $('body').append(data.content.script);
          $('#pageContent').html(data.content.content);
          // $('.main-sidebar').load();
          // initCalendar()
        },
        error:function(xhr){
          alert("Echec")
        }
    });
  }

</script>

<script type="text/javascript">
  function submitForm(form_id){
    form=$("#"+form_id)
    $.ajax({
        url:    form.attr('action'),
        type    : form.attr('method'),
        data    : form.serialize(),
        success: function (data) {
          $('#pageContent').html(data.content);
          $('div.form-group').removeClass('has-error');
          $('label.text-danger').remove();
            $("select[name='nationalite']").change(function(){
              var SelectedValue = $("option:selected", this).val();
              displayElement(SelectedValue)
            })
          $('.select2').select2()
          $.getScript('/assets/js/agents.js');
        },
        error:function(xhr){
          // alert(Object.getOwnPropertyNames(xhr.responseJSON.errors))
          //Affichage des erreurs
          $('div.form-group').removeClass('has-error');
          $('label.text-danger').remove();
          $.each(xhr.responseJSON, function(key,value) {
              //Affichage des erreurs
              $('div.form-group.'+key).addClass('has-error');
              $('div.form-group.'+key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>'+value+'</label>');
          })
        }
    });
    $('.select2').select2()
  }

</script>
@yield('script')
</body>
</html>
