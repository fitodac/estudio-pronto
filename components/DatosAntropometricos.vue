<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)


// peso actual: weight
// peso habitual: weight_normal

// peso perdido K: weight_loss
// peso perdido %: weight_loss_percent

watch(data.value, val => {

	if(
		val.anthropometric_data.weight_normal && 
		val.anthropometric_data.weight
	){
		const op = val.anthropometric_data.weight_normal - val.anthropometric_data.weight
		val.anthropometric_data.weight_loss = op <= 0 ? 0 : op
	}

	if( 0 === val.anthropometric_data.weight_loss ){
		val.anthropometric_data.weight_loss_percent = 0
	}
	else if(
		val.anthropometric_data.weight_loss && 
		val.anthropometric_data.weight_normal
	){
		const op = (val.anthropometric_data.weight_loss / val.anthropometric_data.weight_normal)*100
		val.anthropometric_data.weight_loss_percent = op <= 0 ? 0 : op
	}

	if(
		val.anthropometric_data.weight && 
		val.anthropometric_data.tall
	){
		val.anthropometric_data.imc = val.anthropometric_data.weight / Math.pow(val.anthropometric_data.tall, 2)
	}
})
</script>


<template>
<div class="mt-10">
	<SectionTitle title="Datos antropométricos" />


	<div class="grid px-3 pt-3 gap-x-8 gap-y-3 md:px-5 md:gap-x-12 md:grid-cols-12 lg:gap-x-8">

		<div class="flex justify-between items-center gap-3 md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="select-none">Peso actual</div>
			<div class="w-40 flex items-center gap-2">
				<el-input-number 
					:precision="2" 
					:step="0.1" 
					v-model.lazy="data.anthropometric_data.weight" />

				<div>kg</div>
			</div>
		</div>


		<div class="flex justify-between items-center gap-3 md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="select-none">Talla</div>
			<div class="w-48 flex items-center gap-2">
				<el-input-number 
					:precision="2" 
					:step="0.1" 
					v-model.lazy="data.anthropometric_data.tall" />

				<div>metros</div>
			</div>
		</div>


		<div class="flex justify-between items-center gap-3 md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="select-none">IMC actual</div>
			<div class="w-32 flex items-center gap-2">
				<el-input-number 
					:precision="2" 
					:controls="false"
					readonly
					v-model="data.anthropometric_data.imc" />

				<div>kg/m<sup>2</sup></div>
			</div>
		</div>


		<div class="flex justify-between items-center gap-3 md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="select-none">Peso habitual</div>
			<div class="w-40 flex items-center gap-2">
				<el-input-number 
					:precision="2" 
					:step="0.1" 
					v-model.lazy="data.anthropometric_data.weight_normal" />

				<div>kg</div>
			</div>
		</div>


		<div class="flex justify-between items-center gap-3 md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="select-none">Peso perdido</div>
			<div class="w-28 flex items-center gap-2">
				<el-input-number 
					:precision="2" 
					:controls="false"
					readonly
					v-model="data.anthropometric_data.weight_loss" />

				<div>kg</div>
			</div>
		</div>

		<div class="bg-red-100 px-3 py-2 flex justify-between items-center gap-3 rounded-md md:col-span-6 lg:col-span-4 lg:justify-start">
			<div class="text-red-600 font-medium select-none">Peso perdido</div>
			<div class="w-28 flex items-center gap-2">
				<el-input-number
					:precision="2" 
					:controls="false"
					readonly
					v-model="data.anthropometric_data.weight_loss_percent" 
					class="input-red" />

				<div class="text-red-600 font-medium ">%</div>
			</div>
		</div> 

	</div>

</div>
</template>