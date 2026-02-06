<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    <header class="header">
        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <h1 class="post_title">Contact View</h1>

            <div class="post-form-wrapper">

                <div class="contact-view-box">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="view-label">Name</div>
                            <div class="view-value">
                                {{ $contact->name ?? 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="view-label">Phone Number</div>
                            <div class="view-value">
                                {{ $contact->phone ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="view-label">Email</div>
                            <div class="view-value">
                                {{ $contact->email ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="view-label">Message</div>
                            <div class="view-value message-box">
                                {{ $contact->message ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('contactus.index') }}" class="btn btn-outline-secondary px-4 back-btn">
                            ← Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

        @include('admin.footer')
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>