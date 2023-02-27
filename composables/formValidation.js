import { storeToRefs } from 'pinia'
import { useStore } from '~/store/store'

// import { FormInstance, FormRules } from 'element-plus'



const validateForm = () => {
	const store = useStore()
	const { data } = storeToRefs(store)

	// const data = computed(() => store.data)

	if(
		data.value.hospital && 
		data.value.age && 
		data.value.sex && 
		data.value.inclusion.option_1 === 'Sí' && 
		data.value.inclusion.option_2 === 'Sí' && 
		data.value.inclusion.option_3 === 'Sí' && 
		data.value.inclusion.option_4 === 'Sí' && 
		data.value.exclusion.option_1 === 'No' && 
		data.value.exclusion.option_2 === 'No' && 
		data.value.exclusion.option_3 === 'No' && 
		data.value.exclusion.option_4 === 'No' && 
		data.value.exclusion.option_5 === 'No' && 
		data.value.exclusion.option_6 === 'No' && 
		data.value.diagnosis.type.length && 
		data.value.diagnosis.condition && 
		data.value.comorbidities.status && 
		data.value.anthropometric_data.weight && 
		data.value.anthropometric_data.tall && 
		data.value.anthropometric_data.imc && 
		data.value.anthropometric_data.weight_normal && 
		data.value.anthropometric_data.weight_loss && 
		data.value.anthropometric_data.weight_loss_percent && 
		data.value.ecog_performance_status && 
		data.value.questionnaire.option_1 && 
		data.value.questionnaire.option_2 && 
		data.value.questionnaire.option_3 && 
		// data.value.glim_criteria.etiological_criteria.reduced_dietary_intake && 
		// data.value.glim_criteria.etiological_criteria.inflammation && 
		// data.value.glim_criteria.malnourished_patient &&
		data.value.oral_nutritional_supplementation.status && 
		data.value.oral_nutritional_supplementation.description && 
		(
			'Sí' === data.value.referral_to_nutrition_service.status || 
			(
				'No' === data.value.referral_to_nutrition_service.status && 
				data.value.referral_to_nutrition_service.description
			)
		)
	){
		return true
	}else{
		return false
	}
}




export {
	validateForm
}