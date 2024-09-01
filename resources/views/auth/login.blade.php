{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <div class="login-wrapper">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Login</h2>
        <div class="input-field">
          <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" />
          <label>Enter your email</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" required autocomplete="password"/>
          <label>Enter your password</label>
          @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>
        <div class="password-options">
          <label for="remember">
            <input type="checkbox" id="remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
            <p>Remember me</p>
          </label>
          <a href="#">Forgot password</a>
        </div>
        <button type="submit">Log In</button>
      </form>
    </div>
  </body>
</html> --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- App CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('/auth/style_login.css') }}">
</head>

<body class="app app-login p-0">


    <form method="post" action="{{ route('login') }}">

        @csrf
        @method('POST')

        <div class="box">
            <h1>Dashboard</h1>

            <input type="email" name="email" class="email" />

            <input type="password" name="password" class="email" />

            <div class="btn-container">
                <button type="submit"> Login</button>
            </div>

            <!-- End Btn -->
            <!-- End Btn2 -->
        </div>
        <!-- End Box -->
    </form>



</body>

</html>
