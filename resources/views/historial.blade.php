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
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title ">Todos los productos:</h4>
    <p class="card-category"> Lista con el nombre y el precio de todos los productos de la tienda</p>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">

<?php
  if ($user_id < 4):
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

  <?php
  $users = \App\User::all();
  $ordenes = \App\Ordene::all();
  $ordenes_prod = \App\OrdenesProducto::all();
  echo "usuarioID " . $users[0]->id ;
  echo "ordenID" . $ordenes[0]->id ;
  echo "orden_prodID " . $ordenes_prod[0]->id ;

  foreach ($users as $user) {
    // echo "usuarioID " . $user->id ;

    foreach ($ordenes as $orden) {
      // echo "ordenID" . $orden->id ;

      foreach ($ordenes_prod as $ordenP) {
        // echo "orden_prodID " . $ordenP->id ;


      }
    }
  }










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













<script type="text/javascript">
alert('hola');
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "127.0.0.1",
  user: "vendedor",
  password: "okboomer"
  database: "tienda"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");

  con.query("SELECT * FROM productos", function (err, result, fields) {
   if (err) throw err;
   console.log(result);
  alert(result);

 });




});

</script>



</tbody>































<?php else: ?>

  <script language="javascript">
  alert("No tienes autoriazación para ver esta página.")
  </script>
  <meta http-equiv="refresh" content="0; URL='/admin'"/>

<?php endif ?>

@endsection
