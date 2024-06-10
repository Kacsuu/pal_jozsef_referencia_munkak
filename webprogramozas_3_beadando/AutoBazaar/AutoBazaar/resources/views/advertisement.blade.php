@extends('layout')
@section('title', $car->brand->brand . ' ' . $car->type)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $car->title }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/'.$car->picture) }}" class="img-fluid" alt="{{ $car->brand->brand }} {{ $car->type }}">
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Brand:</strong> {{ $car->brand->brand }}</li>
                                <li class="list-group-item"><strong>Type:</strong> {{ $car->type }}</li>
                                <li class="list-group-item"><strong>Year:</strong> {{ $car->year }}</li>
                                <li class="list-group-item"><strong>Price:</strong> {{ $car->price }}€</li>
                                <li class="list-group-item"><strong>Odometer:</strong> {{ $car->odometer }} km</li>
                                <li class="list-group-item"><strong>Condition:</strong> {{ $car->condition->condition }}</li>
                                {{--<li class="list-group-item"><strong>Model:</strong> {{ $car->modell->model }}</li>--}}
                                <li class="list-group-item"><strong>Transmission:</strong> {{ $car->transmission->transmission }}</li>
                                <li class="list-group-item"><strong>Engine:</strong> {{ $car->engine }}</li>
                                <li class="list-group-item"><strong>Fuel:</strong> {{ $car->fuel->fuel }}</li>
                                <li class="list-group-item"><strong>Cylinder capacity:</strong> {{ $car->cylindercapacity }}</li>
                                <li class="list-group-item"><strong>Horsepower:</strong> {{ $car->horsepower }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4>Description:</h4>
                            <p>{{ $car->description }}</p>
                        </div>
                        <div class="col-md-12">
                            <h4>Extras:</h4>
                            <p>
                                @forelse ($car->extras as $extra)
                                    {{ '- '.$extra->extra }}
                                @empty
                                    <p>
                                        No extras.
                                    </p>
                                @endforelse
                            </p>
                        </div>
                    </div>
                    <div>
                        <h4>Interested? Contect the advertiser: </h4>
                        {{ $car->user->username }}
                        <p>{{ $car->user->phonenumber }}</p>
                    </div>
                </div>
                @if(auth()->check() && auth()->user()->id === $car->user_id)
                <div class="card" style="text-align: center; margin-top: 10px;">
                    Sold the car? Delete the advertisement:
                    <form method="POST" action="{{ route('advertisement.delete', $car->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="margin-bottom: 20px;">Delete Advertisement</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection