{{-- <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="https://ui-avatars.com/api?name= {{ NameApplication::getNom() ? NameApplication::getNom() : 'TP APP' }}"
            alt="{{ NameApplication::getNom() }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span
            class="brand-text font-weight-light">{{ NameApplication::getNom() ? NameApplication::getNom() : 'TP APP' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api?name={{ Auth()->User()->name }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ request()->is('categorie*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Catégories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('candidatures.index') }}"
                        class="nav-link {{ request()->is('candidatures*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Candidatures</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('entretiens.index') }}"
                        class="nav-link {{ request()->is('entretiens*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Entretiens</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notification.index') }}"
                        class="nav-link {{ request()->is('notification*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('historiques.index')}}" class="nav-link {{ request()->is('historiques*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Historiques</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configurations.index') }}"
                        class="nav-link {{ request()->is('configurations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Paramètres</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside> --}}




<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="https://ui-avatars.com/api?name= {{ NameApplication::getNom() ? NameApplication::getNom() : 'TP APP' }}"
            alt="{{ NameApplication::getNom() }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span
            class="brand-text font-weight-light">{{ NameApplication::getNom() ? NameApplication::getNom() : 'TP APP' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api?name={{ Auth()->User()->name }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ request()->is('categorie*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Catégories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('candidatures.index') }}"
                        class="nav-link {{ request()->is('candidatures*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Candidatures</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('entretiens.index') }}"
                        class="nav-link {{ request()->is('entretiens*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Entretiens</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notification.index') }}"
                        class="nav-link {{ request()->is('notification*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('historiques.index') }}"
                        class="nav-link {{ request()->is('historiques*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Historiques</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configurations.index') }}"
                        class="nav-link {{ request()->is('configurations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Paramètres</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
