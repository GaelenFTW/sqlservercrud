

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Register</button>
    </form>

    <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
