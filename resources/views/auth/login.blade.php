@extends('auth.template')
@section('content')
<main class="form-signin">
    <form action="{{ route('login.post') }}" method="post" autocomplete="off">
        <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
        @include('alert')
        @csrf
        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        
    </form>
</main>
@endsection