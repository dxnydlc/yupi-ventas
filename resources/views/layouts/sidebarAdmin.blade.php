<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Usuario: {{Auth::User()->type}}</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/home">Dashboard</a>
                    </li>
                    
                    <li><a href="/profile">Perfil</a>
                    </li>
                    <li><a href="/empresa">Empresa</a>
                    </li>
                    
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Mantenimiento <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    </li>
                    <li><a href="/proveedor">Proveedores</a></li>
                    <li><a href="/cliente">Clientes</a></li>
                    <li><a href="/categoria">Categorias</a></li>
                    <li><a href="/clase">Clase Producto</a></li>
                    <li><a href="/marca">Marca</a></li>
                    <li><a href="/usuario">Usuarios</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Productos <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    </li>
                    <li><a href="/producto">Productos</a></li>
                    <li><a href="/productolote">Productos Lote</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-desktop"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/ventas">Ventas hoy</a>
                    </li>
                    <li><a href="/allventas">Todas las Ventas</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li>
                        <a href="/inventario">Nuevo inventario</a>
                    </li>
                    <li>
                        <a href="/pe">Parte entrada</a>
                    </li>
                    <li><a href="/kardex">Kardex</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/rep_venta_user">Ventas x Usuario</a>
                    </li>
                    <li><a href="/rep_prod_user">Productos por usuario</a>
                    </li>
                    <li><a href="/rep_prod_margen">Productos margen</a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>


</div>