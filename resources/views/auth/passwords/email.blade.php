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
  <link rel="stylesheet" href="{{asset('')}}dist/css/style.css">
</head>
<body class="hold-transition login-page">
  <div class="row contenu">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
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
      <img src="{{asset('')}}assets/img/blacksecuritylogo2.jpg" alt="logo black shielf security" class="logo">
      <p class="name">BLACK SHIELD SECURITY</p>

      <div class="card" style="width:70%">
        <p class="text-center space-1" style="font-size: 1.5vw !important">Réinitialisation du Mot de passe</p>
        <small class="text-center space-1">
          Vous avez oublié votre mot de passe? <br> Entrez l'adresse mail de votre compte et nous vous enverrons un lien de réinitialisation
        </small>

        <form method="POST" action="{{ route('password.email') }} class="row">
          @csrf
          <label for="mail" class="col-12 form-control-plaintext space" style="font-weight:bold; margin-bottom:2%;padding:0">Adresse mail</label>
          <input name="email" type="mail" id="mail" class="col-12 form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="exemple@mail.com" style="margin-bottom:4%">
          @error('email')
            <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <button type="submit" class=" space col-12 btn" style="margin-top:0 !important">
            validez
          </button>
          {{-- <button type="submit" class="btn space row">Se connecter</button> --}}
        </form>

        <p class="copyright">© Copyright COM&TIC 2020</p>
      </div>

    </div>

  </div>
</body>



{{-- <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif --}}
          {{-- <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
              </div>
            </div>
            
          </form> --}}
        {{-- </div>
      </div>
    </div>
  </div>
</div> --}}

