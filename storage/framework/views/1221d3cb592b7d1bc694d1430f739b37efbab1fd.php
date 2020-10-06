<style>
    .rc_ra_dash {
        margin-bottom: 10px;
        margin-left: 5px;
        margin-right: 10px;
        height: 130px;
        position: relative;
        padding: 5px;
        background: white;

        -webkit-box-shadow: 0px 0px  10px #ccc;
        -moz-box-shadow:    0px 0px  10px #ccc;
        box-shadow:        0px 0px 10px #ccc;

    }
    .rc_ra_dash_icon {
        position: absolute;
        width: 70px;
        height: 70px;
        background: #29aae3;
        top: -7px;
        left: 20px;
        border-radius: 10px;
    }
    .rc_ra_dash img {
        width: 100%;
        height: auto;
    }
    .color_blue {
        color: #29aae3;
    }
    .title_box_rcv {
        position: absolute;
        left: 100px;
        display: block;
        top: -1px;
    }
    .title_rcv {
        font-size: 30px;
        font-weight: bolder;
        color: black;
    }
    .footer_rcv {
        position: absolute;
        bottom: 10px;
        right: 8px;
    }
    .footer_rcv_color {
        color: #4d4d4d;
    }
    .rcv_parent {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: baseline;
        align-content: flex-start;
        margin-bottom: 20px ;
    }
    .rc_ra_dash_icon_item2 {
        position: absolute;
        width: 70px;
        height: 70px;
        background: #f71414;
        top: -7px;
        left: 20px;
        border-radius: 10px;
    }
    .color-pink {
        color: #f71414;
    }
    .rc_ra_dash_icon_item3 {
        position: absolute;
        width: 70px;
        height: 70px;
        background: #ed8316;
        top: -7px;
        left: 20px;
        border-radius: 10px;
    }
    .color-orange {
        color: #ed8316;
    }
    .rc_ra_dash_icon_item4 {
        position: absolute;
        width: 70px;
        height: 70px;
        background: #42cf4f;
        top: -7px;
        left: 20px;
        border-radius: 10px;
    }
    .color-green {
        color: #42cf4f ;
    }
  

    /* // Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) { 
        .rc_ra_dash {
        margin-bottom: 10px;
        margin-left: 5px;
        margin-right: 10px;
        height: 100px;
        position: relative;
        /* padding: 5px; */
        background: white;
        -webkit-box-shadow: 0px 0px  10px #ccc;
        -moz-box-shadow:    0px 0px  10px #ccc;
        box-shadow:        0px 0px 10px #ccc;

    }
    .rc_ra_dash_icon {
        position: absolute;
        width: 60px;
        height: 60px;
        background: #29aae3;
        top: -5px;
        left: 15px;
        border-radius: 10px;
    }
    .action_title_rcv {
        font-size: 14px; 
        line-height: 14px;
    }
    .rc_ra_dash img {
        width: 100%;
        height: auto;
    }
    .color_blue {
        color: #29aae3;
    }
    .title_box_rcv { 
        position: absolute;
        left: 100px;
        display: block;
        top: -4px;
    }
    .title_rcv {
        font-size: 15px;
        font-weight: bolder;
        color: black;
    }
    .footer_rcv {
        position: absolute;
        bottom: 5px;
        right: 8px;
    }
    .footer_rcv_color {
        color: #4d4d4d;
        font-size: 13px;
    }
    .rcv_parent {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: baseline;
        align-content: flex-start;
        margin-bottom: 20px ;
    }
    .rc_ra_dash_icon_item2 {

       
      

        position: absolute;
        width: 60px;
        height: 60px;
        background: #f71414;
        top: -5px;
        left: 15px;
        border-radius: 10px;
    }
    .color-pink {
        color: #f71414;
    }
    .rc_ra_dash_icon_item3 {

        position: absolute;
         width: 60px;
        height: 60px;
        background: #ed8316;
        top: -5px;
        left: 15px;
        border-radius: 10px;
    }
    .color-orange {
        color: #ed8316;
    }
    .rc_ra_dash_icon_item4 {

        /* position: absolute;
         width: 60px;
        height: 60px;
        background: #ed8316;
        top: -5px;
        left: 15px;
        border-radius: 10px; */


        position: absolute;
         width: 60px;
        height: 60px;
        background: #42cf4f;
        top: -5px;
        left: 15px;
        border-radius: 10px;
    }
    .color-green {
        color: #42cf4f ;
    }
     }
    }

</style>
<?php $__env->startSection('content'); ?>
    <?php if($message = Session::get('successlogin')): ?>
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> <?php echo e($message); ?>

        </div>
    <?php endif; ?>
    <!-- Content Wrapper. Contains page content -->
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tableau de Bord</h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li class="active">Tableau de Bord</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class=" rcv_parent">
            <div class="col-md-3 col-sm-3 col-xs-3 rc_ra_dash" >
                <div class="rc_ra_dash_icon">
              <span>
                <img src="<?php echo e(asset('')); ?>assets/img/ic_agent.png" alt="">
              </span>
                </div>
                <div class="title_box_rcv">
                <h3 class="title_rcv"><?php echo e($agentTotal); ?> Agent<?php echo e($agentTotal  == 0 ? '' : 's'); ?></h3>
                <p class="action_title_rcv color_blue">Enregistré<?php echo e($agentTotal  == 0 ?'' : 's'); ?></p>
                </div>
                <div class="footer_rcv"> <i></i>
                    <span class="footer_rcv_color">
                  <a href= "<?php echo e(route('agent.index')); ?>" class="small-box-footer footer_rcv_color">Voir plus  <i class="fa fa-arrow-circle-right"></i></a>
             </span>
                </div>
            </div>
            <div class="col-md-3  rc_ra_dash" >
                <div class="rc_ra_dash_icon_item2">
          <span>
            <img src="<?php echo e(asset('')); ?>assets/img/ic_heure.png" alt="">
          </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e(($heureTotalJour + $heureTotalNuit) ?? 0); ?> Heures </h1>
                    <p class="action_title_rcv color-pink">Effectuées par les agents</p>
                </div>
                <div class="footer_rcv">
              <span class="footer_rcv_color">
                    <a href="<?php echo e(route('planning-definitif')); ?>" class="small-box-footer footer_rcv_color">Voir plus  <i class="fa fa-arrow-circle-right"></i></a>
              </span>
                </div>
            </div>
            <div class=" col-md-3  rc_ra_dash" >
                <div class="rc_ra_dash_icon_item3">
          <span>
            <img src="<?php echo e(asset('')); ?>assets/img/ic_heure.png" alt="">
          </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e($heureTotalNuit ?? 0); ?> Heures</h1>
                    <p class="action_title_rcv color-orange">De nuit effectuées par les agents</p>
                </div>
                <div class="footer_rcv">
              <span class="footer_rcv_color">
                  <a href="<?php echo e(route('planning-definitif')); ?>" class="small-box-footer footer_rcv_color"> Voir plus <i class="fa fa-arrow-circle-right"></i></a>
              </span>
                </div>
            </div>
            <div class="col-md-3   rc_ra_dash" >
                <div class="rc_ra_dash_icon_item4">
              <span>
                <img src="<?php echo e(asset('')); ?>assets/img/ic_agent.png" alt="">
              </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e($agentDeployes ?? 0); ?> Agents</h1>
                    <p class="action_title_rcv color-green">Déployés</p>
                </div>
                <div class="footer_rcv">
                  <span class="footer_rcv_color">
                      <a href="<?php echo e(route('planning-definitif')); ?>" class="small-box-footer footer_rcv_color">Voir plus <i class="fa fa-arrow-circle-right"></i></a>

                  </span>
                </div>
            </div>
        </div>
        <div class=" rcv_parent">
            <div class="col-md-3 rc_ra_dash" >
                <div class="rc_ra_dash_icon_item4">
              <span>
                <img src="<?php echo e(asset('')); ?>assets/img/ic_site.png" alt="">
              </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e($siteTotal ?? 0); ?> Sites</h1>
                    <p class="action_title_rcv color-green">De déploiement</p>
                </div>
                <div class="footer_rcv"> <i></i>
                    <span class="footer_rcv_color">
                        <a href="<?php echo e(route('site.index')); ?>" class="small-box-footer footer_rcv_color"> Voir plus <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3  rc_ra_dash" >
                <div class="rc_ra_dash_icon">
          <span>
            <img src="<?php echo e(asset('')); ?>assets/img/ic_heure.png" alt="">
          </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"> <?php echo e($data); ?> Heure<?php echo e($data >= 2 ? 's': ''); ?> </h1>
                    <p class="action_title_rcv color_blue">  nombre d'heure<?php echo e($data >= 2 ? 's': ''); ?> fériée<?php echo e($data >= 2 ? 's': ''); ?>  pour ce mois </p>
                </div>
                <div class="footer_rcv">
                    <?php if(isset($data) && (!empty($data))): ?>
                        <span class="footer_rcv_color">
                        <a href="<?php echo e(route('jour-feries')); ?>" class="small-box-footer footer_rcv_color">Voir plus <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class=" col-md-3  rc_ra_dash" >
                <div class="rc_ra_dash_icon_item2">
          <span>
            <img src="<?php echo e(asset('')); ?>assets/img/ic_agent.png" alt="">
          </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e($agentAbsents); ?> Agent(s) </h1>
                    <p class="action_title_rcv color-pink">Absents</p>
                </div>
                <div class="footer_rcv">
                    <span class="footer_rcv_color">
                        <a href="<?php echo e(route('absence.index')); ?>" class="small-box-footer footer_rcv_color">Voir plus <i class="fa fa-arrow-circle-right"></i></a>

                    </span>
                </div>
            </div>
            <div class="col-md-3   rc_ra_dash" >
                <div class="rc_ra_dash_icon_item3">
              <span>
                <img src="<?php echo e(asset('')); ?>assets/img/ic_agent.png" alt="">
              </span>
                </div>
                <div class="title_box_rcv">
                    <h1 class="title_rcv"><?php echo e($agentConges); ?> Agent<?php echo e($agentConges > 0); ?> </h1>
                    <p class="action_title_rcv color-orange">En Congés</p>
                </div>
                <div class="footer_rcv">
                    <span class="footer_rcv_color">
                        <a href="<?php echo e(route('absence.index')); ?>" class="small-box-footer footer_rcv_color">Voir plus <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title text-capitalize">Calendrier des vacations</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">

                        </ul>
                        <div id='calendar'></div>
                    </div>
                </div>
                <!-- /.box -->

            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                // weekends: false,
                locale: 'fr',
                defaultView: 'month',
                displayEventTime: true,
                fixedWeekCount:true,
                events: <?php echo $plannings; ?>,
                editable: true,
                eventLimit: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                navLinks: true,
                validRange: {
                    start: "<?php echo e(Carbon\Carbon::now()->year()); ?>",
                    end: "<?php echo e(Carbon\Carbon::now()->addMonth(12)); ?>"
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/layouts/dashboard.blade.php ENDPATH**/ ?>