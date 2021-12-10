<?php
    use Carbon\Carbon;
    // dd($errors);
?>


<?php $__env->startSection('head'); ?>

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>bower_components/select2/dist/css/select2.min.css">

    <style>
        tr {
            height: 35px;
            font-size: 16px;
        }
        #edit {
            width: 800px;
            margin: 0 auto;
            height: auto;
            overflow: scroll;
        }
        #edit img{
            width: 100%;
            height: auto;
        }
        .modal-body {
            position: relative;
            padding: none;
        }
        #my_modal {
            width: 100%;
            height: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Modifier les informations de l'Agent
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#">Gerer les agents</a></li>
            <li class="active">Modifier</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->

        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Fiche Agent</h3>
                <!-- START ACCORDION & CAROUSEL-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- form start -->
                            <form role="form" action="<?php echo e(route('agent.update',$agent->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div class="panel box box-warning">

                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Identité  #1</a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse">
                                                <div class="box-body">
                                                    <div class="col-md-6">
                                                        <div class="form-group civilite <?php $__errorArgs = ['civilite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Civilité (*)</label>
                                                            <select class="form-control" name="civilite" >
                                                                <option value="" selected hidden>Choisir le genre</option>
                                                                <option value="M" <?php echo e(old('civilite')=='M' || $agent->civilite=='M' ? 'selected' : null); ?>>Monsieur</option>
                                                                <option value="Mll" <?php echo e(old('civilite')=='Mll' || $agent->civilite=='Mll' ? 'selected' : null); ?>>Mademoiselle</option>
                                                                <option value="Mme" <?php echo e(old('civilite')=='Mme' || $agent->civilite=='Mme' ? 'selected' : null); ?>>Madame</option>
                                                            </select>
                                                            <?php $__errorArgs = ['civilite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group nom <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Nom (*)</label>
                                                            <input name="nom" type="text" class="form-control"  placeholder="Entrer le nom" value="<?php echo e(old('nom') ?: $agent->nom); ?>" >
                                                            <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group datenaissance <?php $__errorArgs = ['datenaissance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Date de naissance: (*)</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" name="datenaissance" class="form-control pull-right" id="datepicker" min="<?php echo e(Carbon::now()->addYear(-100)->toDateString()); ?>" max="<?php echo e(Carbon::now()->addYear(-18)->toDateString()); ?>" value="<?php echo e(old('datenaissance') ?: $agent->datenaissance); ?>" >
                                                            </div>
                                                            <!-- /.input group -->
                                                            <?php $__errorArgs = ['datenaissance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group statutmatrimonial <?php $__errorArgs = ['statutmatrimonial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Statut Matrimonial (*)</label>
                                                            <select class="form-control" name="statutmatrimonial" >
                                                                <option value="">Choisir le statut</option>
                                                                <option value="mar" <?php echo e(old('statutmatrimonial')=='mar' || $agent->statutmatrimonial=='mar' ? 'selected' : null); ?>>Marié(e)</option>
                                                                <option value="cel" <?php echo e(old('statutmatrimonial')=='cel' || $agent->statutmatrimonial=='cel' ? 'selected' : null); ?>>Célibataire</option>
                                                                <option value="veuf" <?php echo e(old('statutmatrimonial')=='veuf' || $agent->statutmatrimonial=='veuf' ? 'selected' : null); ?>>Veuf(ve)</option>
                                                            </select>
                                                            <?php $__errorArgs = ['statutmatrimonial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group prenoms <?php $__errorArgs = ['prenoms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Prénoms (*)</label>
                                                            <input name="prenoms" type="text" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('prenoms') ?: $agent->prenoms); ?>" >
                                                            <?php $__errorArgs = ['prenoms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel box box-warning">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        Coordonnées  #2
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse">
                                                <div class="box-body">
                                                    <div class="col-md-6">
                                                        <div class="form-group adressegeo <?php $__errorArgs = ['adressegeo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Adresse géographique</label>
                                                            <input name="adressegeo" type="text" class="form-control"  placeholder="Entrer l'adresse géographique" value="<?php echo e(old('adressegeo') ?: $agent->adressegeo); ?>">
                                                            <?php $__errorArgs = ['adressegeo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group codepostal <?php $__errorArgs = ['codepostal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Code postal</label>
                                                            <input name="codepostal" type="text" class="form-control"  placeholder="Entrer le code postal" value="<?php echo e(old('codepostal') ?: $agent->codepostal); ?>">
                                                            <?php $__errorArgs = ['codepostal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group ville <?php $__errorArgs = ['ville'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Ville</label>
                                                            <input name="ville" type="text" class="form-control" placeholder="Paris" value="<?php echo e(old('ville') ?: $agent->ville); ?>">
                                                            <?php $__errorArgs = ['ville'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Département</label>
                                                            <select class="form-control  departement" name="departement">
                                                                <option value="">Choisir le département</option>
                                                                <?php if(count($departements)>0): ?>
                                                                    <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($departement->id); ?>" <?php echo e(old('departement')==$departement->id || $agent->departement_id==$departement->id ? 'selected' : null); ?>><?php echo e($departement->nom); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                                <?php $__errorArgs = ['departement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group numeromobile <?php $__errorArgs = ['numeromobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Numéro Mobile (*)</label>
                                                            <input name="numeromobile" type="tel" minlength="13" maxlength="13" class="form-control"  placeholder="Entrer le numéro mobile" value="<?php echo e(old('numeromobile') ?: $agent->numeromobile); ?>" >
                                                            <?php $__errorArgs = ['numeromobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group numerofixe <?php $__errorArgs = ['numerofixe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Numéro Fixe</label>
                                                            <input name="numerofixe" type="tel" class="form-control"  placeholder="Entrer le numéro fixe" value="<?php echo e(old('numerofixe') ?: $agent->numerofixe); ?>">
                                                            <?php $__errorArgs = ['numerofixe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group email <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Adresse Mail</label>
                                                            <input name="email" type="text" class="form-control"  placeholder="Entrer l'adresse mail" value="<?php echo e(old('email') ?: $agent->email); ?>">
                                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-warning">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                        Informations administratives #3
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse">
                                                <div class="box-body">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nationalité</label>
                                                            <select class="form-control" name="nationalite">
                                                                <option value="FR"  <?php echo e(old('nationalite')=='FR' || $agent->nationalite=='FR' ? 'selected' : null); ?>>Française</option>
                                                                <option value="ET" <?php echo e(old('nationalite')=='ET' || $agent->nationalite=='ET' ? 'selected' : null); ?>>Etrangère</option>
                                                            </select>
                                                            <?php $__errorArgs = ['nationalite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['numeropermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Numéro de permis de conduire</label>
                                                            <input name="numeropermis" type="text" class="form-control"  placeholder="Entrer le numéro de permis de conduire" value="<?php echo e(old('numeropermis') ?: $agent->numeropermis); ?>">
                                                            <?php $__errorArgs = ['numeropermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['dateetablpermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Date détablissement du permis</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" name="dateetablpermis" class="form-control pull-right" id="datepicker" value="<?php echo e(old('dateetablpermis') ?: $agent->dateetablpermis); ?>">
                                                            </div>
                                                            <!-- /.input group -->
                                                            <?php $__errorArgs = ['dateetablpermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group <?php $__errorArgs = ['categoriepermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Catégorie du permis</label>
                                                            <select name="categoriepermis[]" class="form-control select2" multiple="multiple" data-placeholder="Sélectionner les catégories de permis" style="width: 100%;">
                                                                <option value="AM" <?php echo e(in_array('AM',old('categoriepermis') ?: array()) || in_array('AM',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Catégorie AM</option>
                                                                <option value="A" <?php echo e(in_array('A',old('categoriepermis') ?: array()) || in_array('A',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis A</option>
                                                                <option value="A1" <?php echo e(in_array('A1',old('categoriepermis') ?: array()) || in_array('A1',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis A1</option>
                                                                <option value="A2" <?php echo e(in_array('A2',old('categoriepermis') ?: array()) || in_array('A2',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis A2</option>
                                                                <option value="B" <?php echo e(in_array('B',old('categoriepermis') ?: array()) || in_array('B',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis B</option>
                                                                <option value="B1" <?php echo e(in_array('B1',old('categoriepermis') ?: array()) || in_array('B1',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis B1</option>
                                                                <option value="BE" <?php echo e(in_array('BE',old('categoriepermis') ?: array()) || in_array('BE',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis BE</option>
                                                                <option value="C" <?php echo e(in_array('C',old('categoriepermis') ?: array()) || in_array('C',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis C</option>
                                                                <option value="C1" <?php echo e(in_array('C1',old('categoriepermis') ?: array()) || in_array('C1',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis C1</option>
                                                                <option value="CE" <?php echo e(in_array('CE',old('categoriepermis') ?: array()) || in_array('CE',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis CE</option>
                                                                <option value="C1E" <?php echo e(in_array('C1E',old('categoriepermis') ?: array()) || in_array('C1E',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis C1E</option>
                                                                <option value="D" <?php echo e(in_array('D',old('categoriepermis') ?: array()) || in_array('D',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis D</option>
                                                                <option value="D1" <?php echo e(in_array('D1',old('categoriepermis') ?: array()) || in_array('D1',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis D1</option>
                                                                <option value="DE" <?php echo e(in_array('DE',old('categoriepermis') ?: array()) || in_array('DE',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis DE</option>
                                                                <option value="D1E" <?php echo e(in_array('D1E',old('categoriepermis') ?: array()) || in_array('D1E',$categoriepermisArray ?: array()) ? 'selected' : null); ?>>Permis D1E</option>
                                                            </select>
                                                            <?php $__errorArgs = ['categoriepermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group <?php $__errorArgs = ['numerocni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_carteidentite">
                                                            <label>Numéro CNI</label>
                                                            <input name="numerocni" type="text" class="form-control"  placeholder="Entrer le numéro CNI" value="<?php echo e(old('numerocni') ?: $agent->numerocni); ?>">
                                                            <?php $__errorArgs = ['numerocni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group <?php $__errorArgs = ['dateexpircni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_dateexpircni">
                                                            <label>Date d'expiration CNI</label>
                                                            <input name="dateexpircni" type="date" class="form-control" value="<?php echo e(old('dateexpircni') ?: $agent->dateexpircni); ?>">
                                                            <?php $__errorArgs = ['dateexpircni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['numeroetranger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_numeroetranger">
                                                            <label>Numéro étranger</label>
                                                            <input name="numeroetranger" type="text" class="form-control"  placeholder="Entrer le numéro étranger" value="<?php echo e(old('numeroetranger') ?: $agent->numeroetranger); ?>">
                                                            <?php $__errorArgs = ['numeroetranger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['lieudelivrancecs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_lieudelivrancecs">
                                                            <label>Lieu de délivrance de la carte de séjour</label>
                                                            <input name="lieudelivrancecs" type="text" class="form-control"  placeholder="Entrer le lieux de délivrance de la carte" value="<?php echo e(old('lieudelivrancecs') ?: $agent->lieudelivrancecs); ?>">
                                                            <?php $__errorArgs = ['lieudelivrancecs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['etablissementcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_etablissementcartedesejour">
                                                            <label>Date d'etablissement de la carte de séjour</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" name="etablissementcartedesejour" class="form-control pull-right" id="datepicker" value="<?php echo e(old('etablissementcartedesejour') ?: $agent->etablissementcartedesejour); ?>">
                                                            </div>
                                                            <!-- /.input group -->
                                                            <?php $__errorArgs = ['etablissementcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['expirationcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_expirationcartedesejour">
                                                            <label>Date d'expiration de la carte de séjour</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" name="expirationcartedesejour" class="form-control pull-right" id="datepicker" value="<?php echo e(old('expirationcartedesejour') ?: $agent->expirationcartedesejour); ?>">
                                                            </div>
                                                            <!-- /.input group -->
                                                            <?php $__errorArgs = ['expirationcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['numeross'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_lieudelivrance">
                                                            <label>Numéro de sécurité sociale</label>
                                                            <input name="numeross" type="text" class="form-control"  placeholder="Entrer le numéro de sécurité social" value="<?php echo e(old('numeross') ?: $agent->numeross); ?>">
                                                            <?php $__errorArgs = ['numeross'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-warning">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                        Emploi et qualification  #4
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse">
                                                <div class="box-body">
                                                    <div class="col-md-6">
                                                        <div class="form-group <?php $__errorArgs = ['typecontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Type de Contrat</label>
                                                            <select class="form-control" name="typecontrat">
                                                                <option value="">Choisir le contrat</option>
                                                                <option value="cdi" <?php echo e(old('typecontrat')=='cdi' || $agent->typecontrat=='cdi' ? 'selected' : null); ?>>CDI</option>
                                                                <option value="cdd" <?php echo e(old('typecontrat')=='cdd' || $agent->typecontrat=='cdd' ? 'selected' : null); ?>>CDD</option>
                                                                <option value="interim" <?php echo e(old('typecontrat')=='interim' || $agent->typecontrat=='interim' ? 'selected' : null); ?>>Intérim</option>
                                                                <option value="essai" <?php echo e(old('typecontrat')=='essai' || $agent->typecontrat=='essai' ? 'selected' : null); ?>>Essai</option>
                                                            </select>
                                                            <?php $__errorArgs = ['typecontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <!-- checkbox -->
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="ads" <?php echo e(old('ads')==='on' || in_array('ads',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    ADS
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="maitrechien"  <?php echo e(old('categoriepermis')==='on' || in_array('maitrechien',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Maitre chien
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="ssiap1"  <?php echo e(old('ssiap1')==='on' || in_array('ssiap1',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    SSIAP1
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="ssiap2"  <?php echo e(old('categoriepermis')==='on' || in_array('ssiap2',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    SSIAP2
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="chefequipe"  <?php echo e(old('chefequipe')==='on' || in_array('chefequipe',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Chef d'équipe
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="superviseur"  <?php echo e(old('superviseur')==='on' || in_array('superviseur',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Superviseur
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="commercial"  <?php echo e(old('commercial')==='on' || in_array('commercial',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Commercial
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="agentcontrole"  <?php echo e(old('agentcontrole')==='on' || in_array('agentcontrole',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Agent de contrôle
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="assitanceRh"  <?php echo e(old('assitanceRh')==='on' || in_array('assitanceRh',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Assistance RH
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="responsableRh" <?php echo e(old('responsableRh')==='on' || in_array('responsableRh',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Responsable RH
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="comptable_assistant" <?php echo e(old('comptable_assistant')==='on' || in_array('comptable_assistant',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Assistance comptable
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="comptable" <?php echo e(old('comptable')==='on' || in_array('comptable',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    comptable
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="comptable_expert" <?php echo e(old('comptable_expert')==='on' || in_array('comptable_expert',$qualificationArray ?: array()) ? 'checked' : null); ?>>
                                                                    Expert Comptable
                                                                </label>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group <?php $__errorArgs = ['dureeducontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_dureeducontrat">
                                                            <label>Durée du Contrat</label>
                                                            <select class="form-control" name="dureeducontrat">
                                                                <option value="">Choisir la durée</option>
                                                                <option value="3mois" <?php echo e(old('dureeducontrat')=='3mois' || $agent->dureeducontrat=='3mois' ? 'selected' : null); ?>>3 Mois</option>
                                                                <option value="6mois" <?php echo e(old('dureeducontrat')=='6mois' || $agent->dureeducontrat=='6mois' ? 'selected' : null); ?>>6 Mois</option>
                                                                <option value="1ans" <?php echo e(old('dureeducontrat')=='1ans' || $agent->dureeducontrat=='1ans' ? 'selected' : null); ?>>1 ans</option>
                                                                <option value="2ans" <?php echo e(old('dureeducontrat')=='2ans' || $agent->dureeducontrat=='2ans' ? 'selected' : null); ?>>2 ans</option>
                                                            </select>
                                                            <?php $__errorArgs = ['dureeducontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['numeroads'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>ADS</label>
                                                            <input name="numeroads" type="text" class="form-control"  placeholder="Numéro ADS" value="<?php echo e(old('numeroads') ?: $agent->numeroads); ?>">
                                                            <?php $__errorArgs = ['numeroads'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['numerocartepro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Numéro carte professionnelle</label>
                                                            <input name="numerocartepro" type="text" class="form-control"  placeholder="Numéro carte professionnelle" value="<?php echo e(old('numerocartepro') ?: $agent->numerocartepro); ?>">
                                                            <?php $__errorArgs = ['numerocartepro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['nomchien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_nomchien">
                                                            <label>Nom du chien</label>
                                                            <input name="nomchien" type="text" class="form-control"  placeholder="Entrer le nom du chien" value="<?php echo e(old('nomchien') ?: $agent->nomchien); ?>">
                                                            <?php $__errorArgs = ['nomchien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group <?php $__errorArgs = ['datevaliditevaccin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_datevaliditevaccin">
                                                            <label>Date de validité du vaccin</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" name="datevaliditevaccin" class="form-control pull-right" id="datepicker" value="<?php echo e(old('datevaliditevaccin') ?: $agent->datevaliditevaccin); ?>">
                                                            </div>
                                                            <!-- /.input group -->
                                                            <?php $__errorArgs = ['datevaliditevaccin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group dateentree <?php $__errorArgs = ['dateentree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Date d'entrée (*)</label>
                                                            <input name="dateentree" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('dateentree') ?: $agent->dateentree); ?>" >
                                                            <?php $__errorArgs = ['dateentree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group datelimiteprof <?php $__errorArgs = ['datelimitecarteproffess'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <label>Date limite carte professionnelle (*)</label>
                                                            <input name="datelimitecarteproffess" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('datelimitecarteproffess') ?: $agent->datelimitecarteproffess); ?>" >
                                                            <?php $__errorArgs = ['dateentree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-warning">

                                    <div class="box-body">
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <div class="form-group passport">
                                                <label for="passport" class="custom-select">Passeport (page 1)</label>
                                                <input type="file" id="passport" name="passport" class="form-control btn-file <?php $__errorArgs = ['passport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['passport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group passport_verso">
                                                <label for="passport_verso" class="custom-select">Passeport (page 2)</label>
                                                <input type="file" id="passport_verso" name="passport_verso" class="form-control btn-file <?php $__errorArgs = ['passport_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['passport_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group carte_nationale">
                                                <label for="carte_nationale" class="custom-select">Carte d'identité nationale (recto)</label>
                                                <input type="file" id="carte_nationale" name="carte_nationale" class="form-control btn-file <?php $__errorArgs = ['carte_nationale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['carte_nationale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group carte_nationale_verso">
                                                <label for="carte_nationale_verso" class="custom-select">Carte d'identité nationale (verso)</label>
                                                <input type="file" id="carte_nationale_verso" name="carte_nationale_verso" class="form-control btn-file <?php $__errorArgs = ['carte_nationale_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['carte_nationale_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group carte_vaccin_chien">
                                                <label for="carte_vaccin_chien" class="custom-select">Carte de vaccination du chien</label>
                                                <input type="file" id="carte_vaccin_chien" name="carte_vaccin_chien" class="form-control btn-file <?php $__errorArgs = ['carte_vaccin_chien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['carte_vaccin_chien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group carte_professionnelle">
                                                <label for="carte_vaccin_chien" class="custom-select">Carte professionnelle</label>
                                                <input type="file" id="carte_professionnelle" name="carte_professionnelle" class="form-control btn-file <?php $__errorArgs = ['carte_professionnelle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['carte_professionnelle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group titre_sejour">
                                                <label for="titre_sejour" class="custom-select">Titre de séjour (recto)</label>
                                                <input type="file" id="titre_sejour" name="titre_sejour" class="form-control btn-file <?php $__errorArgs = ['titre_sejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['titre_sejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group titre_sejour_verso">
                                                <label for="titre_sejour_verso" class="custom-select">Titre de séjour (verso)</label>
                                                <input type="file" id="titre_sejour_verso" name="titre_sejour_verso" class="form-control btn-file <?php $__errorArgs = ['titre_sejour_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['titre_sejour_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group recepice_titre_sejour">
                                                <label for="recepice_titre_sejour" class="custom-select">Recepicé du titre de séjour</label>
                                                <input type="file" id="recepice_titre_sejour" name="recepice_titre_sejour" class="form-control btn-file <?php $__errorArgs = ['recepice_titre_sejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['recepice_titre_sejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group carte_vitale">
                                                <label for="carte_vitale" class="custom-select">Carte vitale </label>
                                                <input type="file" id="carte_vitale" name="carte_vitale" class="form-control btn-file <?php $__errorArgs = ['carte_vitale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['carte_vitale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <div class="form-group permis_conduire">
                                                <label for="permis_conduire" class="custom-select">Permis de conduire (recto)</label>
                                                <input type="file" id="permis_conduire" name="permis_conduire" class="form-control btn-file <?php $__errorArgs = ['permis_conduire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['permis_conduire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group permis_conduire_verso">
                                                <label for="permis_conduire_verso" class="custom-select">Permis de conduire (verso)</label>
                                                <input type="file" id="permis_conduire_verso" name="permis_conduire_verso" class="form-control btn-file" <?php $__errorArgs = ['permis_conduire_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> btn btn-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['permis_conduire_verso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> <?php echo e($message); ?></label>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel box box-warning">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    Medias  #5 <br><br> <br>
                                                    <span style="color: black"><i class="fa fa-folder"></i> Dossier <?php echo e($agent->folderagent); ?></span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse">
                                            <div class="box-body">
                                                <table style="width: 100%;font-size:14px;" >
                                                    <thead style="font-size: 17px; text-align: center">
                                                    <tr>
                                                        <th>Nom </th>
                                                        <th style="text-align: center">Status</th>
                                                        <th>Date de modification</th>
                                                        <th>Type de fichier</th>
                                                        <th style="text-align: center">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <br>
                                                    <tbody>
                                                    <tr>
                                                        <td> <span style="color: black"><i class="fa fa-folder"></i> Dossier <?php echo e($agent->folderagent); ?></span></td>
                                                        <td style="text-align: center; font-size:12px;"></td>
                                                        <td><?php echo e($agent->titre_sejour ? $agent->updated_at : ''); ?> </td>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Titre de sejour (Recto)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->titre_sejour ? 'check': 'close'); ?>" style="color: <?php echo e($agent->titre_sejour  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->titre_sejour ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->titre_sejour): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->titre_sejour);
                                                                    if($e == 'pdf' ) {
                                                                      echo 'Document/'.$e;
                                                                    } else {
                                                                      echo 'Image/'.$e ;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->titre_sejour ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->titre_sejour); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Titre de sejour (Verso)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->titre_sejour_verso ? 'check': 'close'); ?>" style="color: <?php echo e($agent->titre_sejour_verso  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->titre_sejour_verso ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->titre_sejour_verso): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->titre_sejour_verso);
                                                                    if($e == 'pdf' ) {
                                                                      echo 'Document/'.$e;
                                                                    } else {
                                                                      echo 'Image/'.$e ;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->titre_sejour_verso ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->titre_sejour_verso); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Carte vitale (Recto)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->carte_vitale ? 'check': 'close'); ?>" style="color: <?php echo e($agent->carte_vitale  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->carte_vitale ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->carte_vitale): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->carte_vitale);
                                                                    if($e == 'pdf' ) {
                                                                        echo 'Document/'.$e;
                                                                      } else {
                                                                        echo 'Image/'.$e ;
                                                                      }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->carte_vitale ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->carte_vitale); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>

                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Permis de conduire(Recto)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->permis_conduire ? 'check': 'close'); ?>" style="color: <?php echo e($agent->permis_conduire  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->permis_conduire ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->permis_conduire): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->permis_conduire);
                                                                    if($e == 'pdf' ) {
                                                                        echo 'Document/'.$e;
                                                                      } else {
                                                                        echo 'Image/'.$e ;
                                                                      }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->permis_conduire ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->permis_conduire); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Permis de conduire (Verso)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->permis_conduire_verso ? 'check': 'close'); ?>" style="color: <?php echo e($agent->permis_conduire_verso  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->permis_conduire_verso ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->permis_conduire_verso): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->permis_conduire_verso);
                                                                    if($e == 'pdf' ) {
                                                                        echo 'Document/'.$e;
                                                                      } else {
                                                                        echo 'Image/'.$e ;
                                                                      }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->permis_conduire_verso ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->permis_conduire_verso); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Passeport (Recto)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->passport ? 'check': 'close'); ?>" style="color: <?php echo e($agent->passport  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->passport ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->passport): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->passport);
                                                                    if($e == 'pdf' ) {
                                                                          echo 'Document/'.$e;
                                                                        } else {
                                                                          echo 'Image/'.$e ;
                                                                        }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->passport ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->passport); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Passeport (Verso)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->passport_verso ? 'check': 'close'); ?>" style="color: <?php echo e($agent->passport_verso  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->passport_verso ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->passport_verso): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->passport_verso);
                                                                    if($e == 'pdf' ) {
                                                                          echo 'Document/'.$e;
                                                                        } else {
                                                                          echo 'Image/'.$e ;
                                                                        }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->passport_verso ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->passport_verso); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Carte nationnale (Recto)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->carte_nationale  ? 'check': 'close'); ?>" style="color: <?php echo e($agent->carte_nationale  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->carte_nationale ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->carte_nationale): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->carte_nationale);
                                                                    if($e == 'pdf' ) {
                                                                      echo 'Document/'.$e;
                                                                    } else {
                                                                      echo 'Image/'.$e ;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->carte_nationale ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->carte_nationale); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Carte nationnale (Verso)</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->carte_nationale_verso ? 'check': 'close'); ?>" style="color: <?php echo e($agent->carte_nationale_verso  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->carte_nationale_verso ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->carte_nationale_verso): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->carte_nationale_verso);
                                                                    if($e == 'pdf' ) {
                                                                    echo 'Document/'.$e;
                                                                  } else {
                                                                    echo 'Image/'.$e ;
                                                                  }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->carte_nationale_verso ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->carte_nationale_verso); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Récepisé </td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->recepice_titre_sejour ? 'check': 'close'); ?>" style="color: <?php echo e($agent->recepice_titre_sejour  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->recepice_titre_sejour ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->recepice_titre_sejour): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->recepice_titre_sejour);
                                                                    if($e == 'pdf' ) {
                                                                    echo 'Document/'.$e;
                                                                  } else {
                                                                    echo 'Image/'.$e ;
                                                                  }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->recepice_titre_sejour ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->recepice_titre_sejour); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Carte vaccin chien</td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->carte_vaccin_chien ? 'check': 'close'); ?>" style="color: <?php echo e($agent->carte_vaccin_chien  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->carte_vaccin_chien ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->carte_vaccin_chien): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->carte_vaccin_chien);
                                                                    if($e == 'pdf' ) {
                                                                    echo 'Document/'.$e;
                                                                  } else {
                                                                    echo 'Image/'.$e ;
                                                                  }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->carte_vaccin_chien ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'.$agent->carte_vaccin_chien); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-file"></i> Carte professionnelle </td>
                                                        <td style="text-align: center; font-size:12px;"><i class="fa fa-<?php echo e($agent->carte_professionnelle ? 'check': 'close'); ?>" style="color: <?php echo e($agent->carte_professionnelle  ? 'green' : 'red'); ?>"></i></td>
                                                        <td><?php echo e($agent->carte_professionnelle ? $agent->updated_at : ''); ?> </td>
                                                        <td>
                                                            <?php if($agent->carte_professionnelle): ?>
                                                                <?php
                                                                    list($ex ,$e) = explode('.',$agent->carte_professionnelle);
                                                                    if($e == 'pdf' ) {
                                                                      echo 'Document/'.$e;
                                                                    } else {
                                                                      echo 'Image/'.$e ;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if($agent->carte_professionnelle ): ?>
                                                                <a href="#"  class="label label-primary show_pick"  data-type ="<?php echo e($e); ?>" data-src="<?php echo e(asset('')); ?>../uploads/folder_agents/<?php echo e($agent->folderagent. '/'. $agent->carte_professionnelle); ?>" data-toggle="modal" data-target="#edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="box-footer pull-right">
                                        <button type="submit" class="btn btn-lg btn-primary">Modifier</button>
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

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" id="my_modal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(0, 0, 0); color: black;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel"><strong>Dossier : <?php echo e($agent->nom . ' '.$agent->prenoms); ?></strong></h4>
                </div>
                <div class="modal-body" id="content_medias">
                </div>
                <div class="modal-footer"style="background-color: rgb(0, 0, 0); color: black;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> </button>
                </div>

            </div>
        </div>
    </div>
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
    <script src="<?php echo e(asset('')); ?>assets/js/pdfobject.min.js"></script>

    <script type="text/javascript">

        //Affichae des champ des informations administrative
        var nationalite=$("select[name='nationalite'] :selected")
        var carteidentite=$("#div_carteidentite")
        var numerocarteidentite=$("#div_numerocarteidentite")
        var dateexpircni=$("#div_dateexpircni")
        var numeroetranger=$("#div_numeroetranger")
        var lieudelivrancecs=$("#div_lieudelivrancecs")
        var etablissementcartedesejour=$("#div_etablissementcartedesejour")
        var cartedesejour=$("#div_cartedesejour")
        var expirationcartedesejour=$("#div_expirationcartedesejour")

        $("select[name='nationalite']").change(function(){
            var SelectedValue = $("option:selected", this).val();
            displayElement(SelectedValue)
        })

        displayElement("<?php echo e(old('nationalite') ?: 'FR'); ?>")

        function displayElement(SelectedValue='FR'){
            if(SelectedValue==='FR'){
                //Show
                carteidentite.show(500)
                numerocarteidentite.show(500)
                dateexpircni.show(500)
                //Hide
                numeroetranger.hide(500)
                lieudelivrancecs.hide(500)
                etablissementcartedesejour.hide(500)
                cartedesejour.hide(500)
                expirationcartedesejour.hide(500)
            }else{
                //Show
                numeroetranger.show(500)
                lieudelivrancecs.show(500)
                etablissementcartedesejour.show(500)
                cartedesejour.show(500)
                expirationcartedesejour.show(500)
                //Hide
                carteidentite.hide(500)
                numerocarteidentite.hide(500)
                dateexpircni.hide(500)
            }
        }



    </script>

    <script type="text/javascript">
        //Affichage des champ de la qualification
        var ads=$("input[name='ads']")
        var maitrechien=$("input[name='maitrechien']")

        ads.change(function(){
            if ($(this).is(':checked')) {
                $("#div_numeroads").show(500)
            } else {
                $("#div_numeroads").hide(500)
            }
        })

        maitrechien.change(function(){
            if ($(this).is(':checked')) {
                $("#div_nomchien").show(500)
                $("#div_datevaliditevaccin").show(500)
            } else {
                $("#div_nomchien").hide(500)
                $("#div_datevaliditevaccin").hide(500)
            }
        })

    </script>

    <script type="text/javascript">
        //Affichae des champ des informations administrative
        var nationalite=$("select[name='typecontrat'] :selected")
        var div_dureeducontrat=$("#div_dureeducontrat")

        $("select[name='typecontrat']").change(function(){
            var SelectedValue = $("option:selected", this).val();
            displayDureeElement(SelectedValue)
        })

        displayDureeElement("<?php echo e(old('typecontrat') ?: 'cdi'); ?>")

        function displayDureeElement(SelectedValue='cdi'){
            if(SelectedValue==='cdi' || SelectedValue===''){
                //Hide
                div_dureeducontrat.hide(500)
            }else{
                //Show
                div_dureeducontrat.show(500)
            }
        }

        document.querySelectorAll('.show_pick').forEach(item => {
            item.addEventListener('click', function(e){
                e.preventDefault;

                if(this.getAttribute('data-type') === 'pdf') {
                    let content_medias = document.querySelector('#content_medias');
                    content_medias.innerHTML = '';
                    let pdf = document.createElement('pdf');
                    pdf.setAttribute('id', 'pdf_content');
                    document.querySelector('#content_medias').style.height="700px"
                    content_medias.appendChild(pdf);
                    PDFObject.embed(this.getAttribute('data-src'), "#pdf_content");
                }else {
                    let content_medias = document.querySelector('#content_medias');
                    content_medias.innerHTML = '';
                    let img = document.createElement('img');
                    img.setAttribute('src',this.getAttribute('data-src'));
                    content_medias.appendChild(img);
                }
            })
        })

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iziplanning\resources\views/pages/agents/edit.blade.php ENDPATH**/ ?>