
<?php
    use Carbon\Carbon;
?>
<div class="box-body form-block" >
    <div class="box-group" id="accordion">
    <!-- One "tab" for each step in the form: -->

    <div class="tab">
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
                <select class="form-control" name="civilite" required>
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
                <input name="nom" type="text" class="form-control"  placeholder="Entrer le nom" value="<?php echo e(old('nom') ?: $agent->nom); ?>" required>
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
                
                <input type="date" name="datenaissance" class="form-control pull-right" id="datepicker" min="<?php echo e(Carbon::now()->addYear(-100)->toDateString()); ?>" max="<?php echo e(Carbon::now()->addYear(-18)->toDateString()); ?>" value="<?php echo e(old('datenaissance') ?: $agent->datenaissance); ?>" required>
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
                    <select class="form-control" name="statutmatrimonial" required>
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
                    <input name="prenoms" type="text" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('prenoms') ?: $agent->prenoms); ?>" required>
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

    <div style="overflow:auto;margin-right: 26px">
        <div style="float:right;">
            <button type="button" class="btn btn-flat btn-primary suivant" onclick="submitForm('regForm')" data-route="<?php echo e(route('agent.addVerification')); ?>" data-type="form_1">Etape Suivante</button>
        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step active"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <!-- /.box-body -->
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/pages/agents/create/form_1.blade.php ENDPATH**/ ?>