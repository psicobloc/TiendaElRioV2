
@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth; ?>
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

        <?php
        try {
          $user_id = auth()->user()->role->id;

        } catch (Exception $e) {

          $user_id = 1000;
        }

        if ($user_id < 4):
          echo "rol: ",  auth()->user()->role->display_name;
            echo "<thead class=" . "text-primary" . ">
                <tr><th>
                  Stock
                </th>
                <th>
                  Nombre
                </th>
                <th>
                  Categoría
                </th>
                <th>
                  precio
                </th>
              </tr></thead>
                <tbody>";
                ?>

                @foreach ($productos as $producto)
                        <tr>
                          <td>
                            {{$producto->stock}}
                          </td>
                          <td>
                            {{$producto->nombre}}
                          </td>
                          <td>
                            {{$categorias[$producto->id_categoria - 1]->nombre_categoria}}
                            <!-- {{$producto->id_categoria}} -->
                          </td>
                          <td class="text-primary">
                            $ {{$producto->precio}}
                          </td>
                        </tr>
                @endforeach
            </tbody>

          <?php else: ?>

            <script language="javascript">
            alert("No tienes autoriazación para ver esta página.")
            </script>
            <meta http-equiv="refresh" content="0; URL='/admin'"/>

        <?php endif ?>

      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection
