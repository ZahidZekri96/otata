<div class="nav-header" style="left:0">
	<a href="index.html" class="brand-logo">
		<img class="logo" style="max-width:100%;" src="{{ asset('media/icon/otata.jpeg') }}" alt="">
	</a>

	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left">
					<div class="dashboard_bar">
						{{ $title }}
					</div>
				</div>
				<ul class="navbar-nav header-right">
					<li class="nav-item dropdown header-profile">
						<a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
							<img src="{{ asset('media/icon/cog.png') }}" style="width:30px;height:30px" alt=""/>
							<!-- <div class="header-info">
								<span class="text-black"><strong>Brian Lee</strong></span>
								<p class="fs-12 mb-0">Admin</p>
							</div> -->
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ml-2">{{ __('Logout') }} </span>
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>