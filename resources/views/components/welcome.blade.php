<div class="p-6">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-100 mb-4">
            ¡Bienvenido a {{ config('app.name', 'Laravel') }}!
        </h1>
        <p class="text-lg text-gray-300 mb-8">
            Tu aplicación está lista para comenzar
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600 hover:border-gray-500 transition-colors">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-blue-600 rounded-lg mr-4">
                    <x-icons.lucide name="book-open" size="24" class="text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-100">Documentación</h3>
            </div>
            <p class="text-gray-300">
                Explora la documentación completa  para aprender más...
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600 hover:border-gray-500 transition-colors">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-600 rounded-lg mr-4">
                    <x-icons.lucide name="zap" size="24" class="text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-100">Rendimiento</h3>
            </div>
            <p class="text-gray-300">
                Optimiza tu aplicación con las mejores prácticas de rendimiento.
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600 hover:border-gray-500 transition-colors">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-purple-600 rounded-lg mr-4">
                    <x-icons.lucide name="settings" size="24" class="text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-100">Configuración</h3>
            </div>
            <p class="text-gray-300">
                Personaliza tu aplicación según tus necesidades específicas.
            </p>
        </div>
    </div>

    <div class="mt-8 text-center">
        <div class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <x-icons.lucide name="arrow-right" size="20" class="mr-2" />
            Comenzar
        </div>
    </div>
</div>
