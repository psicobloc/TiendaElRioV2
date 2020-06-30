@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth; ?>

<?php
try {
  $user_id = auth()->user()->role->id;

} catch (Exception $e) {

  $user_id = 1000;
}
?>
<body class="dark-edition">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">


<?php if ($user_id < 4):

  $users = \App\User::all();
  $ordenes = \App\Ordene::all();
  $ordenes_prod = \App\OrdenesProducto::all();
  $productos = \App\Producto::all();
  $arrayProd = (array)$productos;

  foreach ($users as $user) {
    echo "<div class=\"card\">" . "<div class=\"card-header card-header-primary\">" . "<h4 class=\"card-title\"> " . $user->name . "</h4>";
    echo "<p class=\"card-category\"> ventas por usuario</p>" . "</div>" . "<div class=\"card-body\">";
    echo "  <div class=\"table-responsive\">" . "<table class=\"table\">";

    foreach ($ordenes as $orden) {
      if ($orden->id_usuario == $user->id) {
        echo "<p class=\"text-success\"> Orden: " . $orden->id . " Usuario " . $orden->id_usuario . " Total: $" . $orden->total . "  Fecha: " . $orden->fecha . "</p>" ;
        echo "<thead class=" . "text-primary" . ">
            <tr><th>
              ID producto
            </th>
            <th>
              Nombre
            </th>
            <th>
              Precio
            </th>
            <th>
              Cantidad
            </th>
          </tr></thead>
            <tbody>";

      foreach ($ordenes_prod as $ordenP) {
        if ($ordenP->id_orden == $orden->id ) {
          foreach ($productos as $prod) {
            if ($ordenP->id_producto == $prod->id) {
              echo "<tr><td>" . $prod->id . "</td><td>" . $prod->nombre . "</td><td>$ " . $prod->precio . "</td><td>" . $ordenP->cantidad . "</td></tr>";
            }
          }
        }
      }
    }
      ///imprimir una division en la tabla (fila vacia?)
    }
echo "</tbody> </table>
</div>
</div>
</div>";
  }
  ?>

</div>
</div>
</div>
</body>

<?php else: ?>

  <script language="javascript">
  alert("No tienes autoriazación para ver esta página.")
  </script>
  <meta http-equiv="refresh" content="0; URL='/admin'"/>

<?php endif ?>

@endsection
