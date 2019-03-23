<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('home') ? 'active' : '' }}">
            {{__('layouts.app.sidebar.home')}}
        </a>
        @if (Auth::user()->isAdmin())
            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('users') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
            <a href="{{ url('/file-manager') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('fileManager') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.file-manager')}}
            </a>
            <a href="{{ url('/settings') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('settings') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.settings')}}
            </a>
        @endif
    </div>
</div>