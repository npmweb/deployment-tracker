<div class="contain-to-grid">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1>{{ link_to('/', 'DeploymentTracker') }}</h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"></a></li>
		</ul>
		<section class="top-bar-section">
			<ul class="right">
				@if (Auth::check())
					<li>
						<a href="#" onclick="$('#logout').submit()">Log Out</a>
						{{ Form::open(['route'=>['logins.destroy','1'], 'method'=>'delete', 'id'=>'logout']) }}
						{{ Form::close() }}
					</li>
				@endif
			</ul>
		</section>
	</nav>
</div>

@if ( Session::get('myflash') )
	<div class="row">
		<div class="column">
			<div data-alert class="alert-box">{{ Session::get('myflash') }}</div>
		</div>
	</div>
@endif
