<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
</script>


<template>
<div class="mt-1">
	<SectionTitle title="Datos del participante" />

	<div class="grid px-3 pt-3 gap-5 md:px-5 md:grid-cols-12 md:gap-6">
		<div class="flex items-center md:col-span-6 lg:col-span-4">
			<el-radio-group v-model="data.hospital" class="gap-y-3">
				<el-radio label="Hospital La Paz" class="block">Hospital La Paz</el-radio>
				<el-radio label="Fundación Jiménez Díaz" class="block">Fundación Jiménez Díaz</el-radio>
			</el-radio-group>
		</div>

		<div class="md:col-span-6 lg:col-span-4">
			<div class="flex items-center gap-2 pt-1">
				<strong>Edad:</strong> 
				<el-input-number 
					v-model="data.age" 
					:min="18" 
					:max="110" />
				<span>{{ data.age === 1 ? 'año' : 'años' }}</span>
			</div>
		</div>

		<div class="md:col-span-6 lg:col-span-4">
			<div class="h-full flex items-center gap-2">
				<strong>Sexo:</strong> 
				<el-radio-group v-model="data.sex">
					<el-radio label="hombre" class="block">hombre</el-radio>
					<el-radio label="mujer" class="block">mujer</el-radio>
				</el-radio-group>
			</div>
		</div>
	</div>
</div>
</template>