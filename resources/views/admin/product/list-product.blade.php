@extends('admin.app-main')

@section('title', "Список товаров")

@section('content')
    <h3 class="text-center mb-4">Список товаров</h3>
    <div class="row">
        <div class="col-6 col-md-12 border d-flex justify-content-center flex-column">
          @if($products->count() == 0)
          <h5 class="text-center text-danger">Пока нет ни одного товара!</h5>
          @else
          <h4 class="text-center">Товары</h4>
          <table class="table table-hover ">
              <thead>
                  <tr>                      
                      <th scope="col">Название</th>
                      <th scope="col">Цена</th>
                      <th scope="col">Количество</th>
                      <th scope="col">Изображение</th>                      
                  </tr>
              </thead>
              <tbody>
                  @foreach ($products as $product)
                      <tr>
                          <td>{{ $product->title }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>
                              <img src="{{ asset('uploads/' . $product->image) }}" alt="foto" style="height: 50px"
                                  class="img-fluid">
                          </td>                          
                      </tr>
                  @endforeach
              </tbody>
          </table>        
          
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              @if($products->currentPage() != $products->onFirstPage())
                <li class="page-item">
                  <a class="page-link" href="{{$products->previousPageUrl()}}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              @endif
              
              @for($i=1; $i<= $products->lastPage();$i++)
                <li @if($i== $products->currentPage()) class="page-item active" @else class="page-item" @endif</li><a class="page-link" href="{{$products->url($i)}}">{{$i}}</a></li>
              @endfor  
              @if($products->currentPage() != $products->lastPage())
              <li>  
                <a class="page-link" href="{{$products->nextPageUrl()}}" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              @endif
              
            </ul>
          </nav>
            
        </div>
        @endif
    </div>
@endsection