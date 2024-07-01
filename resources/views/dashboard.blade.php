{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             {{ __('Dashboard') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 --}}

@extends('layouts.app')

@section('content')
    {{-- @dd($articles) --}}
    <div class="bg-gray-900">
        <div class="mx-auto max-w-7xl">
          <div class="bg-gray-900 py-10">
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <h1 class="text-base font-semibold leading-6 text-white">Articles</h1>
                  {{-- <p class="mt-2 text-sm text-gray-300">A list of all the users in your account including their name, title, email and role.</p> --}}
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                  {{-- <button type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Ajouter un article</button> --}}
                  <a href="{{route('addArticle')}}" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Ajouter un article</a>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-700">
                      <thead>
                        <tr>
                          <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">image</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Title</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Description</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Contenu</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Prix</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">stock</th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Edit</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-800">
                        @forelse ($articles as $article)
                            {{-- @foreach ($article->categories as $categorie)
                                @switch($categorie->id)
                                    @case(1)
                                        <?php $color='indigo'  ?>
                                    @break
                                    @case(2)
                                        <?php $color='gray'  ?>
                                    @break
                                    @case(3)
                                        <?php $color='red'  ?>
                                    @break
                                
                                @default
                                        
                                @endswitch
                            @endforeach --}}
                            <tr class="">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                @forelse ($article->images as $image)
                                    <img src="/storage/{{$image->path}}" alt="img" class="rounded-lg" width="50px">
                                    @break
                                @empty
                                    Pas d'image !
                                @endforelse
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{substr($article->title,0,20)}} ...</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{substr($article->description,0,20)}} ...</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{substr($article->content,0,20)}} ...</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{$article->price}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{$article->stock}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <a href="{{route('updateArticle',$article->id)}}" class="text-indigo-400 hover:text-indigo-300">Edit<span class="sr-only">, Lindsay Walton</span></a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <a href="{{route('deleteArticle',$article->id)}}" class="text-indigo-400 hover:text-indigo-300">Delete<span class="sr-only">, Lindsay Walton</span></a>
                            </td>
                            </tr>
                            @empty
                                <tr><td colspan="8" class="text-center text-gray-200 text-sm p-5 font-light">Pas D'article ici !</td></tr>
                        @endforelse
      
                        <!-- More people... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
@endsection