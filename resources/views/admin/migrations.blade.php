
<x-admin-main>

    <div class="w-full h-full">

        <div class="py-5">

            <div class="w-full h-fullitems-center justify-center flex flex-col gap-14 px-7">

                <div class="w-full flex justify-between">
                    <x-button tipo="back" route="database">Volver</x-button>
                </div>

                <x-table-grid :table="$migrations" :keys="$keys" key="Migraciones">

                </x-table-grid>


            </div>
        </div>
    </div>
</x-admin-main>
