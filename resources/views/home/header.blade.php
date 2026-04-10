           <!-- Font Awesome for icons -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
           <!-- Custom dropdown styles -->
           <div class="header_main">
               <div class="container-fluid">
                   @include('home.logo')
                   <!-- Hamburger Icon -->
                   <div class="hamburger-btn">
                       <i class="fas fa-bars"></i>
                   </div>
                   <div class="menu_main">
                       <ul style="display: flex; list-style: none; margin: 0; padding: 0 40px; width: 100%; justify-content: space-between; max-width: 1100px; margin: 0 auto;">
                           <li><a href="{{ url('/') }}">Home</a></li>
                           <li><a href="{{ route('about') }}">About</a></li>
                           <li><a href="{{ route('blog') }}">Blog</a></li>
                           <li><a href="{{ route('posts') }}">Post</a></li>
                           <li><a href="{{ route('contactus') }}">Contact us</a></li>
                           @if (Route::has('login'))
                           @auth

                           <li class="dropdown" style="position: relative;" style="display:flex; align-items:center; gap:20px;">
                               <a href="#" class="dropdown-toggle">
                                   {{-- Profile Image --}}
                                   <img src="{{ Auth::user()->profile_photo ? asset('uploads/profile/'.Auth::user()->profile_photo) : asset('images/default-user.png') }}"
                                       style="width: 32px; height:32px; border-radius:60%; object-fit:cover;">

                                   {{-- Username --}}
                                   {{ Auth::user()->name }}</a>
                               <ul class="dropdown-content" style="position: absolute; right: 0; z-index: 1000; min-width: 200px; background: #89d8fc; border-radius: 4px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 5px 0;">
                                   <li style="padding: 3px 0;"><a href="{{ route('profile.show') }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-user"></i> Profile</a></li>
                                   <li style="padding: 3px 0;"><a href="{{ route('home.userposts', auth()->id()) }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-paw"></i> My Posts</a></li>
                                   <li style="padding: 3px 0;"><a href="{{ route('home.userblogs', auth()->id()) }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-blog"></i> My Blogs</a></li>
                                   @if(auth()->user()->isAdmin())
                                   <li style="padding: 3px 0;"><a href="{{ route('admin.dashboard') }}" style="display: block; padding: 8px 20px; color: #333; text-decoration: none; transition: all 0.3s ease; border-radius: 4px; margin: 0 5px;"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                   @endif
                                   <li class="divider" style="height: 1px; background: #89d8fc; margin: 5px 0;"></li>
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

           <style>
               .dropdown-toggle img {
                   border: 2px solid #fff;
                   transition: 0.3s;
               }

               .dropdown-toggle:hover img {
                   transform: scale(1.1);
                   border-color: #89d8fc;
                   box-shadow: 0 0 8px #89d8fc;
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

                   // Mobile Hamburger Toggle
                   const hamburger = document.querySelector('.hamburger-btn');
                   const menuMain = document.querySelector('.menu_main');

                   if (hamburger) {
                       hamburger.addEventListener('click', function() {
                           menuMain.classList.toggle('open');
                       });
                   }
               });
           </script>