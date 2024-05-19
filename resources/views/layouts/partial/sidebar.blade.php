<div class="sidebar">
    @auth()
    <nav class="nav flex-column">
    <a class="nav-link fw-bold mb-3 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('dashboard')}}"><i class="fa-solid fa-gauge-high me-2"></i> Dashbord</a>
    <p class="my-3 mx-3 border-bottom">App</p> 
    <a class="nav-link fw-bolder {{ Request::is('user/region*') ? 'active' : '' }}" aria-current="page" href="{{route('user.region.index')}}"><i class="fa-regular fa-map me-2"></i> Region</a>
    <a class="nav-link fw-bolder {{ Request::is('user/branch*') ? 'active' : '' }}" aria-current="page" href="{{route('user.branch.index')}}"><i class="fa-solid fa-map-pin me-3"></i> Branch</a>   
    <a class="nav-link fw-bolder {{ Request::is('user/staff*') ? 'active' : '' }}" aria-current="page" href="{{route('user.staff.index')}}"><i class="fa-solid fa-user-tie me-2"></i> Staff</a>
    <a class="nav-link fw-bolder {{ Request::is('user/data*') ? 'active' : '' }}" aria-current="page" href="{{route('user.data.index')}}"><i class="fa-solid fa-database me-2"></i> Data info</a>
    <a class="nav-link fw-bolder {{ Request::is('user/allRegionPerformanceView*') ? 'active' : '' }}" aria-current="page" href="{{route('user.regionPerformanceView')}}"><i class="fa-solid fa-database me-2"></i> Region Performanch</a>
    <a class="nav-link fw-bolder {{ Request::is('user/allBranchPerformanceView*') ? 'active' : '' }}" aria-current="page" href="{{route('user.branchPerformanceView')}}"><i class="fa-solid fa-database me-2"></i> Branch Performanch</a>
    <a class="nav-link fw-bolder {{ Request::is('user/otrPerformanceView*') ? 'active' : '' }}" aria-current="page" href="{{route('user.otrPerformanceView')}}"><i class="fa-solid fa-database me-2"></i> OTR Performance</a>
    <a class="nav-link fw-bolder {{ Request::is('user/performanceView*') ? 'active' : '' }}" aria-current="page" href="{{route('user.performanceView')}}"><i class="fa-solid fa-database me-2"></i> All Performance</a>
    <a class="nav-link fw-bolder {{ Request::is('user/particular*') ? 'active' : '' }}" aria-current="page" href="{{route('user.particular.index')}}"><i class="fa-brands fa-codepen me-2"></i> Particular</a>
    <a class="nav-link fw-bolder {{ Request::is('user/target*') ? 'active' : '' }}" aria-current="page" href="{{route('user.target.index')}}"><i class="fa-solid fa-bullseye me-2"></i> Target</a>
    <a class="nav-link fw-bolder {{ Request::is('user/profile*') ? 'active' : '' }}" aria-current="page" href="{{route('user.profile.index')}}"><i class="fa-solid fa-gear me-2"></i></i> Setting</a>
    {{-- <a class="nav-link fw-bolder {{ Request::is('user/achievement*') ? 'active' : '' }}" aria-current="page" href="{{route('user.achievement.index')}}"><i class="fa-solid fa-shield-halved me-2"></i> Achievement</a> --}}
    </nav>
    @elseauth('admin')
    <nav class="nav flex-column">
    <a class="nav-link fw-bold mb-3 {{ Request::is('admin/dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('admin.dashboard')}}"><i class="fa-solid fa-gauge-high me-2"></i> Dashbord</a>
    <a class="nav-link fw-bolder {{ Request::is('admin/region*') ? 'active' : '' }}" aria-current="page" href="{{route('admin.region.index')}}"><i class="fa-regular fa-map me-2"></i> Region</a>
    <a class="nav-link fw-bolder {{ Request::is('admin/branch*') ? 'active' : '' }}" aria-current="page" href="{{route('admin.branch.index')}}"><i class="fa-solid fa-map-pin me-3"></i> Branch</a>
    <a class="nav-link fw-bolder {{ Request::is('admin/manager*') ? 'active' : '' }}" aria-current="page" href="{{route('admin.manager.index')}}"><i class="fa-solid fa-user-tie me-2"></i> Branch Manager</a>
    </nav>        
    @endif
    
</div>