<script setup>
import { ref, watch } from 'vue'
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
const error_message = ref(false)

watch(data.value.exclusion, options => {

	for(const i in options){
		if('Sí' === options[i] ){
			error_message.value = true
			break
		}

		error_message.value = false
	}

})
</script>


<template>
<div class="mt-10">
	<SectionTitle 
		title="Criterios de exclusión"
		subtitle="(todos los NO marcados)" />

	<div class="grid grid-cols-2 gap-y-3 px-3 pt-3 md:px-5 md:flex xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente ya ha sido diagnosticado/a y está en tratamiento contra el cáncer.</div>
		
		<el-radio 
			v-model="data.exclusion.option_1"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_1"
			label="No"
			class="md:pt-1" />
	</div>


	<div class="grid grid-cols-2 gap-y-3 px-3 pt-8 md:px-5 md:flex md:pt-4 xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente ha sido diagnosticado/a con una enfermedad neoplásica líquida.</div>
		
		<el-radio 
			v-model="data.exclusion.option_2"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_2"
			label="No"
			class="md:pt-1" />
	</div>


	<div class="grid grid-cols-2 gap-y-3 px-3 pt-8 md:px-5 md:flex md:pt-4 xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente ha recibido alguna intervención nutricional con suplementos nutricionales orales en los 3 meses anteriores.</div>
		
		<el-radio 
			v-model="data.exclusion.option_3"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_3"
			label="No"
			class="md:pt-1" />
	</div>


	<div class="grid grid-cols-2 gap-y-3 px-3 pt-8 md:px-5 md:flex md:pt-4 xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente tiene demencia avanzada conocida o cualquier otra condición psicológica grave que puede interferir con su capacidad para asistir y completar el estudio.</div>
		
		<el-radio 
			v-model="data.exclusion.option_4"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_4"
			label="No"
			class="md:pt-1" />
	</div>


	<div class="grid grid-cols-2 gap-y-3 px-3 pt-8 md:px-5 md:flex md:pt-4 xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente tiene algún trastorno alimentario conocido.</div>
		
		<el-radio 
			v-model="data.exclusion.option_5"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_5"
			label="No"
			class="md:pt-1" />
	</div>


	<div class="grid grid-cols-2 gap-y-3 px-3 pt-8 md:px-5 md:flex md:pt-4 xl:items-center">
		<div class="text-[14px] col-span-2 md:flex-1 md:order-3 md:pl-8">El/la paciente no tiene la capacidad de entender el propósito del estudio.</div>
		
		<el-radio 
			v-model="data.exclusion.option_6"
			label="Sí"
			class="md:pt-1" />

		<el-radio 
			v-model="data.exclusion.option_6"
			label="No"
			class="md:pt-1" />
	</div>


	<div 
		v-if="error_message"
		class="bg-red-100 text-red-600 text-sm leading-none px-6 py-3 mt-6 flex items-center gap-2 rounded-lg">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
			<path fill="none" d="M0 0h24v24H0z"/>
			<path 
				d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z" 
				class="fill-red-600"/>
		</svg>

		<div>Revisar criterios de exclusión</div>
	</div>

</div>
</template>