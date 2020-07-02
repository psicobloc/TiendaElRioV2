@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth;
require_once "/var/www/html/tienda/tienda". '/vendor/autoload.php';
?>

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

  $html = "<body class=\"dark-edition\"><div class=\"container-fluid\"><div class=\"row\"><div class=\"col-md-12\">";


$idOrdenSelected = 24; //variable con la seleccion

foreach ($ordenes as $key ) {
   if ($key->id == $idOrdenSelected) {
       $ordenSelected = $key;
   }
}

//
foreach ($users as $user){
   //if es el usuario de la orden
   if ($user->id == $ordenSelected->id_usuario) {
     //echo "<div class=";
     echo "<div class=\"card\">" . "<div class=\"card-header card-header-primary\">" . "<h4 class=\"card-title\"> " . $user->name . "</h4>";

       //echo " <div class=\"card\"> " . "<div class=\"card-header card-header-primary\">" . "<h4 class=\"card-title\"> " . $user->name . "</h4>";
       $html = $html . "<div class=\"card\">" . "<div class=\"card-header card-header-primary\">" . "<h4 class=\"card-title\"> " . $user->name . "</h4>";
       echo "<p class=\"card-category\"> ventas por usuario</p>" . "</div>" . "<div class=\"card-body\">";
       $html = $html . "<p class=\"card-category\"> ventas por usuario</p>" . "</div>" . "<div class=\"card-body\">";
       echo "  <div class=\"table-responsive\">" . "<table class=\"table\">";
       $html = $html . "  <div class=\"table-responsive\">" . "<table class=\"table\">";

    foreach ($ordenes as $orden){
        //if el id de orden es el mismo que el ingresado
        if ($orden->id == $ordenSelected->id) {
            echo "<thead class=" . "text-primary" .">
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
                $html = $html . "<thead class=" . "text-primary" .">
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

         foreach ($ordenes_prod as $ordenP)
         {
           if ($ordenP->id_orden == $orden->id ) {
               foreach ($productos as $prod) {
                 if ($ordenP->id_producto == $prod->id) {
                   echo "<tr><td>" . $prod->id . "</td><td>" . $prod->nombre . "</td><td>$ " . $prod->precio . "</td><td>" . $ordenP->cantidad . "</td></tr>";
                   $html = $html . "<tr><td>" . $prod->id . "</td><td>" . $prod->nombre . "</td><td>$ " . $prod->precio . "</td><td>" . $ordenP->cantidad . "</td></tr>";
                 }
               }
             }
         }
         echo "<tr><td class=\"text-primary\" >" . " ID orden: " . $orden->id . "</td><td class=\"text-warning\" >" . "Total: $ ". $orden->total . "</td><td class=\"text-info\" > " . "Fecha: " . $orden->fecha . "</td><td>" . "</td></tr>";
         $html = $html . "<tr><td class=\"text-primary\" >" . " ID orden: " . $orden->id . "</td><td class=\"text-warning\" >" . "Total: $ ". $orden->total . "</td><td class=\"text-info\" > " . "Fecha: " . $orden->fecha . "</td><td>" . "</td></tr>";

     }
    }
    echo "</tbody> </table>
    </div>
    </div>
    </div>";
    $html = $html . "</tbody> </table>
     </div>
     </div>
     </div>";
}
}

$html = $html . "</div>
</div>
</div>
</body>";

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('prueba.pdf');

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
