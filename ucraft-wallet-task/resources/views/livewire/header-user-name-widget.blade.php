<span>
    {{ Auth::check() ? Auth::user()->first_name : '' }}
</span>
