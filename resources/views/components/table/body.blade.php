<!-- resources/views/components/table/body.blade.php -->
<tbody {{ $attributes->merge(['class' => 'divide-y divide-gray-200']) }}>
    {{ $slot }}
</tbody>
