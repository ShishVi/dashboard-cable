@extends('admin.app-main')

@section('title', "Создание каталога")

@section('content')
<h3 class="text-center mb-4">Создание каталога</h3>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <form action="{{route('store-form.category')}}" method="POST" enctype="multipart/form-data" >
                @csrf 
                <div class="mb-3">
                    <label for="category" class="form-label">Наименование</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{old('category')}}">
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="mb-3">
                  <label for="image" class="form-label">Фото</label>
                  <input type="file" name="image" id="image" class="form-control">                  
                </div>
                
                <button type="submit" class="btn btn-info btn-sm">Создать</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('categories.list') }}">Отмена</a>


            </form>

        </div>       
    </div>
@endsection
