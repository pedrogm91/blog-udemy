<header class="space-inter">
    <div class="container container-flex space-between">
        <figure class="logo"><img src="/img/logo.png" alt=""></figure>
        <nav class="custom-wrapper" id="menu">
            <div class="pure-menu"></div>
            <ul class="container-flex list-unstyled">
                <li><a href="{{ route('pages.home')    }}" class="text-uppercase {{ setActiveRoute('pages.home')    }}">Home</a></li>
                <li><a href="{{ route('pages.about')   }}" class="text-uppercase {{ setActiveRoute('pages.about')   }}">About</a></li>
                <li><a href="{{ route('pages.archive') }}" class="text-uppercase {{ setActiveRoute('pages.archive') }}">Archive</a></li>
                <li><a href="{{ route('pages.contact') }}" class="text-uppercase {{ setActiveRoute('pages.contact') }}">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>