
<div class="c-subheader px-3">

    <ol class="breadcrumb border-0 m-0">
        @foreach( $groups as $group )

            @foreach( $group->menus as $menus )

                @if( count($menus->childs) > 0 )

                    @php
                        $menuUrl = str_replace("/*", "", $menus->active_url);
                    @endphp

                    @if (request()->is($menus->active_url) || request()->is($menuUrl))
                        <li class="breadcrumb-item">{{ $menus->label }}</li>
                    @endif

                    @foreach( $menus->childs as $child )
                        @php
                            $childUrl = str_replace("/*", "", $child->active_url);
                        @endphp

                        @if (request()->routeIs($child->url) || request()->is($childUrl))
                            <li class="breadcrumb-item">{{ $child->label }}</li>
                        @endif

                    @endforeach

                @else
                    @if (request()->routeIs($menus->url))
                        <li class="breadcrumb-item">{{ $menus->label }}</li>
                    @endif
                @endif
            @endforeach

        @endforeach
    </ol>

</div>
