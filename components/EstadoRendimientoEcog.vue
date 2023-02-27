<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
</script>


<template>
<div class="mt-10">
	<SectionTitle 
		title="Estado de rendimiento ECOG"
		subtitle="Seleccione la descripción que mejor se adecue a las características de su paciente" />

	<div class="px-3 pt-3 flex flex-col md:px-5">
		<el-radio-group v-model="data.ecog_performance_status" class="gap-y-4">
			<el-radio 
				label="Completamente activo, capaz realizar todas las actividades previas a la enfermedad, sin restricción." />
			
			<el-radio 
				label="Restringido en actividad física extrema, capaz de caminar y realizar trabajos livianos, ej., trabajo en la casa liviano, trabajo de oficina." />
			
			<el-radio 
				label="Capaz de caminar y de autocuidado, pero incapaz de realizar cualquier tipo de trabajo. Deambula más de 50% de las horas que está despierto." />
			
			<el-radio 
				label="Capaz de autocuidado limitado, se mantiene postrado o en silla más de 50% de las horas que está despierto." />

			<el-radio 
				label="Completamente incapacitado. No puede realizar autocuidado. Totalmente confinado en cama o silla." />
		</el-radio-group>
	</div>

</div>
</template>



<style scoped>
.el-radio-group{
	display: grid;
}
</style>