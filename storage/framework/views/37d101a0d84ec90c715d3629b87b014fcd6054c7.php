<?php
use Carbon\Carbon;

?>


<?php $__env->startSection('head'); ?>
<!-- fullCalendar -->


<!-- Select2 -->
<!-- Time Picker -->
<link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/css/timePicker.css">

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('')); ?>dist/css/jquery-ui.css">
<style>
  .form-inline .bootstrap-select, .form-inline .bootstrap-select.form-control:not([class*=col-]){
    width: 250px;
  }

  .with_input {
      width: 160px;
  }

  .select2-container--default .select2-selection--multiple{
    border-radius: 0px !important;
  }

  .select2-container--default.select2-container--focus .select2-selection--multiple{
    border-radius: 0px !important;
  }
</style>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
  <h1>
    Création de nouveaux plannings
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
    <li><a href="#">Gerer les plannings</a></li>
    <li class="active">Création de nouveau plannings</li>
  </ol>
</section>

<section class="content">
  <!-- SELECT2 EXAMPLE -->

  <!-- /.box -->

  <div class="box box-primary">
    <div class="box-header with-border">
      <!-- START ACCORDION & CAROUSEL-->

      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- form start -->
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-tools pull-right" style="padding-bottom: 15px;">
              </div>
              <div class="box-group" id="accordion">
                <div class="box-header" style="position: inherit;">
                  <div class="new">
                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                        <div class="col-lg-4 col-md-4">
                          <div class="input-group" style="margin-bottom:5px">
                            <label for="generer_agent_name" class="input-group-addon"><i class="fa fa-user"></i></label>
                            <select name="generer_agent_name[]" class="form-control placeholder-select2" id="generer_agent_name" multiple="multiple" aria-placeholder="Choisir un agent">
                              
                              <?php if(count($agents)>0): ?>
                              <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($agent->id); ?>: <?php echo e($agent->nom.' '.$agent->prenoms); ?>" <?php echo e(old('agent')==$agent->id ? 'selected' : null); ?>><?php echo e($agent->nom.' '.$agent->prenoms); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="input-group" style="margin-bottom:5px">
                            <div class="input-group input-group hidden-xs">
                              <label for="generer_site_name" class="input-group-addon"><i class="fa fa-building"></i></label>
                              <input type="search" id="datalist_site_name" class="form-control" style="font-size:14px; width:300px;" list="list_site_name" placeholder="Choisir un site">

                              <datalist id="list_site_name" class="text-capitalize">
                                <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option data-value="<?php echo e($site->id); ?>" <?php echo e(old('site')==$site->id ? 'selected' : null); ?> value="<?php echo e($site->nom); ?>"></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </datalist>
                              <input type="hidden" name="generer_site_name" id="generer_site_name">
                              <input type="hidden" id="generer_site_name_text">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="row">
                            <div class="col-lg-6 col-md-6">
                              <div class="input-group" style="margin-bottom:5px">
                                <label for="generer_heure_debut" class="input-group-addon"><i class="fa fa-clock-o"></i> Début</label>
                                <input type="time" name="generer_heure_debut" id="generer_heure_debut" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <div class="input-group" style="margin-bottom:5px">
                                <label for="generer_heure_fin" class="input-group-addon"><i class="fa fa-clock-o"></i> Fin</label>
                                <input type="time" name="generer_heure_fin" id="generer_heure_fin" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="new1">
                    <div class="row">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-lg-3">
                            <div class="input-group" style="margin-bottom:5px">
                              <label for="generer_heure_pause" class="input-group-addon"><i class="fa fa-clock-o"></i> Pause</label>
                              <input type="time" name="generer_heure_pause" id="generer_heure_pause" value="00:00" class="form-control">
                            </div>
                          </div>
                          <div class="col-lg-9">
                            <div class="input-group"  style="margin-bottom:5px">
                              <label for="generer_dates" class="input-group-addon"><i class="fa fa-calendar"></i></label>
                              <input type="text" name="generer_dates" id="generer_dates" class="date form-control" placeholder="Selectionnez les dates de vacation" autocomplete="off">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2"></div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-4"></div>
                      <div class="col-lg-4">
                          <button type="button" name="generer" id="generer" class="btn btn-primary" style="margin-bottom:5px; width: 100%;">Générer les vacations</button>
                        </div>
                      </div>
                      <div class="col-lg-4"></div>
                    </div>
                  </div>
                </div>
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                <form method="post" id="user_form" action=" <?php echo e(route('planning.store')); ?> ">
                 <?php echo csrf_field(); ?>
                 <div class="table-responsive">
                   <table class="table table-striped table-bordered" id="user_data">
                     <tr class="text-capitalize">
                       <th>Agent</th>
                       <th>Site</th>
                       <th>Date début</th>
                       <th>Heure début</th>
                       <th>Heure fin</th>
                       <th>Heure pause</th>
                       
                       <th>Supprimer</th>
                     </tr>
                     <tr>
                     </tr>
                   </table>
                 </div>
                 <div align="center">
                   <input type="submit" name="insert" id="insert" class="btn btn-success" value="valider" style="padding: 0 2%;" />
                 </div>
               </form>

             </div>
           </div>
           <!-- /.box-body -->
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

<?php $__env->stopSection(); ?>
<div id="user_dialog" title="Add Data" class="hidden">
  
  <div class="form-group">
    <label for="agent_name">Nom de l'agent</label>
    <select name="agent_name" class="form-control select2" id="agent_name" style="width: 100%;">
      <option value="" selected hidden>Choisir un agent pour son planning</option>
      <?php if(count($agents)>0): ?>
      <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($agent->id); ?>" <?php echo e(old('agent')==$agent->id ? 'selected' : null); ?>><?php echo e($agent->nom.' '.$agent->prenoms); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </select>
    <?php $__errorArgs = ['agent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <span id="error_agent_name" class="text-danger"></span>
  </div>

  
  <div class="form-group">
    <label for="site_name">Site</label>
    <select name="site_name" id="site_name" class="form-control select2">
      <option value="" selected hidden>Choisir un site</option>
      <?php if(count($sites)>0): ?>
      <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($site->id); ?>" <?php echo e(old('site')==$site->id ? 'selected' : null); ?>><?php echo e($site->nom); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </select>
    <?php $__errorArgs = ['site'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <span id="error_site_name" class="text-danger"></span>
  </div>

  
  <div class="form-group">
    <label for="date_debut">Date de début</label>
    <input type="date" name="date_debut" id="date_debut" class="form-control" />
    <span id="error_date_debut" class="text-danger"></span>
  </div>

  
  <div class="form-group">
    <label for="heure_debut">Heure début</label>
    <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="00:00" />
    <span id="error_heure_debut" class="text-danger"></span>
  </div>

  
  <div class="form-group">
    <label for="heure_fin">Heure fin</label>
    <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="00:00" />
    <span id="error_heure_fin" class="text-danger"></span>
  </div>

  
  <div class="form-group">
    <label for="heure_pause">Heure de pause</label>
    <input type="time" name="heure_pause" id="heure_pause" class="form-control" value="00:00" />
    <span id="error_heure_pause" class="text-danger"></span>
  </div>

  <div class="form-group col-12" align="center">
    <input type="hidden" name="row_id" id="hidden_row_id" />
    <button type="button" name="save" id="save" class="btn btn-info">Créer</button>
  </div>
</div>
<div id="action_alert" title="Action">

</div>
<div class="modal fade" id="action_alert_bs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #CCCCCC; color: black;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
        <div class="modal-body" id="action_alert_bs_c" style="min-height: 50px;
    font-size: 15px;
    font-weight: bold;">
        </div>
        <div class="modal-footer" style="background-color: #CCCCCC; color: black;">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Fermer</button>
        </div>
    </div>
  </div>
</div>

<?php $__env->startSection('script'); ?>
<!-- fullCalendar -->
<script>
  $(document).ready(function(){

    $(".placeholder-select2").select2({
        placeholder: "Choisir un ou plusieurs agents"
    });

	// var count = 0;

	$('#user_dialog').dialog({
		autoOpen:false,
		width:400
	});

	$('#add').click(function(){
		$('#user_dialog').dialog('option', 'title', 'Ajouter une vacation');
		$('#date_debut').val('');
		$('#heure_debut').val('00:00');
		$('#heure_fin').val('00:00');
		$('#heure_pause').val('00:00');

        $('#error_date_debut').text('');
        $('#error_heure_debut').text('');
        $('#error_heure_fin').text('');
        $('#error_heure_pause').text('');

		// $('#error_first_name').text('');
		// $('#error_last_name').text('');
		$('#error_heure_fin').css('border-color', '');
        $('#error_date_debut').css('border-color', '');
        $('#error_heure_debut').css('border-color', '');
        $('#error_heure_pause').css('border-color', '');

		// $('#first_name').css('border-color', '');
		// $('#last_name').css('border-color', '');
		$('#save').text('Créer');
		$('#user_dialog').dialog('open');
	});

  if (isNaN(count)) {
    count= 0;
  }

  $('#save').click(function(){
    var error_agent_name = '';
    var error_site_name = '';
    var error_date_debut = '';
    var error_heure_debut = '';
    var error_heure_fin = '';
    var error_heure_pause = '';

    if($('#agent_name').val() == '')
    {
     error_agent_name = 'Nom de l\'agent requis';
     $('#error_agent_name').text(error_agent_name);
     $('#error_agent_name').css('border-color', '#cc0000');
     agent_id = '';
     agent_name = '';
   }
   else
   {
     error_agent_name = '';
     $('#error_agent_name').text(error_agent_name);
     $('#agent_name').css('border-color', '');
     agent_id = $('#agent_name').val();
     agent_name = $('#agent_name option:selected').text();
   }
   if($('#site_name').val() == '')
   {
     error_site_name = 'Nom de l\'agent requis';
     $('#error_site_name').text(error_site_name);
     $('#error_site_name').css('border-color', '#cc0000');
     site_id = '';
     site_name = '';
   }
   else
   {
     error_site_name = '';
     $('#error_site_name').text(error_site_name);
     $('#error_site_name').css('border-color', '');
     site_id = $('#site_name').val();
     site_name = $('#site_name option:selected').text();
   }
   if($('#date_debut').val() == '')
   {
     error_date_debut = 'Nom de l\'agent requis';
     $('#error_date_debut').text(error_date_debut);
     $('#error_date_debut').css('border-color', '#cc0000');
     date_debut = '';
   }
   else
   {
     error_date_debut = '';
     $('#error_date_debut').text(error_date_debut);
     $('#error_date_debut').css('border-color', '');
     date_debut = $('#date_debut').val();
   }
   if($('#heure_debut').val() == '')
   {
     error_heure_debut = 'Nom de l\'agent requis';
     $('#error_heure_debut').text(error_heure_debut);
     $('#error_heure_debut').css('border-color', '#cc0000');
     heure_debut = '';
   }
   else
   {
     error_heure_debut = '';
     $('#error_heure_debut').text(error_heure_debut);
     $('#error_heure_debut').css('border-color', '');
     heure_debut = $('#heure_debut').val();
   }
   if($('#heure_fin').val() == '')
   {
     error_heure_fin = 'Nom de l\'agent requis';
     $('#error_heure_fin').text(error_heure_fin);
     $('#error_heure_fin').css('border-color', '#cc0000');
     heure_fin = '';
   }
   else
   {
     error_heure_fin = '';
     $('#error_heure_fin').text(error_heure_fin);
     $('#error_heure_fin').css('border-color', '');
     heure_fin = $('#heure_fin').val();
   }
   if($('#heure_pause').val() == '')
   {
     error_heure_pause = 'Nom de l\'agent requis';
     $('#error_heure_pause').text(error_heure_pause);
     $('#error_heure_pause').css('border-color', '#cc0000');
     heure_pause = '';
   }
   else
   {
     error_heure_fin = '';
     $('#error_heure_pause').text(error_heure_pause);
     $('#error_heure_pause').css('border-color', '');
     heure_pause = $('#heure_pause').val();
   }
   if(error_agent_name != '' || error_site_name != '' || error_date_debut != '' || error_heure_debut != '' || error_heure_fin != '' || error_heure_pause != '')
   {
     return false;
   }
   else
   {
     if($('#save').text() == 'Créer')
     {

      count = count + 1;

      output = '<tr id="row_'+count+'">';
      output += '<td>'+agent_name+' <input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'" class="agent_name" value="'+agent_id+'" /></td>';
      output += '<td>'+site_name+' <input type="hidden" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
      output += '<td>'+date_debut+' <input type="hidden" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
      output += '<td>'+heure_debut+' <input type="hidden" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
      output += '<td>'+heure_fin+' <input type="hidden" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
      output += '<td>'+heure_pause+' <input type="hidden" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';
      output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">Modifier</button></td>';
      output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Supprimer</button></td>';
      output += '</tr>';
      $('#user_data').append(output);
      $('#generer_dates').val('');
      $('#generer_dates').text('');
    }
    else
    {
      var row_id = $('#hidden_row_id').val();
      output = '<td>'+agent_name+' <input type="hidden" name="hidden_agent_name[]" id="agent_name'+row_id+'" class="agent_name" value="'+agent_id+'" /></td>';
      output += '<td>'+site_name+' <input type="hidden" name="hidden_site_name[]" id="site_name'+row_id+'" value="'+site_id+'" /></td>';
      output += '<td>'+date_debut+' <input type="hidden" name="hidden_date_debut[]" id="date_debut'+row_id+'" value="'+date_debut+'" /></td>';
      output += '<td>'+heure_debut+' <input type="hidden" name="hidden_heure_debut[]" id="heure_debut'+row_id+'" value="'+heure_debut+'" /></td>';
      output += '<td>'+heure_fin+' <input type="hidden" name="hidden_heure_fin[]" id="heure_fin'+row_id+'" value="'+heure_fin+'" /></td>';
      output += '<td>'+heure_pause+' <input type="hidden" name="hidden_heure_pause[]" id="heure_pause'+row_id+'" value="'+heure_pause+'" /></td>';

      output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">Modifier</button></td>';
      output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Supprimer</button></td>';
      $('#row_'+row_id+'').html(output);
    }

    $('#user_dialog').dialog('close');
  }
});

	// $(document).on('click', '.view_details', function(){
	// 	var row_id = $(this).attr("id");

  //   var agent_id = $('#agent_name'+row_id+'').val();
  //   var site_id = $('#site_name'+row_id+'').val();
  //   var date_debut = $('#date_debut'+row_id+'').val();
  //   var heure_debut = $('#heure_debut'+row_id+'').val();
  //   var heure_fin = $('#heure_fin'+row_id+'').val();
  //   var heure_pause = $('#heure_pause'+row_id+'').val();

	// 	$('#agent_name').val(agent_id);
	// 	$('#site_name').val(site_id);
	// 	$('#date_debut').val(date_debut);
	// 	$('#heure_debut').val(heure_debut);
	// 	$('#heure_fin').val(heure_fin);
	// 	$('#heure_pause').val(heure_pause);

  //   var agent_name = $('#agent_name option:selected').text();

	// 	$('#save').text('Editer');
  //   $('#hidden_row_id').val(row_id);
  //   $('.hidden').removeClass('hidden')
	// 	$('#user_dialog').dialog('option', 'title', 'Editer une vacation');
	// 	$('#user_dialog').dialog('open');
	// });

	$(document).on('click', '.remove_details', function(){
		var row_id = $(this).attr("id");
		if(confirm("Êtes-vous sûre de bien vouloir supprimé ce champs ?"))
		{
			$('#row_'+row_id+'').remove();
		}
		else
		{
			return false;
		}
	});

	$('#action_alert').dialog({
		autoOpen:false
	});

	// $('#user_form').on('submit', function(event){
  //
  //   var count_data = 0;
  //
  //   var myAsyncMethod = function() {
  //     var deferred = $.Deferred();
  //
  //     $('#user_data input').each(function(e, val){
  //
  //       if (! val.getAttribute('value')) {
  //         deferred.reject();
  //       }
  //
  //     });
  //
  //     deferred.resolve("Done!");
  //
  //     return deferred.promise();
  //   };
  //
  //   var firstMethod = function(e) {
  //     // Appel de la méthode asynchrone.
  //     myAsyncMethod().done(function (response) {
  //
  //       $('.agent_name').each(function(){
  //         count_data = count_data + 1;
  //       });
  //
  //       if(count_data > 0)
  //       {
  //
  //         var route = $('#user_form').data('route');
  //
  //         var form_data = $('#user_form').serialize();
  //         console.log(form_data);
  //
  //         // e.preventDefault();
  //
  //         $.ajax({
  //           headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           },
  //           url: route,
  //           type: 'POST',
  //           data: form_data,
  //           cache: false,
  //           processData: false,
  //           timeout: 8000,
  //           dataType: 'json',
  //           success:function(data)
  //           {
  //             // console.log(data);
  //             location.reload();
  //           },
  //           error: function (xhr, ajaxOptions, thrownError) {
  //             console.log(xhr);
  //             console.log(thrownError);
  //           }
  //         });
  //       }
  //       else
  //       {
  //         notify('Remplissez les champs');
  //         // $('#action_alert').html('<p></p>');
  //         // $('#action_alert').dialog('open');
  //       }
  //
  //     }).fail(function (response) {
  //       notify('Remplissez correctement les champs, il ne peut y avoir de valeur nul');
  //       // $('#action_alert').html('<p>Remplissez correctement les champs, il ne peut y avoir de valeur nul.</p>');
  //       // $('#action_alert').dialog('open');
  //     })
  //
  //   };
  //
  //   $(function(){
  //     // Appel de la méthode basique.
  //     firstMethod();
  //   });
  //
  //   event.preventDefault();
  // });



    // $('#user_data input').each(function(e, val){
    //   console.log(! val.getAttribute('value'));

    //   if (! val.getAttribute('value')) {
    //     $('#action_alert').html('<p>Remplissez correctement les champs, il ne peut y avoir de valeur nul.</p>');
    //     $('#action_alert').dialog('open');

    //     event.preventDefault();

    //     return;
    //   }
    // });
    
    
    // $('.agent_name').each(function(){
    //   count_data = count_data + 1;
    // });
    
		// if(count_data > 0)
		// {

    //   var route = $('#user_form').data('route');
		// 	var form_data = $(this).serialize();
    //   // alert(form_data);
		// 	$.ajax({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url: route,
    //     type: 'POST',
    //     data: form_data,
    //     cache: false,
    //     processData: false,
    //     timeout: 8000,
    //     dataType: 'json',
		// 		success:function(data)
		// 		{
    //      location.reload();
		// 		}
		// 	});
		// }
		// else
		// {
		// 	$('#action_alert').html('<p>Remplissez les champs</p>');
		// 	$('#action_alert').dialog('open');
		// }
		// event.preventDefault();
	// });
	
});
</script>
<script>

  $('#generer_dates').datepicker({

    title: 'Cochez les dates',
    format: 'yyyy-mm-dd',
    endDate:'+1m +12m',
    multidate: true,
    closeOnDateSelect: true,
    
  });

</script>
<script>
 console.log(<?php echo $tableau; ?>)
  var plannings = <?php echo $tableau; ?>;
  if (isNaN(count)) {
    var count= 0;
  }

  function creneauHoraireExiste(planningVerification, date , agent_id, userDebut, userFin) {

    try {

      var t = 0;
      while ( planningVerification.indexOf( date, t ) !== -1 ) {

        var tranche = plannings[agent_id][planningVerification.indexOf( date, t )];
        // console.log(tranche);

        var debut = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[1]);
        var fin   = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[2]);

        if (fin < debut) {

          fin = new Date(fin);
          fin.setHours(fin.getHours()+24);

        }

        // console.log(tranche.split(" ")[0]+'T'+tranche.split(" ")[1]);
        // console.log(tranche.split(" ")[0]+'T'+tranche.split(" ")[2]);

        // console.log(debut);
        // console.log(fin);
        

        // console.log( ! (userDebut >= debut && userFin <= fin) );

        // if ( ! (userDebut >= debut && userFin <= fin) ) {

          if ( (userDebut >= debut && userFin <= fin) || (userDebut <= debut && ( userFin >= debut && userFin <= fin )) || ( (userDebut >= debut && userDebut <= fin) && userFin >= fin ) ) {
            return true;
          }

        // var tranche = plannings[agent_id][planningVerification.indexOf( date, t )]
        // console.log(tranche);

        t = planningVerification.indexOf( date, t ) + 1;

      }

    } catch (error) {
      console.log(error);
    }

    return false;

  }

  $('#generer').click(function() {

    var agent_name = $('#generer_agent_name option:selected').text();
    var dates = $("#generer_dates").val();
    var site_id = $("#generer_site_name").val();
    var site_name = $("#generer_site_name_text").val();
    var heureDebut = $("#generer_heure_debut").val()
    var heureFin = $("#generer_heure_fin").val()
    var heurePause = $("#generer_heure_pause").val()

    if (agent_name == '' || dates == '' || site_name == '' || heureDebut == '' || heureFin == '' || heurePause == '') {
      notify('Remplissez les champs');
      // $('#action_alert').html('<p>Remplissez les champs</p>');
      // $('#action_alert').dialog('open');

      return false;
    }
    
    dates = dates.split(",");

    $('#generer_agent_name').val().forEach(elmt => {
      var idName = elmt.split(': ');
      var agent_id = idName[0];
      var agent_name = idName[1];
      
      for (let index = 0; index < dates.length; index++) {

        var date = dates[index];
        count = count + 1;

        date_debut = date;
        heure_debut = heureDebut;
        heure_fin = heureFin;
        heure_pause = heurePause;

        var userDebut = Date.parse(date_debut + "T" +heureDebut);
        var userFin = Date.parse(date_debut + "T" +heureFin);

        if ( (plannings[agent_id] === undefined) && (agent_name != undefined) ) {

          output = '<tr id="row_'+count+'">';
          output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
          output += '<td><span class="text-uppercase site_name form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
          output += '<td> <input type="date" class="form-control with_input date_debut" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
          output += '<td> <input type="time" class="form-control heure_debut" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
          output += '<td> <input type="time" class="form-control heure_fin" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
          output += '<td> <input type="time" class="form-control heure_pause" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';

          output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
          output += '</tr>';

          $('#user_data').append(output);

        } else {

          var planningVerification = [];
          var planningHeureDebut = [];
          var planningHeureFin = [];

          plannings[agent_id].forEach(elmt => {
            planningVerification.push(elmt.split(" ")[0]);
            planningHeureDebut.push(elmt.split(" ")[1]);
            planningHeureFin.push(elmt.split(" ")[2]);
          });

          var t = 0;
          
          if ( planningVerification.indexOf( date ) !== -1 ) {

            if ( ! creneauHoraireExiste(planningVerification, date, agent_id, userDebut, userFin) ) {

              output = '<tr id="row_'+count+'">';
              output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
              output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
              output += '<td> <input type="date" class="form-control with_input" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
              output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
              output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
              output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';
              
              output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
              output += '</tr>';

              $('#user_data').append(output);
              $('#generer_dates').val("").datepicker("update");


            } else {
              document.querySelector('#action_alert_bs_c').innerHTML =  document.createElement('p').innerText = 'L\'agent ' + agent_name.toLocaleUpperCase() + ' a deja un crénau horaire entre ' + heureDebut + ' et ' + heureFin + ' pour le ' + date_debut ;
              $('#action_alert_bs').modal('show');
            }
            
          } 
          else{

            output = '<tr id="row_'+count+'">';
            output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
            output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
            output += '<td> <input type="date" class="form-control with_input" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
            output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
            output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
            output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';
            
            output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
            output += '</tr>';

            $('#user_data').append(output);
            $('#generer_dates').val("").datepicker("update");


          }
          
          // for (let i = 0; i < plannings[agent_id].length; i++) {

          //   var tranche = plannings[agent_id][i];

          //   var debut = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[1]);
          //   var fin = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[2]);

          //   if ( ! ( (date_debut === tranche.split(" ")[0]) && ( userDebut >= debut && userFin <= fin ) ) ) {

          //     output = '<tr id="row_'+count+'">';
          //     output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
          //     output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
          //     output += '<td> <input type="date" class="form-control" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
          //     output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
          //     output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
          //     output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';

          //     output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
          //     output += '</tr>';

          //     $('#user_data').append(output);

          //     break;

          //   }

          // }

        }


      }

        // var BreakException = {};
        // try {
        //   // console.log((plannings[agent_id] === undefined) && (agent_name != undefined));
        //   if ( (plannings[agent_id] === undefined) && (agent_name != undefined) ) {

        //     output = '<tr id="row_'+count+'">';
        //     output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
        //     output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
        //     output += '<td> <input type="date" class="form-control" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';

        //     output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
        //     output += '</tr>';

        //     $('#user_data').append(output);

        //   }
        //   // console.log(agent_id);
        //   // console.log(plannings[agent_id]);

        //   console.log(plannings[agent_id]);

        //   plannings[agent_id].forEach(tranche => {
        //     console.log(tranche);
        //     // console.log(date_debut);
        //     // console.log(date_debut === tranche.split(" ")[0]);
        //     // console.log(( (date_debut === tranche.split(" ")[0]) && ( userDebut >= debut && userFin <= fin ) ) && (agent_name != undefined));

        //   var debut = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[1]);
        //   var fin = Date.parse(tranche.split(" ")[0]+'T'+tranche.split(" ")[2]);

        //   console.log(date_debut === tranche.split(" ")[0]);
        //   console.log(userDebut >= debut && userFin <= fin);


        //   console.log((date_debut === tranche.split(" ")[0]) && (userDebut >= debut && userFin <= fin) );
        //   console.log(agent_name != undefined);
        //   console.log(! ( (date_debut === tranche.split(" ")[0]) && ( userDebut >= debut && userFin <= fin ) ));
        //   console.log(( ! ( (date_debut === tranche.split(" ")[0]) && ( userDebut >= debut && userFin <= fin ) ) ) && (agent_name != undefined));




        //   if ( ( ! ( (date_debut === tranche.split(" ")[0]) && ( userDebut >= debut && userFin <= fin ) ) ) && (agent_name != undefined) ) {
        //     output = '<tr id="row_'+count+'">';
        //     output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
        //     output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
        //     output += '<td> <input type="date" class="form-control" value="'+date_debut+'" disabled /><input type="hidden" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
        //     output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';

        //     output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
        //     output += '</tr>';

        //     $('#user_data').append(output);
        //   }
        //   throw BreakException;

        // });


        // } catch (error) {
        //   console.log(error);
        //   // throw BreakException;

        // }


        // alert(count);
        // console.log(date_debut);
        // console.log(! ($.inArray(date_debut, plannings[agent_id]) > -1) );

        // if ( ! ( ($.inArray(date_debut, plannings[agent_id]) > -1) && ( ($.inArray(heure_debut, plannings[agent_id]) > -1) || ($.inArray(heure_fin, plannings[agent_id]) > -1) ) ) && ( agent_name != undefined ) ) {

        // if ( ! ( ($.inArray(date_debut, plannings[agent_id]) > -1) && ( userDebut >= debut && userFin <= fin ) ) && ( agent_name != undefined ) ) {

        //   output = '<tr id="row_'+count+'">';
        //   output += '<td><span class="text-uppercase agent_name form-control" style="border:none;">'+agent_name+'</span><input type="hidden" name="hidden_agent_name[]" id="agent_name'+count+'"value="'+agent_id+'" /></td>';
        //   output += '<td><span class="text-uppercase form-control" style="border:none;">'+site_name+'</span><input type="hidden" class="form-control" name="hidden_site_name[]" id="site_name'+count+'" value="'+site_id+'" /></td>';
        //   output += '<td> <input type="date" min="<?php echo e(Carbon::now()->toDateString()); ?>" max="<?php echo e(Carbon::now()->addWeek(6)->toDateString()); ?>" class="form-control" name="hidden_date_debut[]" id="date_debut'+count+'" value="'+date_debut+'" disabled /></td>';
        //   output += '<td> <input type="time" class="form-control" name="hidden_heure_debut[]" id="heure_debut'+count+'" value="'+heure_debut+'" /></td>';
        //   output += '<td> <input type="time" class="form-control" name="hidden_heure_fin[]" id="heure_fin'+count+'" value="'+heure_fin+'" /></td>';
        //   output += '<td> <input type="time" class="form-control" name="hidden_heure_pause[]" id="heure_pause'+count+'" value="'+heure_pause+'" /></td>';

        //   output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs form-control remove_details" id="'+count+'">Supprimer</button></td>';
        //   output += '</tr>';

        //   $('#user_data').append(output);

        // }
      // });

    });



})
</script>
<script>
  $('#datalist_site_name').change(function () {

    var valeur = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    var texte = $('#datalist_site_name').val();
    
    $('#generer_site_name').val(valeur);
    $('#generer_site_name_text').val(texte);
    
  });

  function notify(mgs) {
    document.querySelector('#action_alert_bs_c').innerHTML =  document.createElement('p').innerText = mgs ;
    $('#action_alert_bs').modal('show');
  }
</script>
<!-- Page specific script -->
<!-- Add calendarJsFile -->

<!-- / Add calendarJsFile -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iziplanning\resources\views/pages/plannings/create.blade.php ENDPATH**/ ?>