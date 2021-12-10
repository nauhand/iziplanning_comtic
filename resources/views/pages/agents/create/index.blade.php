@php
  use Carbon\Carbon;
@endphp


@extends('pages.agents.create.layout')
@section('tab')
<style>
    .input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
    }

    .input-group>.form-control,
    .input-group>.custom-select,
    .input-group>.custom-file {
    position: relative;
    flex: 1 1 auto;
    margin-bottom: 0;
    margin-bottom: 5px;
    }
    .custom-select{
      margin-top: 5px;
    }

    .btn-file {
    position: relative;
    overflow: hidden;
    vertical-align: middle;
    }

    .fileinput.input-group {
    display: flex;
    margin-bottom: 9px;
    flex-wrap: nowrap;
    }

    .fileinput.input-group>* {
    position: relative;
    z-index: 2;
    }

    .fileinput .form-control {
    padding: .375rem .75rem;
    display: inline-block;
    margin-bottom: 0px;
    vertical-align: middle;
    cursor: text;
    }

    .fileinput-filename {
    display: inline-block;
    overflow: hidden;
    vertical-align: middle;
    }

    .form-control .fileinput-filename {
    vertical-align: bottom;
    }

    .input-group>.form-control:not(:last-child),
    .input-group>.custom-select:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    }

    .fileinput.input-group>.btn-file {
    z-index: 1;
    }

    .fileinput-new {
    padding-right: 10px;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 4px 4px 0;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 .25rem .25rem 0;
    }

    .input-group-addon:not(:first-child) {
    border-left: 0;
    }

    .fileinput .input-group-addon {
    padding: .375rem .75rem;
    width: auto;
    }

    .fileinput-exists .fileinput-new,
    .fileinput-new .fileinput-exists {
    display: none;
    }

    .fileinput .btn {
    vertical-align: middle;
    }

    .fileinput .input-group-addon {
    padding: .375rem .75rem;
    }

    .btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    }

    .fileinput.input-group>.btn-file {
    z-index: 1;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 4px 4px 0;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 .25rem .25rem 0;
    }

    .btn-file>input {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    font-size: 23px;
    cursor: pointer;
    filter: alpha(opacity=0);
    opacity: 0;
    direction: ltr;
    }
    .btn_customer_red {
        background: red !important;
        border: 0 solid red ;
    }
    .btn_customer_green{
        background: green !important;
        border: 0 solid green ;
    }



</style>

  <form id="enregistrementAgent" role="form" method="POST" action="{{ route('agent.addVerification') }}" enctype="multipart/form-data">
    @csrf

    @include('pages.agents.create.form_1', ['agent' => $agent, 'departements' => $departements])
    @include('pages.agents.create.form_2', ['agent' => $agent, 'departements' => $departements])
    @include('pages.agents.create.form_3', ['agent' => $agent, 'departements' => $departements])
    @include('pages.agents.create.form_4', ['agent' => $agent, 'departements' => $departements])
    @include('pages.agents.create.form_5', ['agent' => $agent, 'departements' => $departements])

  </form>
@endsection

@section('script')

  <script>
    
      $(document).ready(function() {
        $('.select2').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
      });

    $('.suivant').click(function () {
      var enCours = $(this).closest('.form-block');
      ajaxVerification($(this).data('route'), enCours, $(this).data('type'));
      
    });

    $('.precedent').click(function () {
      
      var enCours = $(this).closest('.form-block');

      enCours.toggleClass('hide');
      enCours.fadeOut();
      enCours.prev().removeClass('hide');
      enCours.prev().siblings().addClass('hide');
      
    });

    $("#enregistrementAgent").on("keydown", function(e) {
      
      if(e.which === 13 && $("#enregistrementAgent").is(":visible")) {
          e.preventDefault();
      }
      
    });

    function ajaxVerification(url, enCours, type){

      form = $("#enregistrementAgent");
      
      $.ajax({
        
          url   : url,
          type  : form.attr('method'),
          data  : form.serialize() + '&type='+type,
          success: function (data) {
            
            @if(session()->has('notification'))
              $('body').append('<div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Notification :</strong>' + {{ session()->get('notification') }} + '</div>');
            @endif

            $('div.form-group').removeClass('has-error');
            $('label.text-danger').remove();
            $("select[name='nationalite']").change(function(){
              var SelectedValue = $("option:selected", this).val();
              displayElement(SelectedValue)
            });

            enCours.fadeIn();
            enCours.next().removeClass('hide');
            enCours.next().siblings().addClass('hide');
            $.getScript('/assets/js/agents.js');

          },
          error:function(xhr){

            $('div.form-group').removeClass('has-error');
            $('label.text-danger').remove();
            $.each(xhr.responseJSON, function(key,value) {
                $('div.form-group.'+key).addClass('has-error');
                $('div.form-group.'+key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>'+value+'</label>');
            })

          }

      });
      
    }
  </script>

@endsection