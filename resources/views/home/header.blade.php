         <div class="header_main">
             <div class="container-fluid">
                  @include('home.logo')
                 <div class="menu_main" style="display: flex; align-items: center; width: 100%;">
                     <ul style="display: flex; list-style: none; margin: 0; padding: 0 40px; width: 100%; justify-content: space-between; max-width: 1100px; margin: 0 auto;">
                         <li class="active"><a href="{{ url('/') }}">Home</a></li>
                         <li><a href="{{ route('about') }}">About</a></li>
                         <li><a href="{{ route('blog') }}">Blog</a></li>
                         <li><a href="{{ route('contactus') }}">Contact us</a></li>
                         @if (Route::has('login'))
                         @auth
                         @if(!auth()->user()->isAdmin())
                         <li><a href="{{ route('posts.create') }}">Add your Own Post</a></li>
                         @endif
                         <li class="dropdown" style="position: relative;">
                             <a href="#" class="dropdown-toggle">{{ Auth::user()->name }}</a>
                             <ul class="dropdown-content" style="position: absolute; right: 0; z-index: 1000; min-width: 200px; background: #fff; border-radius: 4px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 5px 0;">
                                 <li style="padding: 3px 0;"><a href="{{ route('profile.show') }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-user"></i> Profile</a></li>
                                 @if(auth()->user()->isAdmin())
                                 <li style="padding: 3px 0;"><a href="{{ route('dashboard') }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                 @endif
                                 <li class="divider" style="height: 1px; background: #eee; margin: 5px 0;"></li>
                                 <li style="padding: 3px 0;">
                                     <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button type="submit" class="logout-btn" style="background: none; border: none; padding: 8px 20px; width: 100%; text-align: left; cursor: pointer; color: #333; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px; font-family: inherit; font-size: inherit;">
                                             <i class="fas fa-sign-out-alt"></i> Logout
                                         </button>
                                     </form>
                                 </li>
                             </ul>
                         </li>
                         @else
                         <li><a href="{{ route('login') }}">Login</a></li>
                         <li><a href="{{ route('register') }}">Register</a></li>
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
             /* Header Main Styles */
             .header_main {
                 position: relative;
                 z-index: 1000;
                 /* Ensure header is above other content */
             }

             /* Reset any conflicting styles */
             .dropdown-content {
                 display: none;
             }

             /* Menu Main Styles */
             .menu_main {
                 position: relative;
                 z-index: 1001;
                 /* Ensure menu is above header */
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
                 position: relative;
                 z-index: 1002;
                 /* Ensure menu items are clickable */
             }

             .menu_main ul li {
                 margin: 0;
                 padding: 0;
                 position: relative;
             }

             .menu_main ul li a {
                 display: block;
                 padding: 15px 10px;
                 text-decoration: none;
                 color: white !important;
                 white-space: nowrap;
                 transition: all 0.3s ease;
                 position: relative;
                 z-index: 1003;
                 /* Ensure links are clickable */
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
                 padding: 15px 10px;
                 color: white !important;
                 position: relative;
                 z-index: 1004;
             }

             /* Dropdown content */
             .dropdown-content {
                 display: none !important;
                 position: absolute;
                 right: 0;
                 top: 100%;
                 background-color: #fff;
                 min-width: 200px;
                 box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                 border-radius: 4px;
                 padding: 10px 0;
                 list-style: none;
                 z-index: 2000;
                 opacity: 0;
                 visibility: hidden;
                 transition: opacity 0.2s, visibility 0.2s;
             }

             /* Show dropdown */
             .dropdown-content.show {
                 display: block !important;
                 opacity: 1;
                 visibility: visible;
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
                 /* Default text color for light background */
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

             /* Dark theme text color */
             .dark-dropdown .dropdown-content a,
             .dark-dropdown .dropdown-content .logout-btn {
                 color: #fff !important;
             }

             .dropdown-content a:hover,
             .dropdown-content .logout-btn:hover {
                 color: #000 !important;
                 background-color: #f5f5f5;
             }

             .dark-dropdown .dropdown-content a:hover,
             .dark-dropdown .dropdown-content .logout-btn:hover {
                 color: #fff !important;
                 background-color: #444;
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
             function updateDropdownTextColor(dropdown) {
                 const content = dropdown.querySelector('.dropdown-content');
                 if (!content) return;

                 // Check if we're in dark mode (you might need to adjust this based on your theme)
                 const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                 if (isDark) {
                     dropdown.classList.add('dark-dropdown');
                     content.style.backgroundColor = '#333';
                     content.querySelectorAll('a, .logout-btn').forEach(item => {
                         item.style.color = '#fff';
                     });
                 } else {
                     dropdown.classList.remove('dark-dropdown');
                     content.style.backgroundColor = '#fff';
                     content.querySelectorAll('a, .logout-btn').forEach(item => {
                         item.style.color = '#333';
                     });
                 }
             }

             document.addEventListener('DOMContentLoaded', function() {
                 // Initialize all dropdowns
                 document.querySelectorAll('.dropdown').forEach(dropdown => {
                     updateDropdownTextColor(dropdown);
                 });

                 // Handle dropdown toggle
                 document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                     toggle.addEventListener('click', function(e) {
                         e.preventDefault();
                         e.stopPropagation();

                         const dropdown = this.closest('.dropdown');
                         const content = dropdown.querySelector('.dropdown-content');
                         const isVisible = content.classList.contains('show');

                         // Close other dropdowns
                         document.querySelectorAll('.dropdown-content').forEach(menu => {
                             if (menu !== content) {
                                 menu.classList.remove('show');
                                 menu.style.display = 'none';
                             }
                         });

                         if (isVisible) {
                             content.classList.remove('show');
                             content.style.display = 'none';
                         } else {
                             updateDropdownTextColor(dropdown);
                             content.style.display = 'block';
                             void content.offsetWidth; // force reflow
                             content.classList.add('show');
                         }
                     });
                 });

                 // Close on outside click
                 document.addEventListener('click', function(e) {
                     if (!e.target.closest('.dropdown')) {
                         document.querySelectorAll('.dropdown-content').forEach(menu => {
                             menu.classList.remove('show');
                             menu.style.display = 'none';
                         });
                     }
                 });
             });
         </script>