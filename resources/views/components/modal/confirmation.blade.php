@props([
    'id' => null,
    'show' => false,
    'title' => 'Confirm Action',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'iconUrl' => asset('assets/icons/caution/outline-black-24.svg'),
    'redirectConfirm' => null,
])

<x-modal.container x-data="{show: false}" :id="$id" x-modelable="show" x-model="{{$attributes->get('x-model')}}">
    <!-- Header -->
    <x-slot name="header" class="w-full">
      <x-container.wrapper :cols="14" :justify="'center'" :align="'center'">

        <x-container.container :background="'transparent'" class="col-start-1 col-end-15 row-start-1 row-end-2">
          <x-typography :variant="'heading-h5'" :class="'flex-1 text-center'">{{ $title }}</x-typography>
        </x-container.container>

        <x-container.container :background="'transparent'" class="col-start-14 col-end-15 row-start-1 row-end-2 justify-end">
          <x-icon :name="$iconUrl" class="w-[32px] h-[32px]" />
        </x-container.container>

      </x-container.wrapper>
    </x-slot>

    <!-- Content -->
    <div class="text-center text-sm">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="flex justify-center gap-4 w-full">
            <x-button :variant="'secondary'" :label="$cancelText" class="!w-full" x-on:click="
                $dispatch('close-modal', { id: '{{ $id }}' })
            " />
            <x-button :variant="'primary'" :label="$confirmText" class="!w-full"
                x-on:click="
                $dispatch('on-submit');
                $dispatch('close-modal', { id: '{{ $id }}' });
                " />
        </div>
    </x-slot>
</x-modal.container>
