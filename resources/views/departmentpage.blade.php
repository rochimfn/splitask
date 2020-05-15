@extends('layouts.default')

@section('title', 'Department Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <h2>Department Page</h2>
    </div>
    <div class="mt-2">
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
            @foreach($departments as $department)
        <div id="accordion" class="mt-3 col-md-12 col-lg-10">
            <div class="card">
                <div class="card-header" id="heading{{ $department['department_id']}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$department['department_id']}}" aria-expanded="true" aria-controls="collapse{{$department['department_id']}}">
                            <h3>{{ $department['department_name'] }}</h3>
                        </button>
                    </h5>
                </div>
                <div id="collapse{{$department['department_id']}}" class="collapse" aria-labelledby="heading{{$department['department_id']}}" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($works as $work)
                            @if($work['department_id'] == $department['department_id'])
                        <a href="{{ route('chief.task.show', $work['work_id']) }}" class="text-decoration-none text-black-50"><h4>{{ $work['work_name']}}</h4></a>
                        <hr>
                            @endif
                        @endforeach
                        <div class="text-center">
                            <button class="btn btn-light" onclick="addWork({{ $department['department_id'] }},{{ $department['user_id']}})">+ Add Work</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                @endforeach
    </div>
@endsection
@section('script')
    @include('inc.script')
    @include('addworkpopup')
@endsection
