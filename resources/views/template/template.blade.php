@include('template/header')

<body>
    @include('template/hederMenu')

    @include('template/sliderMenu')
    @if (
        !empty(Auth::user()->pcAdmin) or
            !empty(Auth::user()->itsetting) or
            !empty(Auth::user()->userpermition) or
            !empty(Auth::user()->report) or
            !empty(Auth::user()->ticketview) or
            !empty(Auth::user()->ticketupdate) or
            !empty(Auth::user()->itequipmentadd))
        
    @endif

    <main id="main" class="main">
        <div class="pagetitle">
            <h1> {{ $data['title'] }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home {{ Session::get('name') }}</a></li>
                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                </ol>
            </nav>


        </div>

        @include($data['template'])

    </main>

</body>

 @include('template/footer') 


@include('sweetalert::alert')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
