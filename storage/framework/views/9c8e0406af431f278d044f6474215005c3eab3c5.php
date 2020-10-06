<?php $__env->startSection('head'); ?>


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

                    <?php echo $__env->yieldContent('tab'); ?>

                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

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

































































































</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/pages/agents/create/layout.blade.php ENDPATH**/ ?>