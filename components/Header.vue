<script setup>
const date = new Date().toLocaleDateString('es-ES')

</script>


<template>
<div class="container px-5 mx-auto select-none">
	<div class="pt-6 md:flex md:justify-between md:items-center">
		<h1 class="text-2xl text-primary font-bold md:text-3xl">ESTUDIO PRONTO</h1>

		<div class="text-sm leading-none text-primary font-medium mt-2 md:m-0">Fecha: {{ date }}</div>
	</div>
</div>
</template>