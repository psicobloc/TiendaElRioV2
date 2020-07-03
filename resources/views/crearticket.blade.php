@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth; ?>
<?php
try {
  $user_id = auth()->user()->role->id;
  $user_name = auth()->user()->name;
} catch (Exception $e) {
  $user_id = 1000;}
  if ($user_id < 4):

    $ordenes = \App\Ordene::all();
    $ordenes_prod = \App\OrdenesProducto::all();
    $productos = \App\Producto::all();
?>

<script type="text/javascript">

var productos = <?php echo json_encode($productos); ?>;
var ordenes = <?php echo json_encode($ordenes); ?>;
var ordenes_prod = <?php echo json_encode($ordenes_prod); ?>;
var users = <?php $users = \App\User::all(); echo json_encode($users); ?>;
var user_name = <?php echo json_encode($user_name); ?>;
var user_id = <?php echo json_encode($user_id); ?>;

</script>

<body class="dark-edition">
<div class="col-md-8">
  <form action="http://34.68.116.225/tickets.blade.php" method="post">
    @csrf

    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Selecciona el ID de la orden</h4>
        <p class="card-category">Puedes consultar las ordenes en el historial.</p>
      </div>
      <div class="card-body">
        <?php   echo "<p id=\"verde\" class=\"text-success\"> Usuario " .  $user_name . "</p>" ; ?>
        <form>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group bmd-form-group">
                Orden id:
                <select id="select_ordenes" class="form-control @error('select_ordenes') is-invalid @enderror" name="select_orden" value="{{ old('select_orden') }}">
                  @foreach ($ordenes as $orden)
                  <option value='{{$orden->id}}'>{{$orden->id}}</option>
                  @endforeach
                </select>
                @error('select_productos')
                        <div class="ID inválido">{{ $message }}</div>
                    @enderror
              </div>
            </div>
            <div class="col-md-4">
              <a onclick="printDiv()" class="btn btn-primary btn-round" style="background-color:#ee4c0d"> Imprimir ticket </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
           </div>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </form>
</div>
</body>

<script type="text/javascript">
  var htmlPDF = "";

  function printDiv() {
    var e = document.getElementById("select_ordenes");
    var idOrdenSelected =  parseInt(e.options[e.selectedIndex].value);
    var ordenSelectedObj = "";

    ordenes.forEach((or, ior) => {
      if (or.id == idOrdenSelected) {
         ordenSelectedObj = or;
      }
    });


    users.forEach((usuario, index) => {
       //htmlPDF += "x";
       //if es el usuario de la orden
       if (usuario.id == ordenSelectedObj.id_usuario) {
         htmlPDF += "<div class=\"card\">" + "<div class=\"card-header card-header-primary\">" + "<h4 class=\"card-title\"> " + usuario.name + "</h4>";
         htmlPDF += "<p class=\"card-category\"> ventas por usuario</p>" + "</div>" + "<div class=\"card-body\">";
         htmlPDF += "  <div class=\"table-responsive\">" + "<table class=\"table\">";

         ordenes.forEach((orden, i) => {
           //if el id de orden es el mismo que el ingresado
           if (orden.id == ordenSelectedObj.id) {//puede ser tambien idOrdenSelected
             htmlPDF += "<thead class= \"text-primary\" ><tr><th>ID producto</th><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr></thead><tbody>";

             ordenes_prod.forEach((ordenProd, iop) => {
               //if id orden es igual al id_orden de orden_producto
               if (ordenProd.id_orden == orden.id) {
                productos.forEach((prod, ip) => {
                  //si el id de producto es el mismo que el que esta en el id_prod de ordenProd
                  if (ordenProd.id_producto == prod.id) {

                    htmlPDF += "<tr><td>" + prod.id + "</td><td>" + prod.nombre + "</td><td>$ " + prod.precio + "</td><td>" + ordenProd.cantidad + "</td></tr>";

                  }
                });

               }
             });
               htmlPDF += "<tr><td class=\"text-primary\" >" + " ID orden: " + orden.id + "</td><td class=\"text-warning\" >" + "Total: $ "+ orden.total + "</td><td class=\"text-info\" > " + "Fecha: " + orden.fecha + "</td><td>" + "</td></tr>";
           }
         });
       }
    });








    let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
    mywindow.document.write(`<html><head><title>Tienda el Rio</title>`);
    mywindow.document.write('</head><body >');
    mywindow.document.write(htmlPDF);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
    mywindow.print();
    mywindow.close();
    return true;
  }

  function crear() {
    var e = document.getElementById("select_ordenes");
    var idOrdenSelected =  parseInt(e.options[e.selectedIndex].value);
    var params = JSON.stringify(idOrdenSelected);

    const Http = new XMLHttpRequest();
    var token = document.querySelector('meta[name="csrf-token"]').content;
    const url='http://34.68.116.225/tickets';
    Http.open("POST", url);
    Http.setRequestHeader('Content-Type', 'application/json');
    Http.setRequestHeader('X-CSRF-TOKEN', token);
    Http.send(params);

    Http.onreadystatechange = (e) => {
      console.log(e);
    }
  }//crear()




</script>

          <?php else: ?>
            <script language="javascript">
            alert("No tienes autoriazación para ver esta página.")
            </script>
            <meta http-equiv="refresh" content="0; URL='/admin'"/>
        <?php endif ?>
@endsection
