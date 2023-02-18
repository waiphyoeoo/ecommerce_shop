@extends('layout.master')
@section('content')
      <!-- End Header -->
      <div class="container mt-3">
         <div class="row">
            <!-- For Category and Information -->
            <div class="col-md-4">
               <div class="card">
                  <div class="card-body">
                     <ul class="list-group">
                        <li class="list-group-item bg-dark text-white">
                           Your Order List
                        </li>
                        <li class="list-group-item bg-danger text-white">
                           Your Profile Info
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="card">
                  <div class="card-body">
                     <ul class="list-group">
                        <li class="list-group-item bg-primary text-white">
                           All Category
                        </li>
                        @foreach ($categories as $category)
                        <li class="list-group-item">
                           {{ $category->name }}
                        <span class="badge badge-primary float-right">{{ $category->products_count }}</span>
                        </li>
                        @endforeach
                      
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-8" id="show">
             
            </div>
         </div>
      </div>
@endsection
@section('script')
      <script>
         window.slug = "{{ $slug }}"
      </script>
    <script src="{{ mix('js/show.js') }}"></script>
@endsection