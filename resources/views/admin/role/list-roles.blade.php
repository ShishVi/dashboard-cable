@extends('admin.app-main')

@section('title', 'Роли')

@section('content')
<h3 class="text-center">Роли</h3>
<div class="d-flex justify-content-end">
  <a  role="button" class="btn btn-info btn-sm mb-3" href="{{route('create.role')}}">Добавить роль</a>
</div>


<table class="table table-hover">
    <thead>
      <tr>        
        <th scope="col">Роль</th>                        
        <th scope="col">Действие</th>
      </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>        
           
            <td>{{$role->name}}</td>                              
            <td>
                <div class="d-flex">                    
                    <form action="{{route('delete.role', $role->id)}}" method="POST">
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