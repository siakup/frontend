@props([
  'variant' => '',
  'subVariants' => null
])

@php
  $variants = [
    'large' => "text-xl leading-7",
    'medium' => "text-base leading-6",
    'small' => "text-sm leading-5.5",
    'caption' => "text-xs leading-5",
    'pixie' => "text-[10px] leading-3",
    'bold' => "font-bold",
    'italic' => "italic",
  ]

  $class = "";

  if($variant !== '') {
    $class .= $variants[$variant]
  }

  if(is_array($subVariants) && !empty($subVariants)) {
    $class .= implode(" ", array_map(function ($subVariant) use($variants) {
      return $variants[$subVariant];
    }, $subVariants));
  } else if (is_string($subVariants)) {
    $class .= ' '.$variants[$subVariants];
  }
@endphp

<Text {{ $attributes->merge(['class' => $class])}}></Text>