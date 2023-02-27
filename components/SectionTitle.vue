<script setup>
defineProps({
	title: String,
	subtitle: String
})
</script>


<template>
<div class="bg-primary px-5 py-3 rounded">
	<h3 class="text-white text-sm leading-none select-none">
		<span class="font-bold uppercase">{{ title }}</span>
		<span v-if="subtitle" class="text-xs font-light block lg:pl-2 lg:inline-block">{{ subtitle }}</span>
	</h3>
</div>
</template>