@extends('navbar')

@section('title', 'Dashboard - Laravel Admin Panel With Login and Registration')

@section('content')
<section class="dark:bg-gray-900 py-12">
    <div class="container mx-auto px-6 lg:px-8 py-12">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">About Us</h2>
            <p class="mt-4 text-lg leading-6 text-white">
                We are a team of passionate individuals dedicated to delivering the best services to our customers.
            </p>
        </div>

        <div class="mt-10 flex flex-wrap justify-center">
            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4 hover">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIf2W5L2yBQZ3S-mhC8cdAn4gm9BMkS7aNETDTtstAuFVLpX7tvJ8XfH-d7H_5emICBtI&usqp=CAU"
                    alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Hospital Mitra Keluarga</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste quo
                        veritatis dolores modi sunt nisi! Dolores veniam, recusandae fugit pariatur adipisci neque
                        voluptates minima, quaerat eos vitae cum vel velit!</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://static.gatra.com/foldershared/images/2021/farid/06-Jun/IMG_62011.jpg" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Hospital Kardinah</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati
                        velit minus ullam sed fugiat commodi voluptatibus repellendus optio sit temporibus possimus
                        repellat sapiente maiores molestiae, totam nihil quidem, consequatur aperiam?</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://globalrancangselaras.com/images/169094387946.jpg" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Hospital Islam Harapan Anda</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum
                        temporibus magnam culpa soluta, asperiores eligendi adipisci iusto sequi nobis eveniet sapiente
                        obcaecati? Adipisci quod dolorum dolores impedit fugit libero. Rem.</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom"
                    src="https://rsudsoeselo.tegalkab.go.id/wp-content/uploads/2021/04/WhatsApp-Image-2021-04-28-at-12.55.59.jpeg"
                    alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Hopital Susilo</h3>
                    <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum
                        temporibus magnam culpa soluta, asperiores eligendi adipisci iusto sequi nobis eveniet sapiente
                        obcaecati? Adipisci quod dolorum dolores impedit fugit libero. Rem.</p>
                </div>
            </div>

            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img class="w-full h-56 object-cover object-center hover-zoom" src="" alt=""
                    style="transition: transform 0.5s ease;">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">Our Values</h3>
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
