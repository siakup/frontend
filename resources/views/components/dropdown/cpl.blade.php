<div x-data class="w-full">
    <x-form.dropdown 
        variant="gray" 
        :buttonId="'buttonCpl'" 
        :dropdownId="'dropdownCpl'" 
        :dropdownItem="$options"
        dropdownContainerClass="w-full"
        label="-Pilih CPL-"
        x-model="{{ $attributes->get('x-model') }}"
    />
</div>