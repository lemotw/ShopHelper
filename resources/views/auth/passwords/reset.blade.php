@extends('layouts.login')

@section('content')
    <div class="row row-index-btnpage">

        <h1 class="page-title">重設密碼</h1>
            
            
        <form class="login-group" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span style="font-size:8pt;color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
            <div class="form-group">
                <label for="InputPassword">密碼:</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span style="font-size:8pt;color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="InputPassword">密碼確認:</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
 
            
            <button type="submit" class="btn btn-primary">
                {{ __('登入') }}
            </button>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('忘了密碼?') }}
                </a>
            @endif

        </form>                    

    </div>
@endsection 