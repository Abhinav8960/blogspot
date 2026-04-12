<form method="GET" action="{{ route('admin.blogs.index') }}" class="admin-search-form">
    <div class="row g-2">

        <!--  Search -->
        <div class="col-md-3">
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
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Draft</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                <option value="-1" {{ request('status') == '-1' ? 'selected' : '' }}>Approved</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rejected</option>
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

        <div class="col-md-3">
            <button class="btn btn-warning" type="submit">
                Search
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                Clear
            </a>
        </div>
    </div>
</form>