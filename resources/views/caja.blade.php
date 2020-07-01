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
?>
<script type="text/javascript">
var cat = <?php echo json_encode($categorias); ?>;
var prod = <?php echo json_encode($productos); ?>;
var users = <?php $users = \App\User::all(); echo json_encode($users); ?>;
var user_name = <?php echo json_encode($user_name); ?>;
var user_id = <?php echo json_encode($user_id); ?>;


var totalVenta = 0;
//document.write(cat[7].nombre_categoria);
//document.write(prod[0].id_categoria);
</script>

<!-- <select id="select_categorias" onchange="ChangeCatList()">
  <option value="">-- Categorias --</option>
  @foreach ($categorias as $categoria)
  <option value= "{{$categoria->id}}" >{{$categoria->nombre_categoria}}</option>
  @endforeach
</select>
<select id="select_productos"></select> -->

<body class="dark-edition">
<div class="col-md-8">
  <form action="/submit" method="post">
    @csrf

    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Seleccionar productos</h4>
        <p class="card-category">Complete todos los campos</p>
      </div>
      <div class="card-body">
        <?php   echo "<p id=\"verde\" class=\"text-success\"> Usuario " .  $user_name . "</p>" ; ?>
        <form>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group bmd-form-group">
                Producto:
                <select id="select_productos" class="form-control @error('select_productos') is-invalid @enderror" name="select_productos" value="{{ old('select_productos') }}">
                  @foreach ($productos as $producto)
                  <option value='{{$producto->id}},{{$producto->precio}}'>{{$producto->nombre}}</option>
                  @endforeach

                </select>
                @error('select_productos')
                        <div class="Producto inválido">{{ $message }}</div>
                    @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">cantidad</label>
                <input type="number" step="1" min="1" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
                @error('cantidad')
                        <div class="cantidad invalida">{{ $message }}</div>
                    @enderror
              </div>
            </div>
            <div class="col-md-4">
              <a onclick="add()" class="btn btn-primary btn-round"> Agregar </a>
              <a class="btn btn-primary btn-round" style="background-color:#394cb7; margin-left: 70px" href="/caja"> limpiar </a>


    <meta name="csrf-token" content="{!! csrf_token() !!}">


              <script type="text/javascript">
              var arregloVenta = [];
              var contadorProd = 0;

                function add() {
                  var e = document.getElementById("select_productos");
                  var cant = document.getElementById("cantidad");
                  var cantidadSel = cant.value;
                  if (cant.value <1) {
                    cantidadSel = 1;
                  }
                  var textResult = e.options[e.selectedIndex].text;
                  var idProductoSel = e.options[e.selectedIndex].value.split(',')[0];
                  var selectedPrice = e.options[e.selectedIndex].value.split(',')[1];
                  var totalSelected = cantidadSel * selectedPrice;

                  totalVenta += totalSelected;
                  document.getElementById("total").innerHTML = totalVenta;

                  var registroVenta =  " - " + textResult + " - " + " cantidad: " + cantidadSel + " - " + "Precio: $" + selectedPrice +  " - " + "total: $" + totalSelected;
                  // var mydiv = document.getElementById("listaP");
                  // mydiv.appendChild(document.createTextNode(result));

                  contadorProd = contadorProd +1;

                  var seleccionArr = [user_id,idProductoSel,cantidadSel,totalSelected];

                  arregloVenta.push(seleccionArr);

                  var newpara = document.createElement("P");
                  newpara.innerHTML = registroVenta;
                  document.getElementById("listaP").appendChild(newpara);
                  mydiv.appendChild(newpara);

                }//add()


                function cargar(){

                  // mandar arregloVenta a php y desde ahí modificar la BD

                  $.ajax({

                    url     : 'http://34.68.116.225/cargar',
                    method    : 'POST',
                    data :{
                      "_token": $('meta[name="csrf-token"]').attr('content'),
                      "nombre":"hola"
                    },
                    success   : function(response)
                    {
                    alert("data sent response is "+response);
                    },
                    error : function(e)
                    {
                    alert("data not sent" + e.responseText)
                    }



                  });//ajax





                  //*************** esto es node.js, server side, no funciona en javascript
                  // var mysql = require('mysql');
                  //
                  // var con = mysql.createConnection({
                  //   host: "217.0.0.1",
                  //   port:"3306",
                  //   user: "vendedor",
                  //   password: "okboomer",
                  //   database: "tienda"
                  // });
                  //
                  // con.connect(function(err) {
                  //   if (err) throw err;
                  //   console.log("Connected!");
                  //   var sql = "INSERT INTO tablapruebas (id_prod, id_usuario, precio_prod, cantidad_prod, total) VALUES (2,1,9.5,2,19)";
                  //   con.query(sql, function (err, result) {
                  //     if (err) throw err;
                  //     console.log("1 record inserted");
                  //   });
                  // });






                }//cargar()

              </script>

           </div>
          </div>
            <div class="row">
              <blockquote class="blockquote">
              <p id="listaP">Productos Elegidos: <br>   </p>
              </blockquote>
            </div>
          <a class="text-warning">  Total:$  </a><?php   echo "<a id=\"total\" class=\"text-info\"> </a>" ; ?>
          <a class="btn btn-primary" style="background-color:#4fb739; margin-left: 750px" onclick="cargar()"> Terminar venta </a>
          <!-- <button type="submit" class="btn btn-primary pull-right" onclick="cargar()">Terminar venta</button> -->
          <div class="clearfix"></div>
        </form>
      </div>
    </div>

  </form>

</div>

</body>
























          <?php else: ?>
            <script language="javascript">
            alert("No tienes autoriazación para ver esta página.")
            </script>
            <meta http-equiv="refresh" content="0; URL='/admin'"/>
        <?php endif ?>
@endsection
