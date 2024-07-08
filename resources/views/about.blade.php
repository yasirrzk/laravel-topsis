@extends('navbar')

@section('title', 'Dashboard - Laravel Admin Panel With Login and Registration')

@section('content')
<section class="dark:bg-gray-900 py-12" style="background-image: url('https://i.pinimg.com/564x/b5/38/df/b538df85ed00fe287a37410cdd9a9794.jpg'); background-size: cover;">
    <div class="container mx-auto px-6 lg:px-8 py-12">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Menu Makanan</h2>
            <p class="mt-4 text-lg leading-6 text-white">
               Ini adalah beberapa contoh menu makanan
            </p>
        </div>

        <div class="mt-10 flex flex-wrap justify-center">
            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4 hover">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://i.pinimg.com/564x/08/ed/43/08ed433aaea92d6fa6d3637c831c76d8.jpg"
                    alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Beef Bowl</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste quo
                        veritatis dolores modi sunt nisi! Dolores veniam, recusandae fugit pariatur adipisci neque
                        voluptates minima, quaerat eos vitae cum vel velit!</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://i.pinimg.com/564x/17/56/32/175632790afaf54b671379a7245cdf97.jpg" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Rainbow Cake</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati
                        velit minus ullam sed fugiat commodi voluptatibus repellendus optio sit temporibus possimus
                        repellat sapiente maiores molestiae, totam nihil quidem, consequatur aperiam?</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://i.pinimg.com/564x/b3/9b/89/b39b89773a7108b9fc8aff31a11b14ce.jpg" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Chicken Fingers</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum
                        temporibus magnam culpa soluta, asperiores eligendi adipisci iusto sequi nobis eveniet sapiente
                        obcaecati? Adipisci quod dolorum dolores impedit fugit libero. Rem.</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://i.pinimg.com/564x/4c/1c/72/4c1c72bd2cc4f0e76fde6096332d6521.jpg"
                    alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Onion rings</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum
                        temporibus magnam culpa soluta, asperiores eligendi adipisci iusto sequi nobis eveniet sapiente
                        obcaecati? Adipisci quod dolorum dolores impedit fugit libero. Rem.</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom" src="https://i.pinimg.com/564x/19/31/ea/1931ea180f40e54e9d877a39d47e18bb.jpg" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Roti Bakar</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum
                        temporibus magnam culpa soluta, asperiores eligendi adipisci iusto sequi nobis eveniet sapiente
                        obcaecati? Adipisci quod dolorum dolores impedit fugit libero. Rem.</p>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    // Menambahkan efek hover zoom pada semua gambar dengan class "hover-zoom"
    document.querySelectorAll('.hover-zoom').forEach(function(img) {
        img.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.2)';
        });

        img.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
@endsection
{{-- @extends('footer') --}}
