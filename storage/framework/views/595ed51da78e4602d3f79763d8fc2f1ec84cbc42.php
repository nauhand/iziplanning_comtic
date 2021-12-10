<?php $__env->startSection('head'); ?>
<link rel="stylesheet" href="<?php echo e(asset('')); ?>plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?php echo e(asset('')); ?>bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo e(asset('')); ?>plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('')); ?>bower_components/select2/dist/css/select2.min.css">
<style>
  button.dt-button, div.dt-button, a.dt-button{
    background-color: #3c8dbc !important;
    background-image: none;
  }
  .dataTables_wrapper .dataTables_filter input{
    margin-left: 0.5em;
    width: 250px;
    padding: 5px;
    border: 1px solid;
    color: #555;
    font-weight: normal;
    margin-bottom: 10px;
  }

</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Notification :</strong> <?php echo e($message); ?>

    </div>
  <?php endif; ?>
    <?php if($message = Session::get('info')): ?>
      <div class="alert alert-warning alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Notification :</strong> <?php echo e($message); ?>

      </div>
    <?php endif; ?>
    
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Registre Unique du Personnel
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Accueil</a></li>
      <li><a href="#">Gestion des agents</a></li>
      <li class="active">Registre Unique du Personnel</li>
    </ol>
  </section>

  <!-- Main content -->
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
                <div class="box-group" id="accordion" style="position: relative;">
                  <div class="box-header" style="position: absolute; z-index: 1;">
              
                    <div class="box-tools pull-left" style="margin-right: 15px">
                      <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                      <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="<?php echo e(route('registre.unique')); ?>" target="_blank" style="background-color: #c72121;">
                          <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                      </a>
                      </div>
                  </div>
                  
                  <div class="box-tools pull-left" style="margin-right: 15px">
                      <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                      <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="<?php echo e(route('excel.registreUnique')); ?>" target="_blank" style="background-color: #0b7728;">
                          <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
                      </a>
                      </div>
                  </div>
                    <div class="box-tools pull-left" style="margin-right: 15px">
                      <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                        <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="<?php echo e(route('ajout.agent')); ?>"  style="background-color: #4a85d1;">
                          <i class="fa fa-group BTN-VK"></i> Ajouter un nouvel agent
                        </a>
                      </div>
                    </div>
                  </div>

                  
                  <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Nom & Prénoms</th>
                        <th>Email</th>
                        <th>Type contrat</th>
                        <th>Statut</th>
                        <th>Contact</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($agents)>0): ?>
                      <?php ( $nombreElement = $agents->count() * $agents->currentPage() - $agents->count() ); ?>
                      
                      <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($nombreElement + $key + 1); ?></td>
                          <td><a href="<?php echo e(route('provisoire.show',$agent->id)); ?>"><?php echo e($agent->nom.' '.$agent->prenoms); ?></a></td>

                          <td><?php echo e($agent->email); ?></td>
                          <td><?php echo e($agent->typecontrat); ?></td>
                          <td>
                            <?php if($agent->statut==='deploye'): ?>
                              <span class="label label-success">planifié</span>
                            <?php else: ?>
                              <span class="label label-warning">disponible</span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($agent->numeromobile); ?></td>
                          <td>
                            <a href="<?php echo e(route('agent.edit',$agent->id)); ?>" class="label label-primary"  data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo e(route('agent.edit',$agent->id)); ?>" class="label label-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>
                            
                              <a href="<?php echo e(route('planning.delete_planning_agent', $agent)); ?>" class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa fa-trash"></i></a>



                          </td>  
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7"><p class="text-center">Aucun agents enrégistré pour le moment</p></td>
                      </tr>
                    <?php endif; ?>
                    </tbody>
                  </table>
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

<?php $__env->startSection('script'); ?>
<!-- jQuery 3 -->
<!-- Select2 -->
<script src="<?php echo e(asset('')); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo e(asset('')); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo e(asset('')); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo e(asset('')); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo e(asset('')); ?>bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo e(asset('')); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo e(asset('')); ?>plugins/iCheck/icheck.min.js"></script>

<script>
  $(document).ready( function () {
      $('#datatable_vac').DataTable({
            select :true,
            lengthChange: false,
            "ordering": false,
            "language": {

              "sEmptyTable":     "Aucune donnée disponible dans le tableau",
              "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
              "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
              "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
              "sInfoPostFix":    "",
              "sInfoThousands":  ",",
              "sLengthMenu":     "Afficher _MENU_ éléments",
              "sLoadingRecords": "Chargement...",
              "sProcessing":     "Traitement...",
              "sSearch":         " ",
              "sZeroRecords":    "Aucun élément correspondant trouvé",
              "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
              },
              "searchPlaceholder": "Rechercher un compte",
              "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
              },
              "select": {
                "rows": {
                  "_": "%d lignes sélectionnées",
                  "0": "Aucune ligne sélectionnée",
                  "1": "1 ligne sélectionnée"
                } 
              }

            },
          });
  } );
</script>

<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iziplanning\resources\views/pages/agents/index.blade.php ENDPATH**/ ?>