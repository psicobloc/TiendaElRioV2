@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth; ?>
<?php
try {
  $user_id = auth()->user()->role->id;
} catch (Exception $e) {
  $user_id = 1000;}
  if ($user_id < 4):
?>
<script type="text/javascript">
var cat = <?php echo json_encode($categorias); ?>;
var prod = <?php echo json_encode($productos); ?>;
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

<script>
// var productosPorCat = {}
//
// for (var j = 0; j < prod.length; j++) {
//   productosPorCat[prod[j].id_categoria].push(prod[j].nombre);
// }

// var productosPorCat = {};
// cat.forEach(function(item, index){
// var catID = item.id;
// productosPorCat[catID] = [];

//falso, son dos tablas diferentes.
  // item.forEach(function(itemP, indexP){
  // productosPorCat[catID].push(itemP.nombre);
  // });

// });

//mas bien: por cada producto, agregarlo a productosPorCat[producto->id_categoria].push(producto)

// var productosPorCat = {};
// carsAndModels['VO'] = ['V70', 'XC60', 'XC90'];
// carsAndModels['VW'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
// carsAndModels['BMW'] = ['M6', 'X5', 'Z3'];

function ChangeCatList() {
  var productosPorCat = {}

  for (var j = 0; j < prod.length; j++) {
    productosPorCat[prod[j].id_categoria].push(prod[j].nombre);
  }

  var catList = document.getElementById("select_categorias");
  var prodList = document.getElementById("select_productos");
  var catID = catList.options[catList.selectedIndex].value;
  while (prodList.options.length) {
    prodList.remove(0);
  }
  var producto_seleccionado = productosPorCat[catID];
  if (producto_seleccionado) {
    var i;
    for (i = 0; i < producto_seleccionado.length; i++) {
      var opcionProd = new Option(producto_seleccionado[i], i);
      prodList.options.add(opcionProd);
    }
  }
}
</script>

<body class="dark-edition">
<div class="col-md-8">
  <form action="/submit" method="post">

    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Seleccionar productos</h4>
        <p class="card-category">Complete todos los campos</p>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group bmd-form-group">
                Producto:
                <select id="select_productos" class="form-control @error('select_productos') is-invalid @enderror" name="select_productos" value="{{ old('select_productos') }}">
                  @foreach ($productos as $producto)
                  <option value="{{$producto->id}}">{{$producto->nombre}}</option>
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

              <script type="text/javascript">

                function add() {
                  var e = document.getElementById("select_productos");
                  var result = e.options[e.selectedIndex].text;
                  console.log("add");
                  // var mydiv = document.getElementById("listaP");
                  // mydiv.appendChild(document.createTextNode(result));

                  var newpara = document.createElement("P");
                  newpara.innerHTML = result;
                  document.getElementById("listaP").appendChild(newpara);
                  mydiv.appendChild(newpara);


                  //var newContent = document.createElement('div');
                  //newContent.innerHTML = result;

                  // while (newcontent.firstChild) {
                  //   mydiv.appendChild(newcontent.firstChild);
                  // }

                  //document.getElementById("listaP").innerHTML = result;
                  // document.write(result);

                  <?php

                    // $productos = \App\Producto::all();
                    //
                    //
                    // foreach ($productos as $prod) {
                    //   if ($prod->id == 2) {
                    //     echo "console.log({$prod})";
                    //     echo "blah blah";
                    //   }
                    //
                    // }

                   ?>
                }

              </script>

           </div>
          </div>
            <div class="row">
              <blockquote class="blockquote">
              <p id="listaP">Productos Elegidos: <br>   </p>
              </blockquote>
            </div>
          <button type="submit" class="btn btn-primary pull-right">Terminar venta</button>
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
