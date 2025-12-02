@extends('layouts.main')

@section('title', 'Table Documentation')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')
{{-- penjelasan parameter --}}

{{-- isRounderedTop = true: radius di sisi atas --}}
{{-- isRounderedBottom = true: radius di sisi atas --}}

<x-container.container :variant="'content-wrapper'" class="!pb-10">
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-medium-bold'">Button without icons ></x-typography>
    <x-container.container :variant="'content-wrapper'" class="!flex-row gap-2">
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Primary</x-typography>
        <x-container.container :variant="'content-wrapper'" class="!w-max">
          <x-typography :variant="'caption-bold'">Small</x-typography>
          <x-button :size="'sm'">Button Small Primary</x-button>
          <x-button :size="'sm'" disabled>Button Small Primary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Medium</x-typography>
          <x-button :size="'md'">Button Medium Primary</x-button>
          <x-button :size="'md'" disabled>Button Medium Primary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Large</x-typography>
          <x-button :size="'lg'">Button Large Primary</x-button>
          <x-button :size="'lg'" disabled>Button Large Primary Disabled</x-button>
        </x-container>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Secondary</x-typography>
        <x-container.container :variant="'content-wrapper'" class="!w-max">
          <x-typography :variant="'caption-bold'">Small</x-typography>
          <x-button :variant="'secondary'" :size="'sm'">Button Small Secondary</x-button>
          <x-button :variant="'secondary'" :size="'sm'" disabled>Button Small Secondary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Medium</x-typography>
          <x-button :variant="'secondary'" :size="'md'">Button Medium Secondary</x-button>
          <x-button :variant="'secondary'" :size="'md'" disabled>Button Medium Secondary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Large</x-typography>
          <x-button :variant="'secondary'" :size="'lg'">Button Large Secondary</x-button>
          <x-button :variant="'secondary'" :size="'lg'" disabled>Button Large Secondary Disabled</x-button>
        </x-container>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Tertiary</x-typography>
        <x-container.container :variant="'content-wrapper'" class="!w-max">
          <x-typography :variant="'caption-bold'">Small</x-typography>
          <x-button :variant="'tertiary'" :size="'sm'">Button Small Tertiary</x-button>
          <x-button :variant="'tertiary'" :size="'sm'" disabled>Button Small Tertiary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Medium</x-typography>
          <x-button :variant="'tertiary'" :size="'md'">Button Medium Tertiary</x-button>
          <x-button :variant="'tertiary'" :size="'md'" disabled>Button Medium Tertiary Disabled</x-button>
          <x-typography :variant="'caption-bold'">Large</x-typography>
          <x-button :variant="'tertiary'" :size="'lg'">Button Large Tertiary</x-button>
          <x-button :variant="'tertiary'" :size="'lg'" disabled>Button Large Tertiary Disabled</x-button>
        </x-container>
      </x-container>
    </x-container>
  </x-container>
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-medium-bold'">Button with icons ></x-typography>
    <x-container.container :variant="'content-wrapper'" class="!flex-row gap-2">
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Primary</x-typography>
        <x-button :size="'sm'" :icon="'arrow-back/black-12'">Button Small Primary Icon Left</x-button>
        <x-button :size="'sm'" :icon="'arrow-back/black-12'" disabled>Button Small Primary Icon Left</x-button>
        <x-button :size="'sm'" :icon="'arrow-right/black-12'" :iconPosition="'right'">Button Small Primary Icon Right</x-button>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Secondary</x-typography>
        <x-button :size="'sm'" :variant="'secondary'" :icon="'arrow-back/red-12'">Button Small Secondary Icon Left</x-button>
        <x-button :size="'sm'" :variant="'secondary'" :icon="'arrow-back/red-12'" disabled>Button Small Secondary Icon Left</x-button>
        <x-button :size="'sm'" :variant="'secondary'" :icon="'arrow-right/red-12'" :iconPosition="'right'">Button Small Secondary Icon Right</x-button>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Tertiary</x-typography>
        <x-button :size="'sm'" :variant="'tertiary'" :icon="'arrow-back/red-12'">Button Small Tertiary Icon Left</x-button>
        <x-button :size="'sm'" :variant="'tertiary'" :icon="'arrow-back/red-12'" disabled>Button Small Tertiary Icon Left</x-button>
        <x-button :size="'sm'" :variant="'tertiary'" :icon="'arrow-right/red-12'" :iconPosition="'right'">Button Small Tertiary Icon Right</x-button>
      </x-container>
    </x-container>
  </x-container>
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-medium-bold'">Button Only icons ></x-typography>
    <x-container.container :variant="'content-wrapper'" class="!flex-row gap-2">
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Primary</x-typography>
        <x-button :size="'sm'" :icon="'arrow-back/black-12'"></x-button>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Secondary</x-typography>
        <x-button :size="'sm'" :variant="'secondary'" :icon="'arrow-back/red-12'"></x-button>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="gap-2 !w-max !px-0">
        <x-typography :variant="'body-small-bold'">Button Tertiary</x-typography>
        <x-button :size="'sm'" :variant="'tertiary'" :icon="'arrow-back/red-12'"></x-button>
      </x-container>
    </x-container>
  </x-container>
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-medium-bold'">Text Link</x-typography>
    <x-button :size="'sm'" :variant="'text-link'" :icon="'arrow-back/red-12'">Back</x-button>
    <x-button :size="'md'" :variant="'text-link'" :icon="'arrow-back/red-12'">Back</x-button>
    <x-button :size="'lg'" :variant="'text-link'" :icon="'arrow-back/red-12'">Back</x-button>
    <x-button :size="'lg'" :variant="'text-link'" :icon="'arrow-back/red-12'" disabled>Back</x-button>
    <x-button :size="'sm'" :variant="'text-link'" :icon="'arrow-back/red-12'"></x-button>
  </x-container>
</x-container>


@endsection
