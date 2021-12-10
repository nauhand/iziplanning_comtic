@extends('layouts.app')

@section('head')


@endsection

@section('content')
 <!-- Content Header (Page header) -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Notification :</strong> {{ $message }}
    </div>
    @endif

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajouter un nouvel agent
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li><a href="#">Gerer les agents</a></li>
        <li class="active">Ajouter un nouvel agent</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="text-center">FICHE AGENT</h3>

          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                </div>
                  <div id="#pageContent">

                    @yield('tab')

                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section>

@endsection

@section('script')

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


{{--<script type="text/javascript">--}}
{{--  //Affichae des champ des informations administrative--}}
{{--  var nationalite=$("select[name='nationalite'] :selected")--}}

{{--  $("select[name='nationalite']").change(function(){--}}
{{--    var SelectedValue = $("option:selected", this).val();--}}
{{--    displayElement(SelectedValue)--}}
{{--  })--}}

{{--  displayElement("{{ old('nationalite') ?: 'FR' }}")--}}

{{--  function displayElement(SelectedValue='FR'){--}}
{{--    if(SelectedValue=='FR'){--}}
{{--      //Show--}}
{{--      $("#div_carteidentite").show(500)--}}
{{--      $("#div_numerocarteidentite").show(500)--}}
{{--      //Hide--}}
{{--      $("#div_numeroetranger").hide(500)--}}
{{--      $("#div_lieudelivrancecs").hide(500)--}}
{{--      $("#div_etablissementcartedesejour").hide(500)--}}
{{--      $("#div_cartedesejour").hide(500)--}}
{{--      $("#div_expirationcartedesejour").hide(500)--}}
{{--      $("#div_typetitresejour").hide(500)--}}
{{--    }else{--}}
{{--      //Show--}}
{{--      $("#div_numeroetranger").show(500)--}}
{{--      $("#div_lieudelivrancecs").show(500)--}}
{{--      $("#div_etablissementcartedesejour").show(500)--}}
{{--      $("#div_cartedesejour").show(500)--}}
{{--      $("#div_expirationcartedesejour").show(500)--}}
{{--      $("#div_typetitresejour").show(500)--}}
{{--      //Hide--}}
{{--      $("#div_carteidentite").hide(500)--}}
{{--      $("#div_numerocarteidentite").hide(500)--}}
{{--    }--}}
{{--  }--}}

{{--</script>--}}

{{--<script type="text/javascript">--}}
{{--  //Affichage des champ de la qualification--}}
{{--  var ads=$("input[name='ads']");--}}
{{--  var maitrechien=$("input[name='maitrechien']");--}}

{{--  var diplome = document.querySelector('#diplome');--}}


{{--  console.log(1);--}}
{{--  diplome.addEventListener('change', function (e) {--}}
{{--    console.log(e.target.value)--}}
{{--  })--}}

{{--  ads.change(function(){--}}
{{--    if ($(this).is(':checked')) {--}}
{{--        $("#div_numeroads").show(500)--}}
{{--    } else {--}}
{{--        $("#div_numeroads").hide(500)--}}
{{--    }--}}
{{--  });--}}

{{--  maitrechien.change(function(){--}}
{{--    if ($(this).is(':checked')) {--}}
{{--      $("#div_nomchien").show(500)--}}
{{--      $("#div_datevaliditevaccin").show(500)--}}
{{--    } else {--}}
{{--      $("#div_nomchien").hide(500)--}}
{{--      $("#div_datevaliditevaccin").hide(500)--}}
{{--    }--}}
{{--  });--}}

{{--</script>--}}

{{--<script type="text/javascript">--}}
{{--  //Affichae des champ des informations administrative--}}
{{--  var nationalite=$("select[name='typecontrat'] :selected")--}}
{{--  var div_dureeducontrat=$("#div_dureeducontrat")--}}

{{--  $("select[name='typecontrat']").change(function(){--}}
{{--    var SelectedValue = $("option:selected", this).val();--}}
{{--    displayDureeElement(SelectedValue)--}}
{{--  })--}}

{{--  displayDureeElement("{{ old('typecontrat') ?: 'cdi' }}")--}}

{{--  function displayDureeElement(SelectedValue='cdi'){--}}
{{--    if(SelectedValue==='cdi' || SelectedValue===''){--}}
{{--      //Hide--}}
{{--      div_dureeducontrat.hide(500)--}}
{{--    }else{--}}
{{--      //Show--}}
{{--      div_dureeducontrat.show(500)--}}
{{--    }--}}
{{--  }--}}
{{--</script>--}}

</script>
@endsection