<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
       
    </footer>
</body>
</html>
