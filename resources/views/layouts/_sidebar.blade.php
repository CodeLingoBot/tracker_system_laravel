<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        @if (Auth::user()->isAdmin())
            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users' ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
        @endif
    </div>
</div>