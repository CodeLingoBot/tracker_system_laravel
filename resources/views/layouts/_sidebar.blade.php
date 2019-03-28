<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('home') ? 'active' : '' }}">
            {{__('layouts.app.sidebar.home')}}
        </a>
        @if (Auth::user()->isAdmin())
            <p class="list-group-item bg-primary">
                <strong>{{__('layouts.app.sidebar.admin')}}</strong>
            </p>
            <a href="{{ url('/roles') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('roles') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.roles')}}
            </a>
            <a href="{{ url('/users') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('user') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
            <a href="{{ url('/file-manager') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('fileManager') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.file-manager')}}
            </a>
            <a href="{{ url('/settings') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('settings') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.settings')}}
            </a>
            <a href="{{ url('/licenses') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('licenses') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.licenses')}}
            </a>
        @endif
        @if (Auth::user()->isAdmin() || Auth::user()->isSubAdmin())
            <p class="list-group-item bg-primary">
                <strong>{{__('layouts.app.sidebar.subadmin')}}</strong>
            </p>
            <a href="{{ url('/users') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('user') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.users')}}
            </a>
            <a href="{{ url('/drivers') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('drivers') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.drivers')}}
            </a>
            <a href="{{ url('vehicles') }}" class="bg-secondary list-group-item list-group-item-action {{ Helper::isPrefixCurrentRoute('vehicles') ? 'active' : '' }}">
                {{__('layouts.app.sidebar.vehicles')}}
            </a>
        @endif
    </div>
</div>