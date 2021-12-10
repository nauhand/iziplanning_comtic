
<div class="box-body form-block hide">
    <div class="box-group" id="accordion"></div>
  
      <div class="tab">
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
              <div class="form-group typecontrat <?php $__errorArgs = ['typecontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label>Type de Contrat (*)</label>
                <select class="form-control" name="typecontrat" required>
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
                    <input type="checkbox" name="ads" id="same" class="check">
                   ADS
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="maitrechien" id="same" class="check">
                    Maitre chien
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ssiap1" class="check">
                    SSIAP1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ssiap2" class="check">
                    SSIAP2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="chefequipe" class="check">
                    Chef d'équipe
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="superviseur" class="check">
                    Superviseur
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="commercial" class="check">
                    Commercial
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="agentcontrole" class="check">
                    Agent de contôle
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="assitanceRh" class="check">
                    Assistance RH
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="responsableRh" class="check">
                    Responsable RH
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable_assistant" class="check">
                    Assistance comptable
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable" class="check">
                    comptable
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable_expert" class="check">
                    Expert Comptable
                  </label>
                </div>
              </div>
              <div class="form-group dateentree <?php $__errorArgs = ['dateentree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label>Date d'entré (*)</label>
                <input name="dateentree" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('dateentree') ?: $agent->dateentree); ?>" required>
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
            <div class="form-group datelimitecarteproffess <?php $__errorArgs = ['datelimitecarteproffess'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
              <label>Date limite carte professionnelle (*)</label>
              <input name="datelimitecarteproffess" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="<?php echo e(old('datelimitecarteproffess') ?: $agent->datelimitecarteproffess); ?>" required>
              <?php $__errorArgs = ['datelimitecarteproffess'];
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
              <div class="form-group dureeducontrat <?php $__errorArgs = ['dureeducontrat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_dureeducontrat" style="display: none;">
                <label>Durée du Contrat (*)</label>
                <input type="number" class="form-control" <?php echo e(old('dureeducontrat')); ?> name="dureeducontrat" placeholder="mois">
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
              <div class="form-group numerocartepro <?php $__errorArgs = ['numerocartepro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label> Numéro carte professionnelle (*)</label>
                <input name="numerocartepro" type="text" class="form-control"  placeholder="Entrer le numéro de la carte professionnelle" value="<?php echo e(old('numerocartepro') ?: ''); ?>">
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
              <div class="form-group numeroads <?php $__errorArgs = ['numeroads'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_numeroads" hidden>
                <label> Numéro ADS (*)</label>
                <input name="numeroads" type="text" class="form-control"  placeholder="Entrer le numéro de la carte professionnelle" value="<?php echo e(old('numeroads') ?: $agent->numeroads); ?>">
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
              <div class="form-group nomchien <?php $__errorArgs = ['nomchien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_nomchien" hidden>
                <label>Nom du chien (*)</label>
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
              <div class="form-group datevaliditevaccin <?php $__errorArgs = ['datevaliditevaccin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_datevaliditevaccin" hidden>
                <label>Date de validité du vaccin (*)</label>
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
            </div>
          </div>
        </div>
      </div>
  
      <div style="overflow:auto;margin-right: 26px">
        <div style="float:right;">
          <button type="button" class="btn btn-flat btn-primary precedent">Etape Précédente</button>
          <button type="button" class="btn btn-flat btn-primary suivant" data-route="<?php echo e(route('agent.addVerification')); ?>" data-type="form_4">Etape Suivante</button>
        </div>
      </div>
  
      <div style="text-align:center;margin-top:40px;">
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step active"></span>
        <span class="step"></span>
      </div>
    <!-- /.box-body -->
  </div>
  <?php /**PATH C:\xampp\htdocs\iziplanning\resources\views/pages/agents/create/form_4.blade.php ENDPATH**/ ?>