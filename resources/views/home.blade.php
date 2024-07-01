@extends('layouts.welcome')

@section('content')
    <div class="container w-full flex p-10  ">
        <x-aside/>
        <div class="flex items-start justify-evenly gap-3 w-5/6 flex-wrap">           
            @forelse ($articles as $article)
                <div class="w-72 bg-gray-800 rounded-md ">
                    <a href="{{route('article',$article->id)}}">
                        @forelse ($article->images as $image)
                            <img src="/storage/{{$image->path}}" alt="img" width="100%" class="rounded-md shadow-md">
                            @break
                        @empty
                            Pas d'image
                        @endforelse
                        <div class="p-3">
                            <h3 class="text-xl text-white/90 ">{{$article->title}}</h3>
                            <h4 class="text-xs text-white/50">{{$article->description}}</h4>
                            <p class="font-bold text-white/50 pt-2">Prix : {{$article->price}} €</p>
                        </div>
                    </a>
                </div>
            @empty
                Pas d'article disponible
            @endforelse
        </div>

    </div>

@endsection