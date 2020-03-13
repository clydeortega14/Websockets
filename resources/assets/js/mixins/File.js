export default {
	data(){
		return {
			form: {
				files: [],
				body: ''
			},
			images: []
		}
	},
	computed: {

		baseUri(){
			return window.location.origin;
		}
	},
	methods: {
		formatNames(files){

			if(files.length === 1){
				return files[0].name
			}else{
				return files.length + ' files selected'
			}
		},
		handleFileUpload(e){

			let uploadFiles = e.target.files;
			
			for(let i = 0; i < uploadFiles.length; i++){
				this.form.files.push(uploadFiles[i])

				const file = URL.createObjectURL(uploadFiles[i])
				this.images.push(file)
			}
		},
	}
}