<script setup>
/**
 * Este es un componente que podrá habilitarse 
 * en el desarrollo para autocompletar el 
 * formulario de manera rápida.
 */
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

import { validateForm } from '@/composables/formValidation'

const store = useStore()
const { data } = storeToRefs(store)

function fillData(){
	data.value.hospital = 'Hospital La Paz'
	data.value.age = 40
	data.value.sex = "hombre" 
	data.value.inclusion.option_1 = 'Sí'
	data.value.inclusion.option_2 = 'Sí'
	data.value.inclusion.option_3 = 'Sí'
	data.value.inclusion.option_4 = 'Sí'
	data.value.exclusion.option_1 = 'No'
	data.value.exclusion.option_2 = 'No'
	data.value.exclusion.option_3 = 'No'
	data.value.exclusion.option_4 = 'No'
	data.value.exclusion.option_5 = 'No'
	data.value.exclusion.option_6 = 'No'
	data.value.diagnosis.type = ["Cáncer de esófago", "Cáncer gástrico"]
	data.value.anthropometric_data.weight_loss = 15
	data.value.diagnosis.condition = "Estadio 0: el cáncer está in situ o limitado a células superficiales."
	data.value.comorbidities.status = "No"
	data.value.anthropometric_data.weight = 65
	data.value.anthropometric_data.tall = 1.7
	data.value.anthropometric_data.imc = 22.49134948096886
	data.value.anthropometric_data.weight_normal = 80
	data.value.anthropometric_data.weight_loss_percent = 18.75
	data.value.ecog_performance_status = "Completamente activo, capaz realizar todas las actividades previas a la enfermedad, sin restricción."
	data.value.questionnaire.option_1 = "No"
	data.value.questionnaire.option_2 = "No"
	data.value.questionnaire.option_3 = "No"
	data.value.oral_nutritional_supplementation.status = "Sí"
	data.value.oral_nutritional_supplementation.description = "Lorem ipsum" 
	data.value.referral_to_nutrition_service.status = 'Sí'
}

</script>


<template>
<div class="bg-slate-600 px-5 py-1">
	<div class="containe mx-auto">
		<div class="flex items-center gap-5">
			<div class="text-red-400 text-xs leading-none">Esta barra es solo para desarrollo</div>
			<el-button @click="fillData" size="small">Fill data</el-button>
			
			<div class="text-red-400 text-xs leading-none">{{ !validateForm() ? 'Formulario NO VALIDADO' : 'Formulario VALIDADO' }}</div>

		</div>
	</div>
</div>
</template>