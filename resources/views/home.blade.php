@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Project Management Tool is a software used for planning, tracking and managing projects. With these tools, teams can organize tasks more effectively and complete projects on time.') }}

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Projects</h5>
                                    <p class="card-text">Manage your projects.</p>
                                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Go to Projects</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Tasks</h5>
                                    <p class="card-text">Manage your tasks.</p>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Go to Tasks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
