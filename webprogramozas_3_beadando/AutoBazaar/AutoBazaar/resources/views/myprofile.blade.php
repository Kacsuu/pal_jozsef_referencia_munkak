@extends('layout')
@section('title', 'My profile')
@section('content')

@php
    use App\Models\Car;
    $user = Auth::user();
    $user_cars = Car::where('user_id', $user->id)->get();
@endphp
<div style="text-align: center">
    <h1>My profile: </h1>
</div>
<form action="{{route('myprofile.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
    @csrf

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" value="{{ $user->username }}"></input>
    </div>
    <div class="mb-3">
        <label class="form-label">Phonenumber</label>
        <input type="text" class="form-control" name="phonenumber" value="{{ $user->phonenumber }}"></input>
    </div>
    <button type="submit" class="btn btn-success">Update profile</button>
</form>

<form action="{{ route('myprofile.delete') }}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete Account</button>
</form>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete your account?');
    }
</script>

<div class="container" style="margin-left: 10%; margin-right: 10%;">
    <h2>My advertisements: </h2>
    @foreach($user_cars as $car)
        <div class="col-12 shadow-sm bg-white p-2 d-flex mb-2 br5">
            <div class="image bg-info">
                <img class="br5" src="{{ asset('storage/'.$car->picture) }}" width="150px" height="150px" style="object-fit: cover">
            </div>
            <div class="px-2 content">
                <a class="mb-1 fw600" href="{{route('advertisement',['id' => $car->id])}}">{{ $car->title }}</a>
                <p class="mb-1 text-cl fw400">{{ $car->brand->brand }} {{ $car->type }}</p>
                <p class="mb-1 text-cl fw400">{{ $car->fuel->fuel }} | {{ $car->cylindercapacity }} cm<sup>3</sup></p>
                <p class="mb-1 text-cl fw400"> Year of make: {{ $car->year }} | Posted: {{ $car->created_at }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection