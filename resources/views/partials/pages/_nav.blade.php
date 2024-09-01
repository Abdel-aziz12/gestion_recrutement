
<nav class="main-header navbar navbar-expand navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @php
                    // Récupère le nombre de notifications non lues pour les entretiens programmés aujourd'hui
                    $todayCount = \App\Helpers\Notifications::getDate();

                    // La méthode getDate() compte uniquement les notifications où read_at est NULL et is_read est false.

                @endphp
                @if ($todayCount > 0)
                    <span class="badge badge-warning navbar-badge">{{ $todayCount }}</span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $todayCount }} Notifications</span>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                @php
                    $notifications = \App\Helpers\Notifications::getName();
                @endphp

                @if ($todayCount > 0)
                    @foreach (\App\Helpers\Notifications::getName()->take(2) as $notification)
                        <a href="{{ route('notification.show', $notification['id']) }}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="https://ui-avatars.com/api?name={{ $notification['name'] }} {{ $notification['firstname'] }}"
                                    alt="User Avatar" class="profile-image"
                                    style="border-radius: 50%; width: 30px; height: 30px">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ $notification['name'] }} {{ $notification['firstname'] }}
                                        {{-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> --}}
                                    </h3>
                                    <p class="text-sm">{{ $notification['motivation'] }}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                        {{ $notification['time'] }} Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                    @endforeach
                @endif
                <div class="dropdown-divider"></div>
                @if ($todayCount > 2)
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('notification.index') }}" class="dropdown-item dropdown-footer">See All
                        Messages
                    </a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
