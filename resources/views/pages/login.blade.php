@extends('layouts.default')

<title>Log in</title>


@section('content')
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-xs p-5 border rounded border-dark">
            <form name="form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="username" id="floatingInput username" placeholder="Username">
                  <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword password" name="password" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" name="remember_me" value="1" id="rememberPasswordCheck">
                  <label class="form-check-label" for="rememberPasswordCheck">
                    Remember password
                  </label>
                </div>
                {{-- error --}}
                @if (session()->has('incorrect'))
                    <p class="text-danger">Incorrect Username or Password</p>
                @elseif($errors->any())
                    <p class="text-danger">Incorrect Username or Password</p>
                @endif
                <div class="d-grid">
                  <button class="btn btn-lg btn-dark btn-login text-uppercase fw-bold mb-2" type="submit" name="submit">Sign in</button>
                  <div class="text-center">
                    <a class="small" href="#forgot-pass.php">Forgot password?</a>
                  </div>
                </div>
              </form>
        </div>
    </main>
@endsection
