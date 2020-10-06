
<div class="box-body form-block hide">
    <div class="box-group" id="accordion"></div>
    
    <div class="tab">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Téléchargement de fichier</a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse">
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
        </div>
    </div>

    <div style="overflow:auto;margin-right: 26px">
        <div style="float:right;">
            <button type="button" class="btn btn-flat btn-primary btn_customer_red  precedent">Etape Précédente</button>
            <button type="submit" class="btn btn-flat btn-primary btn_customer_green " data-route="<?php echo e(route('agent.addVerification')); ?>" data-type="form_5">Ajouter</button>
        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step active"></span>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/pages/agents/create/form_5.blade.php ENDPATH**/ ?>