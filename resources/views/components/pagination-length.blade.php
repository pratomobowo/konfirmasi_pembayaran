@props(['paginator'])

<div class="flex items-center space-x-2">
    <label for="per_page" class="text-sm text-gray-700">Tampilkan:</label>
    <select id="per_page" name="per_page" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
        @foreach([10, 20, 50, 100] as $perPage)
            <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                {{ $perPage }} baris
            </option>
        @endforeach
    </select>
</div> 