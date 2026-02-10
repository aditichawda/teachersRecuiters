{!! Theme::partial('header', ['withoutNavbar' => true]) !!}

<div class="main-content">
    <div class="page-content">
        {!! Theme::content() !!}
    </div>
</div>

{!! Theme::partial('footer', ['withoutNavbar' => true]) !!}
