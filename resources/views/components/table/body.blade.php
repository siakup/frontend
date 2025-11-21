<!-- resources/views/components/table/body.blade.php -->
<tbody {{ $attributes->merge(['class' => 'bg-white divide-y divide-gray-200']) }}>
    {{ $slot }}
</tbody>
