@extends('admin.app-main')

@section('title', "Редактирование пользователя {$user->name}")

@section('content')

<div class="d-flex justify-content-between align-items-center my-5">
    <h2>Редактирование пользователя {{$user->name}}</h2>
    
</div>

<form action="{{route('update.user', $user->id)}}" method="POST" >
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Ваше имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}">
        @error('name')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
        @error('email')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="form-check mb-3">
        @foreach($roles as $role)
        
        <label class="form-check-label mx-3" for="{{'role_'. $role->id}}">
            <input class="form-check-input" type="checkbox" name="roles[]" id="{{'role_'. $role->id}}" value="{{$role->id}}"
            @if($user->roles->contains(old('role_'. $role->id,  $role->id))) checked @endif>
            {{$role->name}}
        </label>
        @endforeach
      </div>  
    <button type="submit" class="btn btn-info">Сохранить</button>
    
</form>

@endsection