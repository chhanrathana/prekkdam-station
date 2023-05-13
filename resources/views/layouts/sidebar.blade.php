<ul class="c-sidebar-nav">
    @foreach( $groups as $group )
        @if( !$group->name_kh == '' && count($group->menus) > 0 )
            <li class="c-sidebar-nav-title">{{ $group->name_kh ?? '' }}</li>
        @endif
        @foreach( $group->menus as $menus )
            @if( count($menus->childs) > 0 )
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ (request()->is( $menus->active_url )) ? 'c-show' : '' }}">
                    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <span class="material-icons mr-3">{{$menus->icon}}</span>
                        {{ $menus->label }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach( $menus->childs as $child )
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link {{ (request()->is($child->active_url)) ? 'c-active' : '' }}" href="{{ $child->url ? route($child->url) : '#' }}">
                                    <span class="c-sidebar-nav-icon"></span>{{ $child->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ $menus->url ? route( $menus->url ) : '#' }}">
                        <span class="material-icons mr-3">{{$menus->icon}}</span>
                        {{ $menus ->label }}
                    </a>
                </li>
            @endif
        @endforeach
    @endforeach
</ul>