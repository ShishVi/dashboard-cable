@extends('admin.app-main')

@section('title', "Редактирование каталога {$category->category}")

@section('content')
    <h3 class="text-center mb-4">Редактирование каталога "{{ $category->category }}"</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('update.category', $category->id) }} "method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="category" class="form-label">Наименование</label>
                    <input type="text" class="form-control" id="category" name="category"
                        value='{{ old('category', $category->category) }}'>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Символьный код (URL)</label>
                    <input class="form-control" id="slug" name="slug" value='{{ old('slug', $category->slug) }}' />
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Фото</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($category->image)
                    <div class="my-3">
                      <img style="height: 100px" src="{{$category->getImage()}}" alt="{{$category->slug}}">
                      <a href="{{route('remove-image.category', $category->id)}}" role="button" class="btn btn-sm btn-danger">Удалить фото</a>
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-info btn-sm">Сохранить</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('categories.list') }}">Отмена</a>


            </form>

        </div>
        <div class="col-6 col-md-8 border">
          @if($category->products()->get()->count() == 0)
          <h5 class="text-center text-danger">В этой категории пока нет товаров!</h5>
          @else
          <h4 class="text-center">Товары</h4>
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Название</th>
                      <th scope="col">Цена</th>
                      <th scope="col">Количество</th>
                      <th scope="col">Изображение</th>
                      <th scope="col">Действие</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($category->products()->get() as $product)
                      <tr>
                          <th scope="row">{{ $product->id }}</th>
                          <td>{{ $product->title }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>
                              <img src="{{ asset('uploads/' . $product->image) }}" alt="foto" style="height: 50px"
                                  class="img-fluid">
                          </td>
                          <td>
                              <div class="d-flex">
                                  <a href="{{ route('edit.category', $category->id) }}">
                                      <img width="20" height="20" class="img-profile mx-2"
                                          src="{{ asset('assets/img/icon-edit.png') }}">
                                  </a>
                                  <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                      @csrf @method('DELETE')
                                      <button class="btn btn-outline-light btn-sm"
                                          onclick='event.preventDefault();
                          if(confirm("Запись будет удалена! Продолжить?")){
                                      this.closest("form").submit();
                                  }'>
                                          <img width="20" height="20" class="img-profile"
                                              src="{{ asset('assets/img/icon-delete.png') }}">
                                      </button>
                                  </form>
                              </div>


                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          @endif
            
        </div>
    </div>
@endsection
