@extends('admin.app-main')

@section('title', 'Список пользователей')

@section('content')
<h3 class="text-center">Список пользователей</h3>
<div class="d-flex justify-content-end">
  <a  role="button" class="btn btn-info btn-sm mb-3" href="{{route('user.registr')}}">Добавить пользователя</a>
</div>


<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Имя</th>
        <th scope="col">Логин</th>
        <th scope="col">Роль</th>        
        <th scope="col">Действие</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>        
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              <ul>
                @foreach($user->roles as $role)
                <li>{{$role->name}}</li>
                @endforeach

              </ul>
            
            </td>            
            <td>
                <div class="d-flex">
                    <a href="{{route('edit.user', $user->id)}}">
                        <img  width="20" height="20" class="img-profile mx-2" src="{{ asset('assets/img/icon-edit.png') }}">
                    </a>
                    <form action="{{route('delete.user', $user->id)}}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-light btn-sm" onclick='event.preventDefault();
                        if(confirm("Запись будет удалена! Продолжить?")){
                                    this.closest("form").submit();
                                }'>
                        <img  width="20" height="20" class="img-profile" src="{{ asset('assets/img/icon-delete.png') }}">
                        </button>
                    </form>
                </div>
                
                
            </td>        
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection