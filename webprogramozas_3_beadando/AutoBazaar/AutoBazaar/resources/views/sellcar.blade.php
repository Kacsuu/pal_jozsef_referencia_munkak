@extends('layout')
@section('title', 'Sell car')
@section('content')
<div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
        <div style="text-align: center">
            <h1>Sell car: </h1>
        </div>
        <form action="{{route('sellcar.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Advertisement title</label>
                <input type="text" class="form-control" name="title" maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea type="text" class="form-control" name="description" rows="6" maxlength="5000"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price in euros</label>
                <input type="number" class="form-control" name="price">
            </div>
            <div class="mb-3">
            <label class="form-label">Brand</label>
            <select name="brand" style="width: 200px">
                @foreach($brand as $row)
                    <option value="{{$row->id}}">{{$row->brand}}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" class="form-control" name="type">
            </div>
            <div class="mb-3">
            <label class="form-label">Model</label>
            <select name="model" style="width: 200px">
                @foreach($model as $row)
                    <option value="{{$row->id}}">{{$row->model}}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Condition</label>
            <select name="condition" style="width: 200px">
                @foreach($condition as $row)
                    <option value="{{$row->id}}">{{$row->condition}}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Year of manufacture</label>
                <input type="number" class="form-control" name="year">
            </div>
            <div class="mb-3">
                <label class="form-label">Odometer (km)</label>
                <input type="number" class="form-control" name="odometer">
            </div>
            <div class="mb-3">
                <label class="form-label">Engine</label>
                <input type="text" class="form-control" name="engine">
            </div class="mb-3">
            <label class="form-label">Fuel</label>
            <select name="fuel" style="width: 200px">
                @foreach($fuel as $row)
                    <option value="{{$row->id}}">{{$row->fuel}}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label class="form-label">Cylinder capacity (cm<sup>3</sup>)</label>
                <input type="text" class="form-control" name="cylindercapacity">
            </div>
            <div class="mb-3">
                <label class="form-label">Horsepower</label>
                <input type="number" class="form-control" name="horsepower">
            </div class="mb-3">
            <label class="form-label">Transmission</label>
            <select name="transmission" style="width: 200px">
                @foreach($transmission as $row)
                    <option value="{{$row->id}}">{{$row->transmission}}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label class="form-label">Picture</label>
                <input type="file" class="form-control" name="picture">
            </div>
            <div class="mb-3">
                <label class="form-label">Extras: </label>
                @foreach($extras as $extra)
                    <div>
                        <input type="checkbox" name="extras[]" value="{{ $extra->id }}">
                        <label>{{ $extra->extra }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success" style="margin-bottom: 50px;">Post advertisement</button>
        </form>
</div>
@endsection