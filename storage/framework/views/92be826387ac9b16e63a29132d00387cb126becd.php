<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Black Shield | Application</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <?php echo NoCaptcha::renderJs(); ?>

  <link rel="stylesheet" href="<?php echo e(asset('')); ?>dist/css/style.css">
</head>
<body class="hold-transition login-page">
  <div class="row contenu">
    
    <div class="col-md-6 lg-left">

     

      <div class="haut">
        <p>IZI PLANNING</p>
      </div>
      <div class="text-left">
        <p><b>Créer et générer</b> les plannings de vos agents partout et sur tous les supports en <b>quelques clics</b></p>
      </div>
      <div class="design">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
      <div class="bas"></div>

    </div>

    <div class="col-md-6 lg-right">

      <?php if($message = Session::get('errorlogin')): ?>
          <div class="alert alert-danger alert-dismissible show" id="notification" role="alert" style="">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> <?php echo e($message); ?>

          </div>
        <?php endif; ?> 

        <?php if($message = Session::get('dontexist')): ?>
            <div class="alert alert-danger alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Notification :</strong> <?php echo e($message); ?>

            </div>
          <?php endif; ?>

      <img src="<?php echo e(asset('')); ?>assets/img/blacksecuritylogo2.jpg" alt="logo black shielf security" class="logo">
      <p class="name">BLACK SHIELD SECURITY</p>

      <div class="card">
        <p class="text-center space-1">CONNEXION</p>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="row">
          <?php echo csrf_field(); ?>
          <label for="mail" class="col-4 form-control-plaintext">Adresse mail</label>
          <input name="email" type="mail" class="col-8 form-control" value="<?php echo e(old('email')); ?>">
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-feedback text-danger" role="alert">
              <strong><?php echo e($message); ?></strong>
            </span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <label for="pass" class="col-4 form-control-plaintext">Mot de passe</label>
          <input name="password"  type="password" class="col-8 form-control">
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-feedback text-danger" role="alert">
              <strong><?php echo e($message); ?></strong>
            </span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <div class="offset-4 col-5 pl-3 checkbox icheck space remember">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            <label for="remember"><small> Se souvenir de moi </small></label>
          </div>
          <?php if(Route::has('password.request')): ?>
            <a class="btn-link col-3 acces" href="<?php echo e(route('password.request')); ?>">
              <small>Accès oublié ?</small>
            </a>
          <?php endif; ?>
          
          
          <button type="submit" class="btn space row">Se connecter</button>
        </form>

        <p class="copyright">© Copyright COM&TIC 2020</p>
      </div>

    </div>

  </div>
</body>
<?php /**PATH /Applications/MAMP/htdocs/iziplanning/resources/views/auth/login.blade.php ENDPATH**/ ?>