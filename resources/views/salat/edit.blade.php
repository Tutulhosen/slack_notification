@extends('layout.app')

@section('main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Edit Salat Time</h2>
                    <a href="{{ route('salat-time.index') }}" class="btn btn-success btn-md m-2">List</a>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('salat-time.update', $salatTime->id) }}" method="POST">
                        @csrf
                       
                        <div class="mb-3">
                            <label for="salatName" class="form-label">Salat Name</label>
                            <input type="text" class="form-control" id="salatName" name="salat_name" value="{{ old('salat_name', $salatTime->salat_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ajanTime" class="form-label">Ajan Time</label>
                            <input type="time" class="form-control" id="ajanTime" name="ajan_time" value="{{ old('ajan_time', $salatTime->ajan_time ? $salatTime->ajan_time->format('H:i') : '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="namazTime" class="form-label">Namaz Time</label>
                            <input type="time" class="form-control" id="namazTime" name="namaz_time" value="{{ old('namaz_time', $salatTime->namaz_time ? $salatTime->namaz_time->format('H:i') : '') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@endsection
