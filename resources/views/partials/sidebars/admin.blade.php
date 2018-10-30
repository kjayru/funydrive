
          <li class="header">MENU</li>
          <li>
            <a href="/admin">
              <i class="fa fa-th"></i> <span>Inicio</span>
            </a>
          </li>
          <li>
              <a href="/admin/listclientes">
                <i class="fa fa-th"></i> <span>Clientes</span>
              </a>
            </li>

          <li>
            <a href="/admin/listasociados">
              <i class="fa fa-th"></i> <span>Asociados</span>
            </a>
          </li>

          <li>
                <a href="/admin/listsolicitudes">
                  <i class="fa fa-th"></i> <span>Solicitudes</span>
                </a>
              </li>
          <li>

        <li>
            <a href="/admin/entorno">
                <i class="fa fa-th"></i> <span>Entorno</span>
            </a>
        </li>
        <li>
          <a href="/admin/marca">
              <i class="fa fa-th"></i> <span>Marca</span>
          </a>
      </li>
      <li>
        <a href="/admin/modelo">
            <i class="fa fa-th"></i> <span>Modelo</span>
        </a>
      </li>
      <li>
        <a href="/admin/valoracion">
            <i class="fa fa-th"></i> <span>Valorar</span>
        </a>
      </li>

        <li>
              <a  href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-th"></i> <span> {{ __('Salir') }}</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>        
