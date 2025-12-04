@props([
    'buttonId' => 'buttonDropdownPeriode',
    'dropdownId' => 'dropdownPeriode'
])

@section('javascripts')
    <script type="module">
        document.addEventListener('alpine:init', () => {
            Alpine.data('periodeAkademik', () => window.periodeAkademik.listPeriodeAkademik());
        });
    </script>
@endsection

<div x-data="periodeAkademik()">
    <x-form.dropdown 
        variant="gray" 
        :buttonId="$buttonId" 
        :dropdownId="$dropdownId" 
        dropdownItem="dataPeriode"
        label="-Pilih Periode Akademik-"
        x-show="!loading"
        x-model="{{ $attributes->get('x-model') }}"
    />
</div>
