@extends('layout.app')
@section('main-content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">Salat Times</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{route('salat-time.create')}}" class="btn btn-success btn-md m-2">Create New</a>
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Salat Name</th>
                        <th scope="col">Ajan Time</th>
                        <th scope="col">Namaz Time</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salatTimes as $salatTime)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $salatTime->salat_name }}</td>
                            <td>{{ $salatTime->ajan_time }}</td>
                            <td>{{ $salatTime->namaz_time }}</td>
                            <td>
                                <a href="{{route('salat-time.edit', $salatTime->id)}}" type="button" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil"></i> Update</a>
                                <a href="{{route('salat-time.delete', $salatTime->id)}}" type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
   
</div>
@endsection