@extends('admin.app-main')

@section('title', "Создание роли")

@section('content')
<h3 class="text-center mb-4">Создание роли</h3>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <form action="{{route('store.role')}}" method="POST" enctype="multipart/form-data" >
                @csrf 
                <div class="mb-3">
                    <label for="name" class="form-label">Роль</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>               
                
                <button type="submit" class="btn btn-info btn-sm">Создать</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('list.roles') }}">Отмена</a>


            </form>

        </div>       
    </div>
@endsection