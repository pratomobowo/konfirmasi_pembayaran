<div class="bg-white shadow-sm mb-6">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold leading-tight text-gray-900">
                    {{ $title }}
                </h1>
                @if(isset($description))
                <p class="mt-1 text-sm text-gray-600 max-w-4xl">
                    {{ $description }}
                </p>
                @endif
            </div>
            @if(isset($actions))
            <div class="mt-4 flex md:mt-0 md:ml-4">
                {{ $actions }}
            </div>
            @endif
        </div>
    </div>
</div> 