<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @include('admin.css')
</head>

<body>
    <header class="header">
        @include('admin.header')
    </header>

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content">
            <div class="d-flex justify-content-between align-items-center page-content-heading">
                <h1 class="post_title">Blog Details</h1>

                <a href="{{ route('admin.blogs.pendingblogs') }}" class="btn btn-secondary mt-3 mr-4">
                    Go back to list
                </a>
            </div>

            <div class="post-form-wrapper mt-4">
                <div class="post-form">

                    <table style="width: 100%; border-collapse: collapse;">

                        <!-- Row 1: Author Name + Status -->
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="width: 130px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: middle;">Author Name</td>
                            <td style="padding: 14px 16px; font-size: 14px; vertical-align: middle;">{{ $blog->user->name ?? 'N/A' }}</td>

                            <td style="width: 80px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: middle; border-left: 1px solid #dee2e6;">Status</td>
                            <td style="padding: 14px 16px; vertical-align: middle;">
                                <span class="badge {{ $blog->status_meta['class'] }}">
                                    {{ $blog->status_meta['label'] }}
                                </span>
                            </td>

                            @if($blog->status == 'approved')
                            <td style="width: 80px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: middle; border-left: 1px solid #dee2e6;">Publish Status</td>
                            <td style="padding: 14px 16px; vertical-align: middle;">
                                <span class="badge {{ $blog->publish_meta['class'] }}">
                                    {{ $blog->publish_meta['label'] }}
                                </span>
                            </td>
                            @endif
                        </tr>

                        <!-- Row 2: Excerpt -->
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="width: 130px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: top;">Excerpt</td>
                            <td colspan="3" style="padding: 14px 16px; font-size: 14px; vertical-align: top;">{{ $blog->excerpt }}</td>
                        </tr>

                        <!-- Row 3: Content -->
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="width: 130px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: top;">Content</td>
                            <td colspan="3" style="padding: 14px 16px; font-size: 14px; vertical-align: top;">{!! $blog->content !!}</td>
                        </tr>

                        <!-- Row 4: Featured Image + Featured Video -->
                        <tr>
                            <td style="width: 130px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: top;">Featured Image</td>
                            <td style="padding: 14px 16px; vertical-align: top;">
                                @if($blog->featured_image)
                                <img src="{{($blog->featured_image) }}" alt="{{ $blog->title }}" width="300">
                                @else
                                <p class="text-muted mb-0">No Image</p>
                                @endif
                            </td>

                            <td style="width: 130px; padding: 14px 16px; background: #f8f9fa; font-weight: 600; color: #212529; font-size: 14px; vertical-align: top; border-left: 1px solid #dee2e6;">Featured Video</td>
                            <td style="padding: 14px 16px; vertical-align: top;">
                                @if($blog->featured_video)

                                <video width="300" controls>
                                    <source src="{{ ($blog->featured_video) }}" alt="{{ $blog->title }}">
                                    Your browser does not support the video tag.
                                </video>
                                @else
                                <p class="text-muted mb-0">No Video</p>
                                @endif
                            </td>
                        </tr>

                    </table>

                    <!-- Buttons -->
                    <div class="form-group text-right mt-4">
                        @if($blog->status == 'pending')
                        <form action="{{ route('admin.blogs.approve', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>

                        <form action="{{ route('admin.blogs.reject', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>

                        @elseif($blog->status == 'approved')

                        @if($blog->is_published)
                        <form action="{{ route('admin.blogs.unpublish', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Unpublish</button>
                        </form>
                        @else
                        <form action="{{ route('admin.blogs.publish', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Publish</button>
                        </form>
                        @endif

                        @endif
                    </div>

                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>

    @include('admin.js')
</body>

</html>