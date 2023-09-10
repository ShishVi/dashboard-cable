@extends('admin.app-main')

@section('title', "Редактирование товара {$product->title}")

@section('content')
    <h3 class="text-center mb-4">Редактирование товара "{{ $product->title }}"</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('update.product', $product->id)}}"method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Наименование</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value='{{ old('price', $product->title)}}'>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value='{{ old('price', $product->price)}}'>
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Количество</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                        value='{{ old('quantity', $product->quantity)}}'>
                    @error('quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Каталог товаров</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="" select disabled>Выберите каталог товаров</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == old('category_id', $product->category_id)) selected @endif>{{$category->category}}</option>
                        @endforeach

                    </select>
                </div>                
                <div class="mb-3">
                    <label for="image" class="form-label">Фото</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($product->image)
                    <div class="my-3">
                      <img style="height: 100px" src="{{$product->getImage()}}" alt="{{$product->slug}}">
                      <a href="{{route('remove-image.product', $product->id)}}" role="button" class="btn btn-sm btn-danger">Удалить фото</a>
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-info btn-sm">Сохранить</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('categories.list') }}">Отмена</a>


            </form>

        </div>   
    </div>
@endsection
