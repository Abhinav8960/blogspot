 <form method="GET" action="{{ route('contactus.index') }}" class="mb-5">
     <div class="row g-2">

         <!-- Name -->
         <div class="col-md-3">
             <input type="text"
                 name="name"
                 class="form-control"
                 placeholder="Search by Name"
                 value="{{ request('name') }}">
         </div>

         <!-- Email -->
         <div class="col-md-3">
             <input type="text"
                 name="email"
                 class="form-control"
                 placeholder="Search by Email"
                 value="{{ request('email') }}">
         </div>

         <!-- Phone -->
         <div class="col-md-3">
             <input type="text"
                 name="phone"
                 class="form-control"
                 placeholder="Search by Phone"
                 value="{{ request('phone') }}">
         </div>

         <!-- Buttons -->
         <div class="col-md-3 d-flex gap-2">
             <div class="justify-content-between align-items-center">

                 @if(request()->hasAny(['name','email','phone']))
                 <a href="{{ route('contactus.index') }}"
                     class="btn btn-outline-secondary"
                     title="Clear search">
                     Clear
                 </a>
                 @endif

                 <button class="btn btn-warning" type="submit">
                     Search
                 </button>
             </div>



         </div>

     </div>
 </form>