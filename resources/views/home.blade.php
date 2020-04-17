@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form>
                        
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Location</label>
                            <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                                @foreach ($locations as $location)
                                    <option>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Check In</button>
                        </div>
                    </form>

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
