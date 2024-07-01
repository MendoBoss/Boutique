@extends('layouts.welcome')

@section('content')
    <div class="w-full h-screen flex">
        <x-aside/>
        <div class="w-5/6">
            <div class="flex w-full">
                {{-- image --}}
                <div class="w-80 h-80 ">
                    @forelse ($article->images as $image)
                    <img src="/storage/{{$image->path}}" alt="img" width="100%" class="rounded-md shadow-md">
                    @break
                    @empty
                    <h2>Nous n'avons pas trouvé d'image</h2>
                    @endforelse
                </div>
                {{-- tritre / prix / description --}}
                <div class="relative px-10 flex flex-col gap-4">
                    <h2 class="text-2xl border-b-2 border-yellow-900">{{$article->title}}</h2>                
                    <h3 class="flex items-baseline"><p class="text-xs text-white/25">Prix : &ensp; </p> {{$article->price}} € TTC</h3>
                    <p class="text-xs text-white/25">Description : </p>
                    <h3>{{$article->description}}</h3>
                    <p class="text-white/25 text-xs font-extralight pt-10">{{$article->stock}} articles en stock</p>
                    <a href="{{route('addPanier',$article->id)}}" class="absolute bottom-0 w-80 p-2 font-semibold rounded-sm bg-indigo-600 hover:bg-indigo-500 text-white text-center">Ajouter au panier</a>
                </div>
                </div>
                <div class="pt-10">
                    <p>{{$article->content}}</p>
                </div>
        </div>
    </div>
@endsection