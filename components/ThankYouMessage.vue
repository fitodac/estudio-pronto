<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'


const store = useStore()
const { submitted } = storeToRefs(store)

const reset = () => {
	store.formReset()
	store.setSubmitted(false)
}
</script>



<template>
<div class="flex justify-center px-5 py-48 select-none">
	<div class="text-center">
		
		<svg 
			viewBox="0 0 1024 1024" 
			xmlns="http://www.w3.org/2000/svg" 
			data-v-029747aa=""
			class="w-28 h-28 inline-block">
			<path fill="var(--color-primary)" d="M406.656 706.944 195.84 496.256a32 32 0 1 0-45.248 45.248l256 256 512-512a32 32 0 0 0-45.248-45.248L406.592 706.944z"></path>
		</svg>

		<div class="text-primary text-2xl font-medium leading-none">Gracias por completar este formulario</div>

		<div class="mt-12 grid items-center gap-5 md:flex">
			<div class="text-primary">¿Quieres completar un nuevo formulario?</div>

			<button 
				type="button" 
				@click="reset"
				class="bg-primary text-white text-sm leading-none font-medium 
									px-8 py-3 rounded transition-all hover:opacity-80">
				Si
			</button>
		</div>
	</div>
</div>
</template>