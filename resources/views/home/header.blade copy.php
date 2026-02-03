         <div class="header_main">
             <div class="container-fluid">
                 <div class="logo"><a href="/"><img src="images/logo.png"></a></div>
                 <div class="menu_main" style="display: flex; align-items: center; width: 100%;">
                     <ul style="display: flex; list-style: none; margin: 0; padding: 0; width: 100%; justify-content: space-between;">
                         <li class="active"><a href="/">Home</a></li>
                         <li><a href="{{ route('about') }}">About</a></li>
                         <li><a href="{{ route('blog') }}">Blog</a></li>
                         <li><a href="{{ route('contactus') }}">Contact us</a></li>
                         @if (Route::has('login'))
                         @auth
                         <li><a href="{{ route('posts.create') }}">Add your Own Post</a></li>
                         <li class="dropdown" style="position: relative;">
                             <a href="#" class="dropdown-toggle">{{ Auth::user()->name }} <i class="fas fa-caret-down"></i></a>
                             <ul class="dropdown-content">
                                 <li><a href="{{ route('profile.show') }}">Profile</a></li>
                                 <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                 <li class="divider"></li>
                                 <li>
                                     <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button type="submit" class="logout-btn">Logout</button>
                                     </form>
                                 </li>
                             </ul>
                         </li>



                         @else
                         <li><a href="{{route('login')}}">Login</a></li>
                         <li><a href="{{route('register')}}">Register</a></li>
                         @endauth
                         @endif
                     </ul>
                 </div>
             </div>
         </div>
         <!-- Font Awesome for icons -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
         <!-- Custom dropdown styles -->
         <style>
             /* Reset any conflicting styles */
             .dropdown-content {
                 display: none; 
             }

             /* Dropdown container */
             .dropdown {
                 position: relative;
                 display: inline-block;
             }

             /* Dropdown button */
             .dropdown-toggle {
                 cursor: pointer;
                 display: flex;
                 align-items: center;
                 gap: 5px;
                 padding: 10px 15px;
                 color: white;
             }

             /* Dropdown content */
             .dropdown {
                 position: relative;
                 display: inline-block;
             }

            .dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background-color: #fff;
    min-width: 200px;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
    z-index: 2000; /* increase */
    border-radius: 4px;
    padding: 10px 0;
    margin: 5px 0 0 0;
    list-style: none;
}

             .menu_main ul li a {
                 color: white !important;
                 transition: none !important;
             }

             .menu_main ul li a:hover {
                 color: white !important;
                 text-decoration: none;
             }

             /* Dropdown items */
             .dropdown-content a,
             .dropdown-content .logout-btn {
                 color: #333;
                 padding: 8px 16px;
                 text-decoration: none;
                 display: block;
                 text-align: left;
                 background: none;
                 border: none;
                 width: 100%;
                 cursor: pointer;
                 font-size: 14px;
             }

             .menu_main ul {
                 display: flex;
                 list-style: none;
                 margin: 0;
                 padding: 0 40px;
                 width: 100%;
                 justify-content: flex-start;
                 max-width: 1100px;
                 margin: 0 auto;
                 gap: 15px;
             }

             .menu_main ul li {
                 margin: 0;
                 padding: 0;
             }

             .menu_main ul li a {
                 display: block;
                 padding: 15px 10px;
                 text-decoration: none;
                 color: inherit;
                 white-space: nowrap;
                 transition: all 0.3s ease;
             }

             .menu_main ul li a:hover {
                 color: #007bff;
             }

             .dropdown-content a:hover,
             .dropdown-content .logout-btn:hover {
                 background-color: #f5f5f5;
             }

             .dropdown-content i {
                 width: 20px;
                 margin-right: 8px;
                 text-align: center;
             }

             .divider {
                 height: 1px;
                 margin: 5px 0;
                 background-color: #eee;
             }

             .logout-btn {
                 text-align: left !important;
             }
         </style>
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                     toggle.addEventListener('click', function(e) {
                         e.preventDefault();
                         e.stopPropagation();
                         const content = this.nextElementSibling;
                         const isVisible = content.style.display === 'block';

                         // Close all other dropdowns
                         document.querySelectorAll('.dropdown-content').forEach(menu => {
                             if (menu !== content) menu.style.display = 'none';
                         });

                         // Toggle current dropdown
                         content.style.display = isVisible ? 'none' : 'block';
                     });
                 });

                 document.addEventListener('click', function(e) {
                     if (!e.target.closest('.dropdown')) {
                         document.querySelectorAll('.dropdown-content').forEach(menu => {
                             menu.style.display = 'none';
                         });
                     }
                 });
             });
         </script>