<div x-data class="w-full">
    <x-form.dropdown 
        variant="gray" 
        :buttonId="'buttonProgramPerkuliahan'" 
        :dropdownId="'dropdownProgramPerkuliahan'" 
        :dropdownItem="$options"
        dropdownContainerClass="w-full"
        label="-Pilih Program Perkuliahan-"
        x-model="{{ $attributes->get('x-model') }}"
    />
</div>