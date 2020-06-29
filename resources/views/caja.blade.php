@extends('layouts.mainlayout')
@section('content')
<?php use Illuminate\Support\Facades\Auth; ?>
<?php
try {
  $user_id = auth()->user()->role->id;

} catch (Exception $e) {

  $user_id = 1000;
}

  if ($user_id < 4):
?>


            <div class="content">
                <div class="title m-b-md">
                    Productos
                </div>

                <div class="links">
                  @foreach ($productos as $prod)
                    <a>{{ $prod->nombre }} - ${{ $prod->precio }}</a>
                  @endforeach
                </div>
            </div>


          <?php else: ?>

            <script language="javascript">
            alert("No tienes autoriazación para ver esta página.")
            </script>
            <meta http-equiv="refresh" content="0; URL='/admin'"/>

        <?php endif ?>

@endsection
