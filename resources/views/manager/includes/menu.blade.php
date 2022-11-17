<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('users.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Dashboard
                </a>
            </li>

            @foreach ($modules as $m)
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    {{ $m['name'] }}
                </h6>

                @foreach ($m['resources'] as $r)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($r['resource']) }}">
                            <span data-feather="file"></span>
                            <span class="m-3">{{ $r['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach

        </ul>

    </div>
</nav>
