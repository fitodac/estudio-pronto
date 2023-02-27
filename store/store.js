import { defineStore } from 'pinia'

export const useStore = defineStore('main', {
  state: () => ({ 
		access: false,
    data: {
			hospital: null,
			age: 18,
			sex: null,
			inclusion: {
				option_1: null, // Si / No
				option_2: null, // Si / No
				option_3: null, // Si / No
				option_4: null 	// Si / No
			},
			exclusion: {
				option_1: null, // Si / No
				option_2: null, // Si / No
				option_3: null, // Si / No
				option_4: null, // Si / No
				option_5: null, // Si / No
				option_6: null 	// Si / No
			},
			diagnosis: {
				type: [],
				condition: null
			},
			comorbidities: {
				status: null, // Si / No
				description: 'Ninguna'
			},
			anthropometric_data: {
				weight: 0,
				tall: 0,
				imc: 0,
				weight_normal: 0,
				weight_loss: 0,
				weight_loss_percent: 0
				// weight: 68,
				// tall: 1.65,
				// imc: 24.98,
				// weight_normal: 80,
				// weight_loss: 12,
				// weight_loss_percent: 15
			},
			ecog_performance_status: null,
			questionnaire: {
				option_1: null, // Si / No
				option_2: null, // Si / No
				option_3: null 	// Si / No
			},
			glim_criteria: {
				phenotypic_criteria: {
					weight_loss_percent: null,
					low_imc: null,
					muscle_mass: ''
				},
				etiological_criteria: {
					reduced_dietary_intake: '',
					inflammation: '',
				},
				malnourished_patient: 'No',
				severity_of_malnutrition: null
			},
			oral_nutritional_supplementation: {
				status: null,
				description: null
			},
			referral_to_nutrition_service: {
				status: null,
				description: null
			}
		},
		reset: {},
		submitted: false
  }),
  getters: {
    // doubleCount: (state) => state.count * 2,
  },
  
	actions: {
		allowAccess(){ this.access = true },

		setSubmitted( val ){ this.submitted = val },

		initResetData(){ this.reset = JSON.parse(JSON.stringify(this.data)) },
		formReset(){ this.data = {...this.reset} }
	},
})