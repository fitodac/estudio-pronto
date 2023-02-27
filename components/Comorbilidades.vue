<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)

const status = ref(null)
const description = ref(null)

watch(status, val => {
	data.value.comorbidities.status = val
	
	if('No' === val){
		data.value.comorbidities.description = 'Ninguna'
	}

	if('Si' === val){
		data.value.comorbidities.description = null
	}
})


watch(description, val => {
	data.value.comorbidities.description = val
})
</script>


<template>
<div class="mt-10">
	<SectionTitle title="Comorbilidades" />

	<div class="grid px-3 pt-3 md:px-5 md:grid-cols-12 gap-6">
		
		<div class="flex items-center md:col-span-3">
			<el-radio 
				v-model="status"
				label="No" />

			<span>/ &nbsp;Ninguna</span>
		</div>


		<div class="flex items-center md:col-span-9">
			<el-radio 
				v-model="status"
				label="Sí" />

			<el-input 
				v-if="'Sí' === status"
				v-model="description" 
				placeholder="Especificar:"
				:disabled="'Sí' !== status" />
		</div>

	</div>

</div>
</template>



<style scoped>
.el-radio{
	margin-right: 10px;
}
</style>