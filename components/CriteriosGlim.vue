<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)

const diable_checkboxes = ref(false)

watch(data.value, val => {
	if( val.anthropometric_data.weight > val.anthropometric_data.weight_normal ){
		val.glim_criteria.phenotypic_criteria.weight_loss_percent = null
		val.glim_criteria.phenotypic_criteria.low_imc = null
		val.glim_criteria.phenotypic_criteria.muscle_mass = ''
		val.glim_criteria.etiological_criteria.reduced_dietary_intake = ''
		val.glim_criteria.etiological_criteria.inflammation = ''
		val.glim_criteria.malnourished_patient = 'No'
		val.glim_criteria.severity_of_malnutrition = null

		diable_checkboxes.value = true
	}

	else if( val.anthropometric_data.weight && val.anthropometric_data.tall && val.anthropometric_data.weight_normal){

		// Pérdida de peso en %
		if( val.anthropometric_data.weight_loss_percent <= 10 && val.anthropometric_data.weight_loss_percent > 5 ){
			val.glim_criteria.phenotypic_criteria.weight_loss_percent = "5-10% en los últimos 6 meses"
		}

		if( val.anthropometric_data.weight_loss_percent == 10 ){
			val.glim_criteria.phenotypic_criteria.weight_loss_percent = "10% en 6 meses"
		}

		if( val.anthropometric_data.weight_loss_percent > 10 && val.anthropometric_data.weight_loss_percent < 20 ){
			val.glim_criteria.phenotypic_criteria.weight_loss_percent = "10-20% más de 6 meses"
		}

		if( val.anthropometric_data.weight_loss_percent >= 20 ){
			val.glim_criteria.phenotypic_criteria.weight_loss_percent = "20% en más de 6 meses"
		}


		// Bajo IMC
		if( val.anthropometric_data.imc < 22 ){
			if( val.anthropometric_data.imc < 20 ){
				
				if( val.anthropometric_data.imc < 18.5 ){
					if( val.age < 70 ){
						val.glim_criteria.phenotypic_criteria.low_imc = "< 18,5 en < 70 años"
					}
				}else{
					if( val.age < 70 ){
						val.glim_criteria.phenotypic_criteria.low_imc = "< 20 en < 70 años"
					}

					if( val.age >= 70 ){
						val.glim_criteria.phenotypic_criteria.low_imc = "< 20 en > 70 años"
					}
				}

			}else{
				if( val.age > 70 ) val.glim_criteria.phenotypic_criteria.low_imc = "< 22 en > 70 años"
			}
		}


		
		if( 
			val.glim_criteria.phenotypic_criteria.weight_loss_percent || 
			val.glim_criteria.phenotypic_criteria.low_imc || 
			val.glim_criteria.phenotypic_criteria.muscle_mass 
		){
			if(
				val.glim_criteria.etiological_criteria.reduced_dietary_intake.length || 
				val.glim_criteria.etiological_criteria.inflammation.length 
			){
				val.glim_criteria.malnourished_patient = 'Sí'
			}else{
				val.glim_criteria.malnourished_patient = 'No'
			}
		}

		
		if( "Déficit severo" === val.glim_criteria.phenotypic_criteria.muscle_mass ){
			val.glim_criteria.severity_of_malnutrition = "Severa"
			return
		}

		if( 
			"10% en 6 meses" === val.glim_criteria.phenotypic_criteria.weight_loss_percent || 
			"20% en más de 6 meses" === val.glim_criteria.phenotypic_criteria.weight_loss_percent
		){
			val.glim_criteria.severity_of_malnutrition = "Severa"
			return
		}

		if(
			"< 18,5 en < 70 años" === val.glim_criteria.phenotypic_criteria.low_imc || 
			"< 20 en > 70 años" === val.glim_criteria.phenotypic_criteria.low_imc
		){
			val.glim_criteria.severity_of_malnutrition = "Severa"
			return
		}
		

		if( "Déficit leve a moderado" === val.glim_criteria.phenotypic_criteria.muscle_mass ){
			val.glim_criteria.severity_of_malnutrition = "Moderada"
			return
		}

		if(
			"5-10% en los últimos 6 meses" === val.glim_criteria.phenotypic_criteria.weight_loss_percent || 
			"10-20% más de 6 meses" === val.glim_criteria.phenotypic_criteria.weight_loss_percent
		){
			val.glim_criteria.severity_of_malnutrition = "Moderada"
			return
		}

		if(
			"< 20 en < 70 años" === val.glim_criteria.phenotypic_criteria.low_imc || 
			"< 22 en > 70 años" === val.glim_criteria.phenotypic_criteria.low_imc
		){
			val.glim_criteria.severity_of_malnutrition = "Moderada"
			return
		}

		diable_checkboxes.value = false
		
	}

})


const muscle_mass = ref('')

watch(muscle_mass, val => {

})

const uncheckAll = () => {
	muscle_mass.value = false
	document.getElementById('muscleMassOption1').checked = false
	document.getElementById('muscleMassOption2').checked = false
}
</script>


<template>
<div class="mt-10">
	<SectionTitle title="Criterios GLIM" />

	<div class="px-3 pt-3 md:px-5">
		<h3 class="text-primary font-bold uppercase leading-tight">Diagnóstico de desnutrición = presencia de mínimo 1 criterio fenotípico + 1 criterio etiológico</h3>


		<div 
			class="bg-primary text-white font-bold leading-none 
								px-5 py-2 mt-6 rounded select-none">
			A. CRITERIO FENOTÍPICO
		</div>

		<div class="md:grid md:grid-cols-11 md:mt-4">
			<div class="hidden md:block md:col-span-2"></div>
			<div class="bg-slate-200 text-slate-500 text-xs font-bold leading-none p-2 rounded-tl select-none hidden md:block md:col-span-3">Pérdida de peso (%)</div>
			<div class="bg-slate-200 text-slate-500 text-xs font-bold leading-none p-2 select-none hidden md:block md:col-span-3">Bajo IMC (kg/m<sup>2</sup>)</div>
			<div class="bg-slate-200 text-slate-500 text-xs font-bold leading-none p-2 rounded-tr select-none hidden md:block md:col-span-3">Masa muscular reducida</div>


			<div 
				class="text-slate-500 text-sm font-bold leading-none select-none p-2 
								md:col-span-2 md:bg-slate-200 md:rounded-l 
								md:flex md:items-center">Desnutrición moderada</div>

			<div class="bg-slate-200 text-slate-500 text-sm font-bold leading-none p-2 rounded-t select-none md:hidden">Pérdida de peso (%)</div>

			<div class="border border-slate-100 p-2 md:col-span-3">
				<el-radio-group 
					v-model="data.glim_criteria.phenotypic_criteria.weight_loss_percent" 
					class="md:gap-y-4">
					<el-radio 
						label="5-10% en los últimos 6 meses"
						disabled />

					<el-radio 
						label="10-20% más de 6 meses" 
						disabled />
				</el-radio-group>
			</div>
			
			<div class="bg-slate-200 text-slate-500 text-sm font-bold leading-none p-2 select-none md:hidden">Bajo IMC (kg/m<sup>2</sup>)</div>

			<div class="border border-slate-100 p-2 md:col-span-3">
				<el-radio-group 
					v-model="data.glim_criteria.phenotypic_criteria.low_imc" 
					class="flex-col md:gap-y-4">
					<el-radio 
						label="< 20 en < 70 años" 
						disabled />

					<el-radio 
						label="< 22 en > 70 años" 
						disabled />
				</el-radio-group>
			</div>
			
			<div class="bg-slate-100 text-slate-500 text-sm font-bold leading-none p-2 select-none md:hidden">Masa muscular reducida</div>

			<div class="border border-slate-100 p-2 rounded-b md:col-span-3 md:rounded-l-none md:rounded-rb">
				<el-checkbox 
					id="muscleMassOption1"
					v-model="data.glim_criteria.phenotypic_criteria.muscle_mass"
					label="Déficit leve a moderado"
					true-label="Déficit leve a moderado"
					false-label="" 
					:disabled="diable_checkboxes" />
			</div>
		</div>



		<div class="mt-5 md:grid md:grid-cols-11">
			
			<div 
				class="text-slate-500 text-sm font-bold leading-none select-none p-2 
								md:col-span-2 md:bg-slate-200 md:rounded-l 
								md:flex md:items-center">Desnutrición severa</div>

			<div class="bg-slate-200 text-slate-500 text-sm font-bold leading-none p-2 rounded-t select-none md:hidden">Pérdida de peso (%)</div>

			<div class="border border-slate-100 p-2 md:col-span-3">
				<el-radio-group 
					v-model="data.glim_criteria.phenotypic_criteria.weight_loss_percent" 
					class="flex-col md:gap-y-4">
					<el-radio 
						label="10% en 6 meses" 
						disabled />

					<el-radio 
						label="20% en más de 6 meses" 
						disabled />
				</el-radio-group>
			</div>
			
			<div class="bg-slate-200 text-slate-500 text-sm font-bold leading-none p-2 select-none md:hidden">Bajo IMC (kg/m<sup>2</sup>)</div>

			<div class="border border-slate-100 p-2 md:col-span-3">
				<el-radio-group 
					v-model="data.glim_criteria.phenotypic_criteria.low_imc" 
					class="flex-col md:gap-y-4">
					<el-radio 
						label="< 18,5 en < 70 años" 
						disabled />

					<el-radio 
						label="< 20 en > 70 años" 
						disabled />
				</el-radio-group>
			</div>
			
			<div class="bg-slate-100 text-slate-500 text-sm font-bold leading-none p-2 select-none md:hidden">Masa muscular reducida</div>

			<div class="border border-slate-100 p-2 rounded-b md:col-span-3 md:rounded-r md:rounded-l-none">
				<el-checkbox 
					id="muscleMassOption2"
					v-model="data.glim_criteria.phenotypic_criteria.muscle_mass"
					label="Déficit severo"
					true-label="Déficit severo" 
					false-label=""
					:disabled="diable_checkboxes" />
			</div>
		</div>





		<div 
			class="bg-primary text-white font-bold leading-none 
								px-5 py-2 mt-6 rounded select-none md:mt-8">
			B. CRITERIO ETIOLÓGICO
		</div>

		<div class="mt-4 md:grid md:grid-cols-2">
			<div 
				class="text-slate-500 text-sm font-bold leading-none select-none p-2 
							md:bg-slate-200 md:rounded-tl md:flex md:items-center">Reducción de la ingesta o asimilación de alimentos</div>

			<div 
				class="text-slate-500 text-sm font-bold leading-none select-none p-2 hidden
							md:bg-slate-200 md:block md:rounded-tr md:flex md:items-center">Inflamación</div>

			<div class="border border-slate-100 p-2 rounded md:rounded-none md:rounded-bl">
				<el-checkbox 
					v-model="data.glim_criteria.etiological_criteria.reduced_dietary_intake"
					label="< 50% de las necesidades energéticas > 1 semana" 
					true-label="< 50% de las necesidades energéticas > 1 semana" 
					false-label=""
					:disabled="diable_checkboxes" />

				<el-checkbox 
					v-model="data.glim_criteria.etiological_criteria.reduced_dietary_intake"
					label="Cualquier reducción durante > 2 semanas" 
					true-label="Cualquier reducción durante > 2 semanas" 
					false-label=""
					:disabled="diable_checkboxes" />

				<el-checkbox 
					v-model="data.glim_criteria.etiological_criteria.reduced_dietary_intake"
					label="Cualquier condición GI crónica que tenga impacto adverso en la asimilación o absorción de alimentos" 
					true-label="Cualquier condición GI crónica que tenga impacto adverso en la asimilación o absorción de alimentos" 
					false-label=""
					:disabled="diable_checkboxes" />
			</div>

			<div 
				class="text-sm font-bold leading-none select-none p-2 mt-2 md:hidden">Inflamación</div>

			<div class="border border-slate-100 p-2 rounded md:rounded-none md:rounded-br">
				<div class="flex gap-y-2 md:flex-col">
					<div>
						<el-checkbox 
							v-model="data.glim_criteria.etiological_criteria.inflammation"
							label="Relacionada a enfermedad/lesión aguda" 
							true-label="Relacionada a enfermedad/lesión aguda"
							false-label=""
							:disabled="diable_checkboxes" />
					</div>

					<div>
						<el-checkbox 
							v-model="data.glim_criteria.etiological_criteria.inflammation"
							label="Relacionada a enfermedad/lesión crónica" 
							true-label="Relacionada a enfermedad/lesión crónica"
							false-label=""
							:disabled="diable_checkboxes" />
					</div>
				</div>
			</div>

		</div>



		<div class="mt-8">
			<div class="text-sm font-medium">Paciente desnutrido mediante los criterios GLIM:</div>

			<div class="grid grid-cols-12 mt-2">
				<div class="col-span-6 sm:col-span-2">
					<el-radio 
						v-model="data.glim_criteria.malnourished_patient"
						label="No" 
						disabled />
				</div>

				<div class="col-span-6 sm:col-span-2">
					<el-radio 
						v-model="data.glim_criteria.malnourished_patient"
						label="Sí" 
						disabled />
				</div>

				<div 
					v-if="'Sí' === data.glim_criteria.malnourished_patient"
					class="col-span-12 mt-2 grid grid-cols-12 items-center sm:col-span-8 sm:mt-0">
					
					<div class="text-sm col-span-12 sm:col-span-6">Gravedad de la desnutrición</div>

					<div class="col-span-6 sm:col-span-3">
						<el-radio 
							v-model="data.glim_criteria.severity_of_malnutrition"
							label="Moderada" 
							disabled />
					</div>

					<div class="col-span-6 sm:col-span-3">
						<el-radio 
							v-model="data.glim_criteria.severity_of_malnutrition"
							label="Severa" 
							disabled />
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
</template>




<style scoped>
.el-radio.is-disabled :deep(.el-radio__input.is-disabled .el-radio__inner){
	background-color: var(--el-radio-input-bg-color);
	cursor: default;
}

.el-radio.is-disabled :deep(.el-radio__input.is-disabled.is-checked .el-radio__inner){
	background-color: var(--el-color-primary);
	border-color: var(--el-color-primary);
	cursor: default;
}

.el-radio.is-disabled :deep(.el-radio__input.is-disabled.is-checked .el-radio__inner::after){
	background-color: #FFF;
}

.el-radio.is-disabled :deep(.el-radio__label){
	color: var(--el-text-color-regular);
	cursor: default;
}

.el-radio-group.md\:flex-col{
	align-items: start;
}

.el-radio-group.flex-col{
	@apply items-start gap-y-3;
}
</style>