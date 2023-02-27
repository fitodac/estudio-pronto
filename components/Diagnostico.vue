<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)


const other = ref(false)
const other_description = ref(null)

watch(other_description, (val, prev) => {
	const idx = data.value.diagnosis.type.findIndex(i => i === prev)

	if( idx < 0 ){
		data.value.diagnosis.type.push(val)
	}else{
		data.value.diagnosis.type.splice(idx, 1)
		data.value.diagnosis.type.push(val)
	}
})
</script>



<template>
<div class="mt-10">
	<SectionTitle title="Diagnóstico" />

	<div class="px-3 pt-3 md:px-5">
		<h4 class="text-primary font-bold">Tipo de cáncer</h4>

		<div class="bg-blue-100 px-7 py-7 mt-2 rounded">
			<div class="md:grid md:grid-cols-12 gap-4">
				
				<div class="flex flex-col md:col-span-6 lg:col-span-3">
					<el-checkbox-group v-model="data.diagnosis.type">
						<el-checkbox label="Cáncer de cabeza y cuello" />

						<el-checkbox label="Cáncer de cérvix" />

						<el-checkbox label="Cáncer de colon y recto" />

						<el-checkbox label="Cáncer de endometrio-útero" />

						<el-checkbox label="Cáncer de esófago" />

						<el-checkbox label="Cáncer gástrico" />
					</el-checkbox-group>
				</div>



				<div class="flex flex-col mt-4 md:col-span-6 md:mt-0 lg:col-span-3">
					<el-checkbox-group v-model="data.diagnosis.type">
						<el-checkbox label="Cáncer de hígado" />

						<el-checkbox label="Cáncer de mama" />

						<el-checkbox label="Cáncer de ovario" />

						<el-checkbox label="Cáncer de páncreas" />

						<el-checkbox label="Cáncer de próstata" />

						<el-checkbox label="Cáncer de pulmón" />
					</el-checkbox-group>
				</div>
				



				<div class="flex flex-col mt-4 md:col-span-6 md:mt-0 lg:col-span-3">
					<el-checkbox-group v-model="data.diagnosis.type">
						<el-checkbox label="Cáncer de pulmón - Mesotelioma" />

						<el-checkbox label="Cáncer de riñón" />

						<el-checkbox label="Cáncer de testículo" />

						<el-checkbox label="Cáncer de tiroides" />

						<el-checkbox label="Cáncer de vejiga" />

						<el-checkbox label="Cáncer de vía biliar" />
					</el-checkbox-group>
				</div>



				<div class="flex flex-col mt-4 md:col-span-6 md:mt-0 lg:col-span-3">
					<el-checkbox-group v-model="data.diagnosis.type">
						<el-checkbox label="Melanoma" />

						<el-checkbox label="Sarcomas óseos" />

						<el-checkbox label="Sarcomas partes blandas" />

						<el-checkbox label="Tumores cerebrales" />

						<el-checkbox label="Tumores de orígen desconocido" />
					</el-checkbox-group>

					<el-checkbox 
						v-model="other"
						label="Otro" 
						class="mt-3"/>

					<div v-if="other" class="mt-2">
						<el-input 
							v-model="other_description" 
							placeholder="Especificar:" />
					</div>
				</div>

			</div>
		</div>



		<h4 class="text-primary font-bold mt-6">Estadio</h4>

		<div class="bg-blue-100 px-7 py-7 mt-2 rounded">
			<div class="md:grid md:grid-cols-12 gap-4">

				<div class="flex flex-col gap-y-3 md:col-span-6">
					<el-radio 
						v-model="data.diagnosis.condition"
						label="Estadio 0: el cáncer está in situ o limitado a células superficiales." />

					<el-radio 
						v-model="data.diagnosis.condition"
						label="Estadio I: el cáncer está limitado a tejido de orígen." />

					<el-radio 
						v-model="data.diagnosis.condition"
						label="Estadio II: el cáncer está diseminado de forma local limitada." />
				</div>


				<div class="flex flex-col gap-y-3 pt-3 md:col-span-6">
					<el-radio 
						v-model="data.diagnosis.condition"
						label="Estadio III: el cáncer está diseminado de forma local y regional extensa." />

					<el-radio 
						v-model="data.diagnosis.condition"
						label="Estadio IV: el cáncer avanzado que está diseminado a distancia y metástasis." />
				</div>

			</div>
		</div>

	</div>
</div>
</template>


<style scoped>
.el-checkbox-group .el-checkbox{
	width: 100%;
}
</style>