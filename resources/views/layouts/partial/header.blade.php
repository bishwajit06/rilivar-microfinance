@auth()
<header class="header">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand fw-bold text-primary" href="{{route('home')}}"><img style="height: 30px" class="px-3" src="{{asset('assets/img/logo-2.png')}}" alt="Logo Image"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto">
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          @php
                            $user = App\Models\User::find(Auth::id());
                          @endphp
                          @if($user->image)
                          <img style="height:30px;" class="rounded-circle" src="{{ asset('storage/profile/'.$user->image) }}" alt="" />
                          @else
                          <img style="height:30px;" class="rounded-circle" src="{{asset('assets/img/profile.jpg')}}" alt="" />
                          @endif
                        </a>
                        <ul class="dropdown-menu border-0 shadow rounded-0">
                          <li class="mb-2"><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
                          <li class="mb-2"><a class="dropdown-item" href="{{route('user.profile.index')}}">Profile</a></li>
                          <li class="mb-2">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item pt-0" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
          </nav>
        </div>
      </div>
    </div>
</header>
@elseauth('admin')
<header class="header">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand fw-bold text-primary" href="#"><img style="height: 30px" class="px-3" src="{{asset('assets/img/logo.png')}}" alt="Logo Image"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto">
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          @php
                            $admin = App\Models\Admin::find(Auth::guard('admin')->user()->id);
                          @endphp
                          @if($admin->image)
                          <img style="height: 30px" class="rounded-circle" src="{{ asset('storage/profile/'.$admin->image) }}" alt="" />
                          @else
                          <img style="height: 30px" class="rounded-circle" src="{{asset('assets/img/profile.jpg')}}" alt="" />
                          @endif
                        </a>
                        <ul class="dropdown-menu border-0 shadow rounded-0">
                          <li><a class="dropdown-item" href="{{route('admin.profile.index')}}">Profile</a></li>
                          <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <a class="dropdown-item pt-0" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
          </nav>
        </div>
      </div>
    </div>
</header>
@endif