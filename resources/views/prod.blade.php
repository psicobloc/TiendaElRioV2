
@extends('layouts.mainlayout')
@section('content')

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title ">Todos los productos:</h4>
    <p class="card-category"> Lista con el nombre y el precio de todos los productos de la tienda</p>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
          <thead class=" text-primary">
              <tr><th>
                Stock
              </th>
              <th>
                Nombre
              </th>
              <th>
                precio
              </th>
            </tr></thead>
              <tbody>
            @foreach ($productos as $producto)
                    <tr>
                      <td>
                        {{$producto->stock}}
                      </td>
                      <td>
                        {{$producto->nombre}}
                      </td>
                      <td class="text-primary">
                        $ {{$producto->precio}}
                      </td>
                    </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection
