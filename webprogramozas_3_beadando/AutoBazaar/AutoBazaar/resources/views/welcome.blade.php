@extends('layout')
@section('title', "AutoBazaar")
@section('content')
<div class="container" style="margin-left: 10%; margin-right: 10%;">
    @foreach($cars as $car)
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