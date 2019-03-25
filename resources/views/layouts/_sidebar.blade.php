<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('home') ? 'active' : '' }}">
            {{__('layouts.app.sidebar.home')}}
        </a>
        @if (Auth::user()->isAdmin())
            <p class="list-group-item">
                <strong>{{__('layouts.app.sidebar.admin')}}</strong>
            </p>
            <a href="{{ url('/roles') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('roles') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.roles')}}
            </a>
            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('user') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
            <a href="{{ url('/file-manager') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('fileManager') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.file-manager')}}
            </a>
            <a href="{{ url('/settings') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('settings') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.settings')}}
            </a>
        @endif
        @if (Auth::user()->isAdmin() || Auth::user()->isSubAdmin())
            <p class="list-group-item">
                <strong>{{__('layouts.app.sidebar.subadmin')}}</strong>
            </p>
            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('user') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
        @endif
    </div>
</div>