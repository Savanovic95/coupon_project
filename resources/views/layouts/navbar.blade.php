<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupon</title>

    
<style>


    
        #grid {
    
            display:grid;
            grid-template-columns: repeat(3, 1fr);
             gap: 10%;
      
    
        }
    
        li {
    
            list-style: none;
    
        }


        #select {


            background-color: white;

        }


       .btn {

            color: green;
            margin-right: 10px;

        }
    
    </style>


    @vite('resources/css/app.css')



</head>

<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-4">
        <ul class="flex items-center">

            <li>
                <h2 class="mr-4">Admin panel</h2>
            </li>
            @auth
            <li>
                <a href="{{ route('home') }}" class=" bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded mr-4">Home</a>
            </li>
            @endauth

        </ul>
        @if(Session::has('message'))
        <h4 style="color: green">{{Session::pull('message')}}</h4>
        @endif
    
        <ul class="flex items-center">
            @auth
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded mr-4">
                        Logout
                    </button>
                </form>
            </li>
            @endauth

            @guest

            <li>
                <a href="{{ route('login') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-4"> Log in </a>
            </li>

            @endguest

        </ul>
    </nav>
    @yield('content')

</body>

</html>