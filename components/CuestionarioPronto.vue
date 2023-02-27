<script setup>
import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

const store = useStore()
const { data } = storeToRefs(store)
</script>


<template>
<div class="mt-10">
	<SectionTitle title="Cuestionario pronto" />

	<div class="px-3 pt-3 md:px-5">

		<div class="bg-blue-100 px-7 py-7 mt-2 rounded">
			<div class="grid gap-5 md:grid-cols-12 md:gap-0">

				<div class="pl-10 relative select-none md:col-span-5">
					
					<span class="bg-primary text-white text-sm leading-none text-opacity-80 w-6 h-6 flex items-center justify-center left-0 absolute rounded-full">1</span>

					<div class="text-primary text-lg font-semibold leading-tight">¿Ha perdido peso involuntariamente (5% a 10% o más) en los últimos 3-6 meses desde nuestra última consulta?</div>
					<div class="text-sm font-bold mt-2">PREGUNTAS EXPLORATORIAS:</div>
					<p>¿Cuál es su peso ideal?</p>
					<p>¿Su ropa/anillos/dentaduras postizas se ajustan de manera más holgada de lo habitual?</p>
					<p>¿Ha tenido que añadir agujeros a su cinturón?</p>
				</div>


				<div class="pl-10 pt-4 md:p-0 md:col-span-1 md:col-start-7">
					<el-radio-group 
						v-model="data.questionnaire.option_1">
						<el-radio label="Sí" />

						<el-radio label="No" />
					</el-radio-group>
				</div>

				
				<div class="pl-10 md:pl-0 md:pt-1 md:col-span-5">
					<div v-if="'Sí' === data.questionnaire.option_1">
						<div class="text-red-600 text-sm font-bold leading-none">INTERVENIR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-red-600 font-black">&middot;</span>
								<span>Intervenir según las guías ESPEN y ESMO para pacientes con cáncer y referir al experto en nutrición para cribar/evaluar y dar consejo nutricional.</span>
							</div>
						</div>
					</div>

					<div v-if="'No' === data.questionnaire.option_1">
						<div class="text-green-600 text-sm font-bold leading-none">MONITORIZAR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Pedir al paciente monitorización del peso (especialmente si han perdido peso).</span>
							</div>
							<div class="flex gap-2 mt-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Dar consejos básicos para mantener o mejorar ingesta oral: adecuar proteínas, calorías, vitaminas y minerales. Evitar restricciones dietéticas innecesarias.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





		<div class="bg-blue-100 px-7 py-7 mt-2 rounded">
			<div class="grid gap-5 md:grid-cols-12 md:gap-0">

				<div class="pl-10 relative select-none md:col-span-5">

					<span class="bg-primary text-white text-sm leading-none text-opacity-80 w-6 h-6 flex items-center justify-center left-0 absolute rounded-full">2</span>

					<div class="text-primary text-lg font-semibold leading-tight">¿Ha estado comiendo menos de lo habitual en la última semana/desde nuestra última consulta?</div>
					<div class="text-sm font-bold mt-2">PREGUNTAS EXPLORATORIAS:</div>
					<p>¿Tiene algún síntoma que esté afectando su capacidad para comer y beber? Por ejemplo: dolor de boca, náuseas, vómitos o cambios de sabor.</p>
				</div>


				<div class="pl-10 pt-4 md:p-0 md:col-span-1 md:col-start-7">
					<el-radio-group 
						v-model="data.questionnaire.option_2">
						<el-radio label="Sí" />

						<el-radio label="No" />
					</el-radio-group>
				</div>

				
				<div class="pl-10 md:pl-0 md:pt-1 md:col-span-5">
					<div v-if="'Sí' === data.questionnaire.option_2">
						<div class="text-red-600 text-sm font-bold leading-none">INTERVENIR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-red-600 font-black">&middot;</span>
								<span>Intervenir según las guías ESPEN y ESMO para pacientes con cáncer y referir al experto en nutrición para cribar/evaluar y dar consejo nutricional.</span>
							</div>
						</div>
					</div>

					<div v-if="'No' === data.questionnaire.option_2">
						<div class="text-green-600 text-sm font-bold leading-none">MONITORIZAR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Pedir al paciente monitorización de la ingesta de alimentos (especialmente si han perdido peso).</span>
							</div>
							<div class="flex gap-2 mt-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Dar consejos básicos para mantener o mejorar ingesta oral: adecuar proteínas, calorías, vitaminas y minerales. Evitar restricciones dietéticas innecesarias.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





		<div class="bg-blue-100 px-7 py-7 mt-2 rounded">
			<div class="grid gap-5 md:grid-cols-12 md:gap-0">

				<div class="pl-10 relative select-none md:col-span-5">

					<span class="bg-primary text-white text-sm leading-none text-opacity-80 w-6 h-6 flex items-center justify-center left-0 absolute rounded-full">3</span>

					<div class="text-primary text-lg font-semibold leading-tight">¿Ha perdido fuerza o se siente más débil que lo usual desde nuestra última consulta?</div>
					<div class="text-sm font-bold mt-2">PREGUNTAS EXPLORATORIAS:</div>
					<p>¿Ha notado cambios en su capacidad de llevar a cabo actividades de la vida diaria? Por ejemplo: abrir botellas, levantarse de una silla, subir escaleras o llevar objetos pesados.</p>
					<p>¿Se siente cansado? ¿Siente a sus músculos más débiles?</p>
				</div>


				<div class="pl-10 pt-4 md:p-0 md:col-span-1 md:col-start-7">
					<el-radio-group 
						v-model="data.questionnaire.option_3">
						<el-radio label="Sí" />

						<el-radio label="No" />
					</el-radio-group>
				</div>

				
				<div class="pl-10 md:pl-0 md:pt-1 md:col-span-5">
					<div v-if="'Sí' === data.questionnaire.option_3">
						<div class="text-red-600 text-sm font-bold leading-none">INTERVENIR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-red-600 font-black">&middot;</span>
								<span>Intervención nutricional y asesoramiento en actividad física regular y referir al experto en nutrición para cribar/evaluar y dar consejo nutricional.</span>
							</div>
						</div>
					</div>

					<div v-if="'No' === data.questionnaire.option_3">
						<div class="text-green-600 text-sm font-bold leading-none">MONITORIZAR</div>
						<div class="text-sm leading-tight mt-1">
							<div class="flex gap-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Pedir al paciente monitorización de la fuerza y nivel de movilidad.</span>
							</div>
							<div class="flex gap-2 mt-2">
								<span class="text-green-600 font-black">&middot;</span>
								<span>Animar al paciente para que sea tan activo como pueda, por ejemplo, que de un paseo diario.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
</template>



<style lang="scss" scoped>
.el-radio-group{
	@media(min-width: 768px){
		@apply flex-col items-start gap-y-6;
	}
}


p{
	@apply text-sm leading-tight;
}

p + p{
	@apply mt-1;
}
</style>