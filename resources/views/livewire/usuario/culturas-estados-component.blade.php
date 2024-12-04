

<div>
    <section class="bg-gray-100 p-8">

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Culturas de {{$estado->nombre}}</h1>

        <!-- GRILLA -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-8">
            <!-- TARJETAS DE LAS CULTURAS -->
            @foreach ($culturas as $cultura)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 cursor-pointer"
                    wire:click="show({{$cultura->idCultura}})"
                >
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{img_u_url($cultura->fotos->first()?->foto)}}');">
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">Cultura {{$cultura->nombre}}</h2>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{$cultura->significado}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <x-paginador :table="$culturas" />

    </section>

    @if ($openShow)
        <x-modal openPropiety="openShow" class="!w-11/12">

            <div class="container rounded-md">
                <div class="slide rounded-md">
                    <!-- IMAGEN 1 -->
                    <div class="item" style="background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url('{{img_u_url($this->cultura->fotos->first()?->foto)}}');">
                        <div class="content">
                            <div class="name">{{$this->cultura->nombre}} </div>
                            <div class="des">
                                {{$this->cultura->periodo}}
                            </div>
                            {{-- <a href="DetallesCulturas/AguasCalientes/guachichiles.html"><button>Ver Más</button></a> --}}
                        </div>
                    </div>

                    <!-- IMAGEN 2 -->
                    <div class="item shadow-gray-300 shadow-md" style="background-image: url('{{img_u_url($this->cultura->fotos->skip(1)->first()?->foto)}}');">
                    </div>
                </div>
{{--
                <div class="button">
                    <button class="prev"><i class="fa-solid fa-circle-arrow-left"></i></button>
                    <button class="next"><i class="fa-solid fa-circle-arrow-right"></i></button>
                </div> --}}
            </div>

            {{-- detalles --}}
            <div class="w-full p-8 flex flex-col gap-8 mx-auto bg-white shadow-md rounded-xl overflow-hidden mt-12">
                <!-- Encabezado -->
                <div class="">
                    <p class="text-lg text-gray-600"><strong>Significado:</strong> {{ $cultura->significado }}</p>
                </div>

                <!-- Contenido principal -->
                <div class="grid gap-14 sm:grid-cols-1 md:grid-cols-2 text-justify">
                    <!-- Descripción -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Descripción</h2>
                        <p class="text-gray-600 leading-relaxed ">
                            {{ $this->cultura->descripcion }}
                        </p>
                    </div>

                    <!-- Aportaciones -->
                    <div class="">
                        <h2 class="text-end text-xl font-semibold text-gray-800 mb-2">Aportaciones</h2>
                        <p class="text-gray-600 leading-relaxed ">
                            {{ $this->cultura->aportaciones }}
                        </p>
                    </div>
                </div>

                <!-- Fotos -->
                <div class=" grid gap-14 sm:grid-cols-1 md:grid-cols-2">
                    @if($this->cultura->fotos->skip(2)->first()?->foto)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ img_u_url($this->cultura->fotos->skip(2)->first()?->foto) }}" alt="Foto 1" class="w-full h-full object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    @if($this->cultura->fotos->skip(3)->first()?->foto)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ img_u_url($this->cultura->fotos->skip(3)->first()?->foto) }}" alt="Foto 2" class="w-full h-full object-cover rounded-lg shadow-md">
                        </div>
                    @endif
                </div>
            </div>

            {{-- cerrar --}}
            <div class="flex flex-row justify-end items-center">
                <x-button tipo="close" wire:click="$set('openShow', false)">
                    Cerrar
                </x-button>
            </div>

        </x-modal>
    @endif
</div>
