<x-container.container 
  :variant="'content-wrapper'"
  x-data="{{$attributes->get('x-data')}}"
  :gap="'gap-1'"
  x-bind:class="{
    'justify-end': type === 'sender',
    'justify-start': type === 'receiver'
  }"
>
  <img x-bind:src="imgProfile" class="w-8 h-8 rounded-full" />
  <x-container.container 
    :variant="'content-wrapper'"
    class="!w-1/2" 
    x-bind:class="{
    'items-end': type === 'sender',
    'items-start': type === 'receiver',
    }"
  >
    <x-container.container :variant="'flat'" class="flex gap-1 w-full">
      <x-typography :variant="'body-small-bold'" x-text="name+' - '"></x-typography>
      <x-typography :variant="'body-small-regular'" x-text="role"></x-typography>
    </x-container>
    <template x-if="type == 'sender'">
      <x-container.container :variant="'content-sender'">
        <x-typography :variant="'body-small-regular'" x-text="message"></x-typography>
      </x-container>
    </template>
    <template x-if="type == 'receiver'">
      <x-container.container :variant="'content-receiver'">
        <x-typography :variant="'body-small-regular'" x-text="message"></x-typography>
      </x-container>
    </template>
    <x-container.container :variant="'flat'" class="text-gray-600">
      <x-typography :variant="'caption-regular'" x-text="window.formatter.formatDateTime(timestamp)"></x-typography>
    </x-container>
    {{ $slot }}
  </x-container>
</x-container>