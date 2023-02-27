<script setup>
import { ref } from 'vue'
import { useStore } from '~/store/store'

const store = useStore()
const focus = ref(false)
const pass = ref(null)
const error = ref(false)

const access = () => {
	if( 'ESCALA' === pass.value ){
		store.allowAccess()
	}else{
		error.value = true
	}
}
</script>


<template>
<div class="w-screen h-full flex justify-center">

	<div class="w-72 pt-40">
		<div class="text-primary font-medium select-none">Clave de acceso</div>

		<div class="flex items-center gap-x-2 mt-3">
			<svg 
				class="w-10 h-auto transition-all"
				:class="{'fill-primary': focus, 'fill-slate-300': !focus}"
				xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path fill="none" d="M0 0h24v24H0z"/>
				<path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM5 4.604v9.185a4 4 0 0 0 1.781 3.328L12 20.597l5.219-3.48A4 4 0 0 0 19 13.79V4.604L12 3.05 5 4.604zM12 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-4.473 5a4.5 4.5 0 0 1 8.946 0H7.527z"/>
			</svg>

			<form 
				@submit.prevent="access">
				<input 
					id="login"
					type="password"
					class="bg-white border border-gray-300 leading-none w-full px-3 py-2 rounded"
					@focus="focus = true; error = false;"
					@blur="focus = false"
					v-model="pass">
				</form>
		</div>

		<div class="text-slate-400 text-xs leading-none mt-3 select-none">Ingresa la contraseña y presiona ENTER.</div>

		
		
		<div 
			v-if="error"
			class="flex items-center gap-x-2 mt-10">
			<svg 
				class="fill-red-600 w-6 h-auto" 
				xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path fill="none" d="M0 0h24v24H0z"/>
				<path d="M19 10h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 1 1 14 0v1zM5 12v8h14v-8H5zm6 2h2v4h-2v-4zm6-4V9A5 5 0 0 0 7 9v1h10z"/>
			</svg>
			<div class="text-red-600 text-sm leading-none font-medium">La clave de acceso es incorrecta.</div>
		</div>
	</div>

</div>
</template>