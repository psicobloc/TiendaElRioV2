<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

try {
  $user_id = auth()->user()->role->id;

} catch (Exception $e) {

  $user_id = 1000;
}


//Log::info('Usuario/a: ' . auth()->user()->id . ' editó ' . $data);
//use Illuminate\Support\Facades\Log;


$data = $request->all();


$servername = "localhost";
$username = "vendedor";
$password = "okboomer";
$dbname = "tienda";

//$data = json_decode(file_get_contents('php://input'), true);
//$data = json_decode($_POST["venta"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//$json = '[[1,2,1,9.5],[1,3,1,50],[1,4,1,360]]';
//$data = json_decode($json);
$total = 0;
$fecha = date('Y-m-d');
$timestamp = date('Y-m-d H:i:s');

foreach ($data as $prod) {
  $total = $total + ($prod[2] * $prod[3]);
}

//echo $total;

$sql = "INSERT INTO ordenes (`id_usuario`,`status`, `fecha`, `total`) VALUES ({$data[0][0]}, 'Pagada', '{$fecha}', {$total})";

$result = $conn->query($sql);

if ($result) {

  //echo "Orden Creada!\n";

  $orden = $conn->insert_id;

  Log::info('Usuario/a: ' . $data[0][0] . ' creó una nueva venta con id: ' . $orden);

  foreach ($data as $prod) {
    // code...
    //echo $prod[2];

    $sql = "INSERT INTO ordenes_productos (`id_orden`, `id_producto`, `cantidad`, `created_at`, `updated_at`) VALUES ({$orden}, {$prod[1]}, {$prod[2]}, '{$timestamp}', '{$timestamp}')";

    $result = $conn->query($sql);

    if ($result) {

      //echo "Orden_producto insertado!\n";

      $sql = "UPDATE productos SET stock = stock - {$prod[2]} WHERE id = {$prod[1]}";

      $result = $conn->query($sql);

      if ($result) {

        echo "Producto actualizado!\n";

      } else {

        //echo "Error al actualizar producto\n";
        //echo "Error: " . $sql . "<br>" . $conn->error;

      }

    } else {
      //echo "Error al insertar orden_producto\n";
      //echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }

} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

 ?>
