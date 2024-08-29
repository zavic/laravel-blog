<div x-data="{ open: false, search: '', selected: @json($selected ?? []), options: @json($options) }" class="relative">
    <div class="relative w-full">
        <button x-on.click="open = !open" class="flex items-center justify-between w-full p-2 bg-white border rounded dark:bg-gray-800 dark:text-white">
            <span x-text="selected.length > 0 ? selected.join(', ') : 'Select options'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-on.click.away="open = false" class="absolute z-10 w-full mt-2 bg-white rounded shadow-lg dark:bg-gray-800">
        <input type="text" x-model="search" class="w-full p-2 border-0 dark:bg-gray-700 dark:text-white" placeholder="Search...">
        
        <ul class="p-2 overflow-y-auto max-h-48">
            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                <li x-on.click="toggle(option)" :class="{'bg-blue-500 text-white': selected.includes(option)}" class="p-2 rounded cursor-pointer hover:bg-blue-300 dark:hover:bg-gray-600">
                    <span x-text="option"></span>
                </li>
            </template>
        </ul>
    </div>

    <!-- Input hidden untuk menyimpan nilai yang dipilih -->
    <template x-for="value in selected" :key="value">
        <input type="hidden" :value="value" name="{{ $name }}[]">
    </template>
</div>

<script>
    function toggle(option) {
        if (this.selected.includes(option)) {
            this.selected = this.selected.filter(item => item !== option);
        } else {
            this.selected.push(option);
        }
    }
</script>
