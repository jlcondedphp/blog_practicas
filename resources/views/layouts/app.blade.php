<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Blog</title>
    <!-- Styles -->
    

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    @vite("resources/css/app.css")
    @livewireStyles
    
</head
>
<body>

    <header class="w-full">
        <nav class="w-full bg-orange-300 p-1 text-white flex justify-center">
            <div class="w-full flex justify-between px-4">
                @guest
                <ul class="flex justify-between" style="width:90px">
                    <li>
                        <a class="hover:text-blue-600" href="{{ route('home') }}">
                            HOME
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-blue-600" href="{{ route('login') }}">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </li>
                </ul>
                @else
                <ul class="flex justify-between" style="width:300px">
                    <li>
                        <a class="hover:text-blue-600" href="{{ route('home') }}">
                            HOME
                        </a>
                    </li>

                    
                    <li>{{ Auth::user()->name }}</li>
                    @if( Auth::user()->isAdmin() || Auth::user()->isStaff() )
                    <li>
                        <a class="hover:text-blue-600" href="{{ route('posts.index') }}" title="Admin">
                            <i class="fas fa-user-shield"></i>
                        </a>                        
                    </li> 
                    <div class="group inline-block relative  hover:text-blue-600">
                        <button class="focus:outline-none">
                             Admin
                        </button>
                        <ul class="absolute hidden group-hover:block bg-white shadow-lg">
                            <li><a href="{{ route('admin.post') }}" class="text-gray-700 hover:bg-gray-100 px-3 py-2 block">Livewire</a></li>
                            <li><a href="{{ route('posts.index') }}" class="text-gray-700 hover:bg-gray-100 px-3 py-2 block">Posts</a></li>
                            <li><a href="{{ route('roles.index') }}" class="text-gray-700 hover:bg-gray-100 px-3 py-2 block">Roles</a></li>
                            <li><a href="{{ route('users.index') }}" class="text-gray-700 hover:bg-gray-100 px-3 py-2 block">Users</a></li>
                        </ul>
                    </div>    
                    @endif


                    <li>
                        <a class="hover:text-blue-600" href="{{ route('logout') }}" title="logout" class="no-underline hover:underline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                @endguest
                <ul class="flex justify-between" style="width:99px">
                    <li>
                        <a class="hover:text-blue-600" href="http://">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-blue-600" href="http://">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-blue-600" href="http://">
                            <i class="fas fa-rss"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>





        <div class="text-center py-8 text-4xl font-bold">
            <h1>My Laravel Blog</h1>
        </div>
    </header>

    <div class="container" style="margin:auto;">
        @yield('content')
    </div>
    <footer class="mt-12">
        <div class="max-w-full bg-orange-300 p-4"></div>
        <div class="max-w-full text-center bg-gray-700 text-white p-4">
            <div class="text-lg font-bold">@LaravelBlog <a class="hover:underline" href="https://cosasdedevs.com/" target="_blank"></a></div>
        </div>
    </footer>
    @livewireScripts
</body>

</html>



