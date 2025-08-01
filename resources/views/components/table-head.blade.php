<!-- resources/views/components/table/head.blade.php -->
<thead {{ $attributes->merge(['class' => 'bg-white']) }}>
    {{ $slot }}
</thead>
