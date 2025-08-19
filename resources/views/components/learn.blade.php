<!-- Component -->

<div class="" x-data="{ open: false }">

    <button @click="open = !open">Toggle</button>

    <button @click="$dispatch('button-clicked')" x-show="open">Click</button>
</div>
