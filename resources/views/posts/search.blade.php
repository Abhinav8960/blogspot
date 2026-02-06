<form method="GET" action="{{ route('posts.index') }}" class="mb-5">
    <div class="row">
        <div class="col-md-5">
            <div class="input-group">

                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search posts..."
                    value="{{ request('search') }}">

                @if(request('search'))
                <div class="input-group-append">
                    <a href="{{ route('posts.index') }}"
                        class="btn btn-outline-secondary"
                        title="Clear search">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                @endif

                <div class="input-group-append">
                    <button class="btn btn-warning" type="submit">
                        Search
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>