<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
</script>


<template>
<div class="mt-10">
	<SectionTitle 
		title="Suplementación nutricional oral" 
		subtitle="¿al paciente se le indica suplementación nutricional oral?" />


	<div class="px-3 pt-3 grid grid-cols-12 md:px-5 md:gap-3 md:items-center">
		<div class="col-span-6 md:col-span-1">
			<el-radio 
				v-model="data.oral_nutritional_supplementation.status"
				label="Sí" />
		</div>

		<div class="col-span-6 md:col-span-1">
			<el-radio 
				v-model="data.oral_nutritional_supplementation.status"
				label="No" />
		</div>

		<div 
			v-if="data.oral_nutritional_supplementation.status" 
			class="col-span-12 text-sm leading-none mt-2 
							md:col-span-9 md:col-start-4 md:grid md:grid-cols-12 
							md:gap-3 md:items-center md:mt-0">
			
			<div 
				v-if="'Sí' === data.oral_nutritional_supplementation.status"
				class="select-none md:col-span-4">Especificar tipo de SNO</div>
			
			<div 
				v-if="'No' === data.oral_nutritional_supplementation.status" 
				class="select-none md:col-span-4">Especificar motivo</div>
			
			<el-input 
				v-model="data.oral_nutritional_supplementation.description"
				class="mt-1 md:col-span-8 md:mt-0" />
		</div>

	</div>

</div>
</template>