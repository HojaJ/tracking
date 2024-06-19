
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="initial-scale=1, maximum-scale=1"> -->
    <title>Tracking App</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
</head>
<body>

    <nav class="navbar navbar-expand-md bg-blue">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto custom-navbar">
              @if(isset($allstorages))
                @foreach ($allstorages as $allstorage)
                <li class="nav-item mr-md-4 {{ ($allstorage->id == request()->segment(3)) ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.storage',$allstorage->id) }}">{{ $allstorage->name }}</a>
                </li>  
                @endforeach
              @endif

              <li class="nav-item mr-md-4 {{ ('container' == request()->segment(2)) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.container.index') }}">{{ __('Containers') }}</a>
              </li>
            </ul>
              <div class="d-flex">
                  <div class="dropdown">
                      <button style="cursor:pointer; background: transparent;outline: none;border: none;" class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="{{asset('image/lang.png')}}" alt="Language Swithcer">
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          @if(Request::is('ru') || Request::is('ru/*'))
                              <a href="{{ LaravelLocalization::getLocalizedURL('tk', null, [], true) }}">
                                  <button class="dropdown-item" type="button">TM</button>
                              </a>
                              <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                  <button class="dropdown-item" type="button">EN</button>
                              </a>
                          @elseif(Request::is('en') || Request::is('en/*'))
                              <a href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}">
                                  <button class="dropdown-item" type="button">RU</button>
                              </a>
                              <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                  <button class="dropdown-item" type="button">EN</button>
                              </a>
                          @else
                              <a href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}">
                                  <button class="dropdown-item" type="button">RU</button>
                              </a>
                              <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                  <button class="dropdown-item" type="button">EN</button>
                              </a>
                          @endif
                      </div>
                  </div>

              </div>
              <div class="nav-item mr-2 {{ ('archive' == request()->segment(2)) ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.inArchive') }}">{{ __('Archive') }}</a>
              </div>

              <div class="dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Administrator') }}</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown07">
                      <a class="dropdown-item" href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
                      <a class="dropdown-item" href="{{ route('admin.shipping.index') }}">{{ __('Transport') }}</a>
                      <a class="dropdown-item" href="{{ route('admin.inArchive') }}">{{ __('Archive') }}</a>
                      <form class="dropdown-item" action="{{  \LaravelLocalization::localizeURL('/logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="btn-style-none p-0">{{ __('Logout') }}</button>
                      </form>
                  </div>
              </div>
            
          </div>
        </div>
      </nav>

      @yield('content')



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
      $(function() {
        @if(session('success'))
            toastr.success('{{ session("success") }}');
        @endif

        @if($errors->any())
          @foreach ($errors->all() as $error)
            toastr.error('{{$error}}');
          @endforeach
        @endif
      })
      </script>
    @stack('scripts')
</body>
</html>

