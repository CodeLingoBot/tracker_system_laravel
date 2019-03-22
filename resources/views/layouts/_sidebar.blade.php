<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('home') ? 'active' : '' }}">
            {{__('layouts.app.sidebar.home')}}
        </a>
        @if (Auth::user()->isAdmin())
            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('users') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
        @endif
    </div>
</div>