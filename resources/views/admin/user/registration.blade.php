@extends('admin.app-main')

@section('title', 'Регистрация')

@section('content')

<div class="d-flex justify-content-between align-items-center my-5">
    <h2>Регистрация</h2>
    
</div>

<form action="{{route('user.store')}}" method="POST" >
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Ваше имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        @error('name')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
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
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Повторите пароль</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        @error('password_confirmation')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-info">Регистрация</button>
    
</form>

@endsection