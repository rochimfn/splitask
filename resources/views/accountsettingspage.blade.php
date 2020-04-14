
@include('inc.head')
@section('title', 'Account Settings')
<body>
<div class="container-fluid">
    <form method="post" action="{{ url()->current() }}" id="editForm">
      <div class="row">
            @csrf
            @method('PATCH')
          <div class="col-md-3">
              <button type="submit" class="btn btn-dark">Save</button>
          </div>
          <div class="col-md-9">
            <div class="d-flex justify-content-between mt-4">
                <h2>Account Settings</h2>
            </div>
            <div class="mt-4">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{\Session::get('success') }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </form>
                <div class="card">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" id="username" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="text" name="password" id="password" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" value="" disabled>
                  </div>
                  <div class="form-group">
                      <label for="department">Department</label>
                      <input type="text" value="" disabled>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </form>
</div>
@yield('script')
</body>
</html>
