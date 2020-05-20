<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <title>Account Settings Page</title>
</head>
<body class="bg-blue-splitask">
<div class="container">
  <div class="row justify-content-center">
    <div class="bg-light col-md-6 my-3 rounded">
      <form method="post" action="{{ url()->current() }}"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="d-flex justify-content-between mt-4">
            <h2 class="text-center">Account Settings</h2>
            <a href="{{ url('/') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 24 24" width="24">
                    <path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
                <!-- Go back -->
            </a>
        </div>
        <hr>
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
        </div>
        <div class="form-group">
          <img src="{{ asset('images/profile_picture/'. Auth::user()->profile_picture ) }}" class="img-fluid rounded-circle d-block mx-auto" width="360px" alt="profilepicture" id="profilePict">
        </div>
        <div class="form-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" name="profile_picture" id="customFile" accept="image/jpeg, image/png" onchange="readURL(this)">
                  <label class="custom-file-label" for="customFile">Choose Profile Picture</label>
              </div>
          </div>
        <div class="form-group">
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
          </div>
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" class="form-control" value="{{ Auth::user()->user_name }}" disabled>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="text" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
              <label for="role">Role</label>
              <input type="text" value="{{ ucfirst(Auth::user()->position) }}" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for="department">Department</label>
              <input type="text" value="{{ $department->department_name }}" class="form-control" disabled>
          </div>
          <div class="form-group">
              <button class="btn btn-dark" id="saveButton">Update</button>
              <button class="btn btn-outline-dark" type="button" onClick="window.location.href=window.location.href">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @include('inc.script')
  <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            document.querySelector('label[for="customFile"]').textContent = input.files[0].name;
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profilePict')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
</body>
</html>
