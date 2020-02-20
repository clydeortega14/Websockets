export default {

	methods: {

		dateSlashedFormat(date){
			
			let objDate = date ? moment(date) : moment()

			return objDate.format('MM/DD/YYYY')
		},
		relativeDate(date){
			return date ? moment(date).fromNow() : moment() 
		},
		fullDate(date){
			return date ? moment(date).format('LL') : moment()
		}
	}
}