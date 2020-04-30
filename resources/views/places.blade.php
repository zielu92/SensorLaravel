@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Places</h1>
        </div>
    </div>
    <div class="row">
        @foreach($places as $place)
            <div class=" col-lg-6 col-md-6 col-sm-12">
                <a href="{{route('location.show', $place->id)}}" class="card">
                    <div class="card__head">
                        <div class="card__image" style=' background-image: url("{{$place->picture!=null ? asset($place->picture->path) : asset('img/kmutt.jpg') }}");'></div>
                        <div class="card__place">
                            <div class="place">
                                <img src="{{$place->icon!=null ? asset($place->icon->path) : asset('img/logo.png') }}" alt="{{$place->name}}" class="place__image">
                                <div class="place__content">
                                    <p class="place__header">{{$place->name}}</p>
                                    <p class="place__subheader">Locations: {{$place->location()->count()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card__body">
                        <h2 class="card__headline">TEMP PM2.5 PM10</h2>
                        <p class="card__text">{{$place->details}}</p>
                        <p class="card__text">Last update</p>
                    </div>
                    <div class="card__foot">
                        <span class="card__link">Read more</span>
                    </div>
                    <div class="card__border"></div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
    const height = (elem) => {

    return elem.getBoundingClientRect().height

    }

    const distance = (elemA, elemB, prop) => {

    const sizeA = elemA.getBoundingClientRect()[prop]
    const sizeB = elemB.getBoundingClientRect()[prop]

    return sizeB - sizeA

    }

    const factor = (elemA, elemB, prop) => {

    const sizeA = elemA.getBoundingClientRect()[prop]
    const sizeB = elemB.getBoundingClientRect()[prop]

    return sizeB / sizeA

    }

    document.querySelectorAll('.card').forEach((elem) => {

    const head = elem.querySelector('.card__head')
    const image = elem.querySelector('.card__image')
    const place = elem.querySelector('.card__place')
    const body = elem.querySelector('.card__body')
    const foot = elem.querySelector('.card__foot')

    elem.onmouseenter = () => {

    elem.classList.add('hover')

    const imageScale = 1 + factor(head, body, 'height')
    image.style.transform = `scale(${ imageScale })`

    const bodyDistance = height(foot) * -1
    body.style.transform = `translateY(${ bodyDistance }px)`

    const placeDistance = distance(head, place, 'height')
    place.style.transform = `translateY(${ placeDistance }px)`

    }

    elem.onmouseleave = () => {

    elem.classList.remove('hover')

    image.style.transform = `none`
    body.style.transform = `none`
    place.style.transform = `none`

    }

    })
</scripts>
    @endsection
