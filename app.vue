<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

import { validateForm } from '@/composables/formValidation'
import DevelopmentComponent from '@/components/DevelopmentComponent'


const store = useStore()
const { 
	data,
	access,
	submitted
} = storeToRefs(store)

store.initResetData()


const sending = ref(false)


const submitData = async () => {

	sending.value = true

	// const url = 'http://127.0.0.1:8000/post.php' // development
	const url = 'https://estudiopronto.xyz/post.php' // production

	await fetch(url, {
		method: 'post',
		headers: new Headers({
			'Content-Type': 'application/json'
		}),
		body: JSON.stringify(data.value)
	})
	.then(resp => {
		sending.value = false

		if( 200 === resp.status ){
			store.setSubmitted(true)
		}
	})
	.catch(err => {
		console.log('error', err)
		sending.value = false
	})

}
</script>

<template>
<Header />

<Access v-if="!access" />

<div v-else class="container px-5 pb-28 mx-auto">


	<form 
		v-if="!submitted"
		@submit.prevent="submitData"
		:class="{'opacity-30 relative pointer-events-none': sending}">

		<div class="pt-10 pr-2 flex justify-end select-none">
			<small class="text-red-700 font-medium text-opacity-80">* Todos los campos son obligatorios</small>
		</div>

		<DatosDelParticipante />
		<CriteriosDeInclusion />
		<CriteriosDeExclusion />
		<Diagnostico />
		<Comorbilidades />
		<EstadoRendimientoEcog />
		<DatosAntropometricos />
		<CuestionarioPronto />
		<CriteriosGlim />
		<SuplementacionNutricionalOral />
		<RemisionAlServicioDeNutricionDelHospital />

		
		<div class="bg-white border-t border-slate-100 bottom-0 inset-x-0 fixed z-10">
			<div class="container px-5 py-3 mx-auto">
				<div class="flex justify-end items-center gap-3">

					<div class="text-slate-400 text-xs leading-none select-none">El botón de enviar se habilitará cuando haya completado todos los campos</div>
					
					<el-button 
						type="primary" 
						size="large" 
						color="#3366CC"
						round 
						:disabled="!validateForm()"
						@click="submitData">
						<span class="uppercase px-6">Enviar</span>
					</el-button>
				</div>
			</div>


			
			<!-- 
			<DevelopmentComponent />
			-->
		</div>

	</form>


	<ThankYouMessage v-else />


	<div 
		v-if="sending"
		class="flex justify-center inset-x-0 top-1/2 fixed">
		<div role="status" class="absolute">
			<svg 
				aria-hidden="true" 
				class="w-8 h-8 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
				<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
			</svg>
		</div>
	</div>

</div>
</template>
