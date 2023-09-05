@extends('admin.app-main')

@section('title', 'Вход в аккаунт')

@section('content')

<div class="d-flex justify-content-between align-items-center my-5">
    <h2>Войти в аккаунт</h2>
    
</div>

@if(session('reqister_success'))

<div class="alert alert-success">
    {{session('reqister_success')}}
</div>
    
@endif

<form action="{{route('user.auth')}}" method="POST" >
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
        @error('email')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>    
    <button type="submit" class="btn btn-info">Войти</button>
    
</form>

@endsection