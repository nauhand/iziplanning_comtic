@extends('layouts.app')

@section('head')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('')}}plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('')}}bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('')}}bower_components/select2/dist/css/select2.min.css">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    @if ($message = Session::get('successadmin'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Notification :</strong> {{ $message }}
        </div>
      @endif
    <section class="content-header">
      <h1>
        Modifier un administrateur
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li><a href="#">Gere les comptes</a></li>
        <li class="active">Modifier</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <!-- SELECT2 EXAMPLE -->

      <!-- /.box -->

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Modifier les info sur l'admin</h3>
                <!-- START ACCORDION & CAROUSEL-->

            <div class="row">
              <div class="col-md-12">
                <div class="box box-solid">
                  <div class="box-header with-border">
                  </div>
                  <!-- form start -->
                  <form role="form" action="{{ route('account.update')}}" method="post">
                  @csrf
                  <input type="hidden" value="{{ $user->id}}" name="userid">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-warning">
                          <div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <!-- Identité  #1 -->
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse">
                            <div class="box-body">
      
                              <div class="col-md-6">
                                <div class="form-group @error('nom')  has-error @enderror">
                                  <label>Nom</label>
                                  <input name="nom" type="text" class="form-control"  placeholder="Entrer le nom" value="{{old('nom') ?: $user->nom}}">
                                  @error('nom')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                                <div class="form-group @error('prenoms')  has-error @enderror">
                                  <label>Prénoms</label>
                                  <input name="prenoms" type="text" class="form-control"  placeholder="Entrer le Prénom" value="{{old('prenoms') ?: $user->prenoms}}">
                                  @error('prenoms')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                                <div class="form-group @error('email')  has-error @enderror">
                                  <label>Email</label>
                                  <input name="email" type="email" class="form-control"  placeholder="Entrer l'adresse Email" value="{{old('email') ?: $user->email}}">
                                  @error('email')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group @error('accountype')  has-error @enderror">
                                  <label>Type de compte</label>
                                  <select class="form-control" name="accountype">
                                    <option value="sana">Choisir le type de compte</option>
                                    <option value="1" {{old('accountype')=='1' ? 'selected' : null}}>Adminstrateur</option>
                                    <option value="2" {{old('accountype')=='2' ? 'selected' : null}}>Éditeur</option>
                                  </select>
                                  @error('accountype')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                                <div class="form-group @error('password')  has-error @enderror">
                                  <label>Mot de passe</label>
                                  <input name="password" type="text" class="form-control"  placeholder="Entrer le mot de passe" value="{{old('password') ?:''}}">
                                  @error('password')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                                <div class="form-group @error('numeromobile')  has-error @enderror">
                                  <label>Numéro mobile</label>
                                  <input name="numeromobile" type="text" class="form-control"  placeholder="Entrer le numero" value="{{old('numeromobile') ?: $user->numeromobile}}">
                                  @error('numeromobile')
                                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                  @enderror
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="box-footer pull-right">
                        <button type="submit" class="btn btn-lg btn-primary">Ajouter</button>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </form>
                </div>
                <!-- /.box -->
              </div>
            </div>
         
      <!-- /.row -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
@endsection

@section('script')
<!-- jQuery 3 -->
<!-- Select2 -->
<script src="{{asset('')}}bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="{{asset('')}}plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{asset('')}}plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{asset('')}}plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap color picker -->
<script src="{{asset('')}}bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('')}}plugins/iCheck/icheck.min.js"></script>


<script type="text/javascript">



</script>
@endsection
