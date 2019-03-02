<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Navegacion</li>
    <!-- Optionally, you can add icons to the links -->
    <li {{ request()->is('admin') ? 'class=active' : '' }}><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> <span>Panel</span></a></li>
    <li class="treeview {{ request()->is('admin/posts*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            
            <li><a href="{{ route('admin.posts.index') }}">Ver todos los posts</a></li>   
            
            @if (request()->is('admin/posts/*'))
                <li>
                    <a href="{{ route('admin.posts.index', '#create') }}">Crear un post true</a>
                </li>
            @else
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModal">Crear un post false</a>
                </li>
            @endif

        </ul>
    </li>
</ul>