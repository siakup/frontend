@php
  $rowsTotal = 4;

  switch(true) {
    case !isset($roleSlot): $rowsTotal -= 1;
    case !isset($programStudiSlot): $rowsTotal -= 1;
  }

  $variantRowPosition = [
    'imageSlot' => "row-start-1 row-end-$rowsTotal",
    'nameSlot' => 'row-start-1 row-end-2',
    'roleSlot' => 'role-start-2 role-end-3',
    'programStudiSlot' => isset($roleSlot) ? 'role-start-3 role-end-4' : 'role-start-2 role-end-3'
  ];

  if(isset($footerSlot)) {
    $rowsEnd = $rowsTotal + 1;
    $variantRowPosition['footerSlot'] = "row-start-$rowsTotal row-end-$rowsEnd";
    $rowsTotal += 1;
  }
@endphp

<x-container.wrapper :rows="$rowsTotal-1" :cols="12" :padding="'p-0'">
  <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-1 {{isset($onlineSlot) ? 'col-end-3' : 'col-end-4' }} 
    {{$variantRowPosition['imageSlot']}} 
    self-center justify-self-center"
  >
    {{ $imageSlot}}
  </x-container>
  @if(isset($onlineSlot))
  <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-3 col-end-4 {{$variantRowPosition['nameSlot']}} self-center justify-self-center">
    {{ $onlineSlot }}
  </x-container>
  @endif
  <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-4 col-span-9 {{$variantRowPosition['nameSlot']}} self-center">
    {{ $nameSlot }}
  </x-container>
  @if(isset($roleSlot))
    <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-4 col-span-9 {{$variantRowPosition['roleSlot']}} self-end">
      {{ $roleSlot }}
    </x-container>
  @endif
  @if(isset($programStudiSlot))
    <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-4 col-span-9 {{$variantRowPosition['programStudiSlot']}}">
      {{ $programStudiSlot }}
    </x-container>
  @endif
  @if(isset($footerSlot))
    <x-container.container :width="'auto'" :height="'auto'" :variant="'flat'" class="col-start-1 col-span-12 {{$variantRowPosition['footerSlot']}}">
      {{ $footerSlot }}
    </x-container>
  @endif
</x-container>