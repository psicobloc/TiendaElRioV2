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
document.write(cat[7].nombre_categoria);
document.write(prod[0].id_categoria);
</script>

<select id="select_categorias" onchange="ChangeCatList()">
  <option value="">-- Categorias --</option>
  @foreach ($categorias as $categoria)
  <option value="{{$categoria->id}}">{{$categoria->nombre_categoria}}</option>
  @endforeach
</select>
<select id="select_productos"></select>

<script>
var productosPorCat = {};
cat.forEach(function(item, index){
var catID = item.id;
productosPorCat[catID] = [];

//falso, son dos tablas diferentes.
  // item.forEach(function(itemP, indexP){
  // productosPorCat[catID].push(itemP.nombre);
  // });

});

//mas bien: por cada producto, agregarlo a productosPorCat[producto->id_categoria].push(producto)

var productosPorCat = {};
carsAndModels['VO'] = ['V70', 'XC60', 'XC90'];
carsAndModels['VW'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
carsAndModels['BMW'] = ['M6', 'X5', 'Z3'];

function ChangeCatList() {
  var catList = document.getElementById("select_categorias");
  var prodList = document.getElementById("select_productos");
  var catID = catList.options[catList.selectedIndex].value;
  while (prodList.options.length) {
    prodList.remove(0);
  }


  var producto_seleccionado = carsAndModels[selCar];
  if (cars) {
    var i;
    for (i = 0; i < cars.length; i++) {
      var car = new Option(cars[i], i);
      modelList.options.add(car);
    }
  }
}
</script>



<div class="col-md-8">
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
            <select id="select_categorias" onchange="ChangeCatList()">
              <option value="">-- Categorias --</option>
              @foreach ($categorias as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->nombre_categoria}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Username</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Email address</label>
            <input type="email" class="form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Fist Name</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Last Name</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Adress</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">City</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Country</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Postal Code</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>About Me</label>
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
              <textarea class="form-control" rows="5"></textarea>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
      <div class="clearfix"></div>
    </form>
  </div>
</div>
</div>


























          <?php else: ?>
            <script language="javascript">
            alert("No tienes autoriazación para ver esta página.")
            </script>
            <meta http-equiv="refresh" content="0; URL='/admin'"/>
        <?php endif ?>
@endsection
