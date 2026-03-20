<form method="GET" action="{{ route('posts.index') }}" class="mb-5">
    <div class="row">

        <!--  Search -->
        <div class="col-md-4">
            <input type="text"
                name="search"
                class="form-control"
                placeholder="Title"
                value="{{ request('search') }}">
        </div>

        <!--  Status Filter -->
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                <option value="-1" {{ request('status') == '-1' ? 'selected' : '' }}>Deleted</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Restored</option>
            </select>
        </div>

        <!--  Date Filter -->
        <div class="col-md-3">
            <input type="date"
                name="date"
                class="form-control"
                value="{{ request('date') }}">
        </div>

        <!-- Submit -->

        <div class="col-md-2">
            <button class="btn btn-warning" type="submit">
                Search
            </button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                Clear
            </a>
        </div>
    </div>
</form>