@extends('layouts.app')

@section('content')
    <div class="p-10">
        <h1 class="text-center text-5xl font-semibold text-gray-500">Ajout d'article</h1>

        <div>
            <form action="{{route('storeArticle')}}" method="post" class="w-3/4 flex flex-col mx-auto gap-5 py-10" enctype="multipart/form-data">
                @csrf
                <div class="flex gap-5 justify-evenly">
                    <div class="flex flex-col justify-between w-4/6">
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Titre :</label>
                            <input type="text" name="title" class="rounded-md bg-gray-200">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Description :</label>
                            <textarea name="description" id="" cols="30" rows="3" class="rounded-md bg-gray-200"></textarea>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Contenu :</label>
                            <textarea name="content" id="" cols="30" rows="3" class="rounded-md bg-gray-200"></textarea>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between w-2/6">
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Catégorie :</label>
                            <select name="categorie" id="" class="rounded-md bg-gray-200">
                                <option value="">...</option>
                                @forelse ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->title}}</option>                                
                                @empty
                                    <option value="">Pas de catégorie</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Prix :</label>
                            <input type="number" name="price" min="0" step="0.01" id="" class="rounded-md bg-gray-200">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Stock :</label>
                            <input type="number" name="stock" min="0" id="" class="rounded-md bg-gray-200">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-500 font-semibold text-xs" for="">Photo :</label>
                            <input type="file" name="image" id="" class="rounded-md bg-gray-200">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <input type="submit" value="Enregistrer" class="bg-indigo-600 hover:bg-indigo-500 rounded-md text-gray-200 py-2 px-3">
                </div>
            </form>
        </div>
    </div>
@endsection