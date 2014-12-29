{{-- includes scripts appropriate to the environment --}}
@if( is_local() )
    @include('layouts.scripts._local')
@else
    @include('layouts.scripts._release')
@endif
