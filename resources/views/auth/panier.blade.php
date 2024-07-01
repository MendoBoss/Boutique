@extends('layouts.welcome')
@section('content')

    <div class="flex gap-4">
        <div class="w-3/4 px-10 border-r-2 border-gray-800">
            <h1 class="text-5xl font-bold text-center">Panier</h1>
            
            <?php $total=0; ?>

            @forelse ($lignes->articles as $ligne)
                <div class="w-full my-5 flex items-center justify-between gap-5">
                    <div class="w-24">
                        @forelse ($ligne->images as $image)
                            <img src="/storage/{{$image->path}}" alt="img" width="100%" class="rounded-md">
                            @break
                        @empty
                            <p class="text-center">!! Pas d'image !!</p>
                        @endforelse
                    </div>
                    <div class=" flex-2">
                        <?php $total+=$ligne->price; ?>
                        {{$ligne->title}} <br> {{$ligne->price}} €
                    </div>
                    <div class="flex flex-1 items-center justify-end">
                        <input class="w-16 rounded-md bg-gray-100 text-gray-900" type="number" name="" id="" value="1">
                        <a href="{{route('deletePanier',$ligne->id)}}"><img src="/images/iconmonstr-trash-can-13-32.png" alt="trash" width="40px" class="pl-5"></a>
                    </div>
                </div>
            @empty
                <p class="text-center">Votre panier est vide !</p>
            @endforelse
                
        </div>
        <div class="w-1/4 px-10 flex flex-col items-center justify-start ">
            <div class="w-80 h-80">
                <img src="/images/MuriloBoutique.png" alt="">
            </div>
            <p>Prix estimé :               
                <?php echo $total; ?>
                 €
            </p>
            <div><button id="btnPayer1" class=" bg-indigo-600 hover:bg-indigo-500 py-2 px-3 mt-5 rounded-md text-sm w-80" >Payer ( {{$total}} )</button></div>
            <div><form action="{{route('storePanier')}}" method="post" id="formPayer1" hidden="hidden">
                @csrf
                <input type="hidden" value="{{$total}}" name="total">
                <input type="hidden" name="payment_method" id="payment_method">
                <div id="card-element"></div>
                <button id="btnPayer2" class=" bg-indigo-600 hover:bg-indigo-500 py-2 px-3 mt-5 rounded-md text-sm w-80" >Payer ( {{$total}} )</button>
            </form></div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3"></script>
    <script>

        const stripe = Stripe(" {{ env('STRIPE_KEY') }} ");

        const elements = stripe.elements();
        const cardElement = elements.create('card',{
            classes:{
                base:'StripeElement bg-white w1/2 p-2 my-2'
            }
        });
        cardElement.mount('#card-element');

        const btnPayer1 = document.getElementById('btnPayer1');
        const formPayer1 = document.getElementById('formPayer1');
        btnPayer1.addEventListener('click',function(){ 
            btnPayer1.setAttribute('hidden', 'hidden');
            formPayer1.removeAttribute('hidden');
        });
        const btnPayer2 = document.getElementById('btnPayer2');
        btnPayer2.addEventListener('click',async(e)=>{
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);

            if (error) {
                alert(error)
            } else {
                document.getElementById('payment_method').value = paymentMethod.id;
            }
            document.getElementById('formPayer1').submit();
         });
    </script>


@endsection