<div class="sidebar" data-color="purple" data-background-color="black" data-image="./assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a class="simple-text logo-normal" href="{{ url('/demo') }}">
          Tienda el Rio
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="{{ url('/admin') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/caja') }}">
              <i class="material-icons">add_shopping_cart</i>
              <p>Venta nueva</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/prod') }}">
              <i class="material-icons">view_list</i>
              <p>Productos</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/historial') }}">
              <i class="material-icons">event</i>
              <p>Historial de ventas</p>
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">print</i>
              <p>Tickets</p>
            </a>
          </li> -->


        </ul>
      </div>
    </div>
