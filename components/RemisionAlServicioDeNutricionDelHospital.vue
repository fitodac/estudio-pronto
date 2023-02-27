<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
</script>


<template>
<div class="mt-10">
	<SectionTitle 
		title="Remisión al servicio de nutrición del hospital" 
		subtitle="¿el paciente ha sido remitido al servicio de nutrición del hospital?" />


	<div class="px-3 pt-3 grid grid-cols-12 md:px-5 md:gap-3 md:items-center">
		<div class="col-span-6 md:col-span-1">
			<el-radio 
				v-model="data.referral_to_nutrition_service.status"
				label="Sí" />
		</div>

		<div class="col-span-6 md:col-span-1">
			<el-radio 
				v-model="data.referral_to_nutrition_service.status"
				label="No" />
		</div>

		<div 
			v-if="'No' === data.referral_to_nutrition_service.status" 
			class="col-span-12 text-sm leading-none mt-2 
							md:col-span-9 md:col-start-4 md:grid md:grid-cols-12 
							md:gap-3 md:items-center md:mt-0">
			
			<div class="select-none md:col-span-4">Especificar motivo</div>
			
			<el-input 
				v-model="data.referral_to_nutrition_service.description"
				class="mt-1 md:col-span-8 md:mt-0" />
		</div>

	</div>

</div>
</template>