
@extends('admin.app-main')

@section('title', 'Каталог товаров')

@section('content')
<h3 class="text-center">Каталог товаров</h3>
<div class="d-flex justify-content-end">
  <a  role="button" class="btn btn-info btn-sm mb-3" href="{{route('create.category')}}">Создать каталог</a>
</div>


<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Наименование</th>
        <th scope="col">Символьный код</th>
        <th scope="col">Сортировка</th>
        <th scope="col">Изображение</th>
        <th scope="col">Действие</th>
      </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>        
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->category}}</td>
            <td>{{$category->slug}}</td>
            <td>{{$category->products->count()}}</td>
            <td>
              <img src="{{$category->getImage()}}" alt="{{$category->slug}}" style="height: 50px">              
            </td>
            <td>
                <div class="d-flex">
                    <a href="{{route('edit.category', $category->id)}}">
                        <img  width="20" height="20" class="img-profile mx-2" src="{{ asset('assets/img/icon-edit.png') }}">
                    </a>
                    <form action="{{route('category.delete', $category->id)}}" method="POST">
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