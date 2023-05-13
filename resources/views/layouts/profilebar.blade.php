<div class="dropdown-menu dropdown-menu-right pt-0">
    <div class="dropdown-header bg-light py-2"><strong>កំណត់</strong></div>

    <a class="dropdown-item" href="{{ route('setting.profile.index') }}">
        <span class="material-icons-outlined">account_circle</span>គណនី

    </a>

    <div class="dropdown-divider"></div>


    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="material-icons-outlined">logout</span>
        ចាកចេញ
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
