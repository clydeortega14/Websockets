export default {

	methods: {

		dateSlashedFormat(date){
			
			let objDate = date ? moment(date) : moment()

			return objDate.format('MM/DD/YYYY')
		}
	}
}