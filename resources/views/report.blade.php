@extends('layouts.app')

@section('content')
<div class="container">
    <table id="basic-laratable" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Check In</th>
                <th>Check Out</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@push('scripts')
<script>

    $(document).ready(function(){
        $("#basic-laratable").DataTable({
            serverSide: true,
            ajax: "{{ route('user_locations.datatable') }}",
            columns: [
                { name: 'user.name' },
                { name: 'location.name' },
                { name: 'check_in' },
                { name: 'check_out' },

            ],
            order: false,
        });
    });

</script>
@endpush
