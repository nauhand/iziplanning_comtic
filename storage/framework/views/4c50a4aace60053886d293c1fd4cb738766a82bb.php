

<div class="box-body form-block hide">
    <div class="box-group" id="accordion">
    <!-- One "tab" for each step in the form: -->

        <div class="tab">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    Informations administratives
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nationalité</label>
                            <?php echo e($agent->nationalite); ?>

                            <select class="form-control nationalite" name="nationalite">
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
                        <div class="form-group numeropermis <?php $__errorArgs = ['numeropermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
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
                        <div class="form-group lieudelivrancepermis <?php $__errorArgs = ['lieudelivrancepermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <label>Lieu de délivrance du permis</label>
                            <input name="lieudelivrancepermis" type="text" class="form-control"  placeholder="Entrer le lieu de délivrance du permis" value="<?php echo e(old('lieudelivrancepermis') ?: $agent->lieudelivrancepermis); ?>">
                            <?php $__errorArgs = ['lieudelivrancepermis'];
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
                        <div class="form-group dateetablpermis <?php $__errorArgs = ['dateetablpermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <label>Date d'établissement du permis</label>
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













                        <div class="form-group categoriepermis <?php $__errorArgs = ['categoriepermis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <label>Catégorie du permis</label>
                            <select name="categoriepermis[]" class="form-control select2" multiple="multiple" data-placeholder="Entrer la catégorie du permis" style="width: 100%;">
                                <option value="AM" <?php echo e(in_array('AM',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Catégorie AM</option>
                                <option value="A" <?php echo e(in_array('A',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis A</option>
                                <option value="A1" <?php echo e(in_array('A1',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis A1</option>
                                <option value="A2" <?php echo e(in_array('A2',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis A2</option>
                                <option value="B" <?php echo e(in_array('B',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis B</option>
                                <option value="B1" <?php echo e(in_array('B1',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis B1</option>
                                <option value="BE" <?php echo e(in_array('BE',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis BE</option>
                                <option value="C" <?php echo e(in_array('C',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis C</option>
                                <option value="C1" <?php echo e(in_array('C1',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis C1</option>
                                <option value="CE" <?php echo e(in_array('CE',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis CE</option>
                                <option value="C1E" <?php echo e(in_array('C1E',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis C1E</option>
                                <option value="D" <?php echo e(in_array('D',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis D</option>
                                <option value="D1" <?php echo e(in_array('D1',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis D1</option>
                                <option value="DE" <?php echo e(in_array('DE',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis DE</option>
                                <option value="D1E" <?php echo e(in_array('D1E',old('categoriepermis') ?: array()) ? 'selected' : null); ?>>Permis D1E</option>
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
                        <div class="form-group numerocni <?php $__errorArgs = ['numerocni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_carteidentite">
                            <label>Numéro Carte Nationale d’Identité (*)</label>
                            <input name="numerocni" type="text" class="form-control"  placeholder="Entrer le numéro de la carte nationale d’identité " value="<?php echo e(old('numerocni') ?: $agent->numerocni); ?>">
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
                        <div class="form-group numeroetranger <?php $__errorArgs = ['numeroetranger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_numeroetranger" style="display: none">
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
                        <div class="form-group typetitresejour <?php $__errorArgs = ['typetitresejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_typetitresejour">
                            <label>Type de titre de séjour</label>
                            <select name="typetitresejour" id="typetitresejour" class="form-control">
                                <option value="Carte de séjour">Carte de séjour</option>
                                <option value="Récépissé">Récépissé du titre de séjour</option>
                            </select>
                            
                            <?php $__errorArgs = ['typetitresejour'];
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
                        <div class="form-group lieudelivrancecs <?php $__errorArgs = ['lieudelivrancecs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_lieudelivrancecs" style="display: none">
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
                        <div class="form-group etablissementcartedesejour <?php $__errorArgs = ['etablissementcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_etablissementcartedesejour" style="display: none">
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
                        <div class="form-group expirationcartedesejour <?php $__errorArgs = ['expirationcartedesejour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="div_expirationcartedesejour" style="display: none">
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
                        <div class="form-group numeross <?php $__errorArgs = ['numeross'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                            <label>Numéro de sécurité sociale</label>
                            <input name="numeross" type="text" class="form-control"  placeholder="Entrer le numéro de sécurité sociale" value="<?php echo e(old('numeross') ?: $agent->numeross); ?>">
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

        <div style="overflow:auto;margin-right: 26px">
            <div style="float:right;">
                <button type="button" class="btn btn-flat btn-primary btn_customer_red  precedent" id="nextBtn">Etape Précédente</button>
                <button type="button" class="btn btn-flat btn-primary suivant" data-route="<?php echo e(route('agent.addVerification')); ?>" data-type="form_3">Etape Suivante</button>
            </div>
        </div>

        <div style="text-align:center;margin-top:40px;">
            <span class="step finish"></span>
            <span class="step finish"></span>
            <span class="step active"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    <!-- /.box-body -->
    </div>
</div>
<?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/pages/agents/create/form_3.blade.php ENDPATH**/ ?>