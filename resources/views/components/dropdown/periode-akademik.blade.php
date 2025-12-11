<div x-data class="w-full">
    <x-form.dropdown 
        variant="gray" 
        :buttonId="'buttonPeriode'" 
        :dropdownId="'dropdownPeriode'" 
        :dropdownItem="$options"
        dropdownContainerClass="w-full"
        label="-Pilih Periode Akademik-"
        x-model="{{ $attributes->get('x-model') }}"
    />
</div>