<div class="sticky top-0 w-1/6 flex flex-col justify-start items-start border-r-2 border-gray-900 mr-10">
    <div class="sticky top-24 flex flex-col gap-2">
        <a href="{{route('home')}}" class="hover:text-yellow-600">Tous les articles</a>
        <br>        
        @forelse ($categories as $categorie)
            <a href="{{route('categorie',$categorie->id)}}" class="hover:text-yellow-600"> {{$categorie->title}} </a>
            
        @empty
        Aucune categorie disponible
        @endforelse
    </div>
</div>