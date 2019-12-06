@extends('layouts.app')

@section('content')

<div id="chat-box">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-offset-2">
				<div class="card">
					<div class="card-header">Chats</div>

					<div class="card-body">
						<ul class="chat">
							<li class="left clearfix" v-for="message in messages">
								<div class="chat-body clearfix">
									<div class="header">
										<div v-if="user.id === message.user_id">
											<strong class="text-success">
												@{{ message.user.name }}
											</strong>
										</div>

										<div v-else>
											<strong class="text-danger">
												@{{ message.user.name }}
											</strong>
										</div>
										
									</div>

									<p>@{{ message.message }}</p>
								</div>
							</li>

						</ul>
					</div>

					<div class="card-footer">
						<div class="input-group mb-3">
							<input type="text" name="message" class="form-control" placeholder="Type your message here ..." v-model="newMessage" aria-label="Recipient's username" aria-describedby="basic-addon2">
							<div class="input-group-append">
						    	<button class="btn btn-success" type="button" @click.prevent="sendMessage">Send</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('custom_js')
<script>
	

	const chatBox = new Vue({

		el: '#chat-box',
		data(){

			return {

				messages : {},
				newMessage : '',
				user : {!! auth()->check() ? auth()->user()->toJson() : 'null' !!}
			}
		},
		mounted(){

			this.getMessages()
			this.listen()
		},
		methods : {

			getMessages(){

				axios.get(`/api/get-message/`, {

					headers : {

						'Authorization' : 'Bearer '+this.user.api_token,
                        'Content-Type' : 'application/json'
					}
				}).then( response => {

					this.messages = response.data

				}).catch(error => {

					console.log(error)
				})
			},
			sendMessage(){

				axios.post(`/api/send-message`, {

					message : this.newMessage
				}, {

					headers : {

						'Authorization' : 'Bearer '+this.user.api_token,
                        'Content-Type' : 'application/json'
					}
				}).then(res => {
					
					this.messages.push(res.data)
					this.newMessage = ''

				}).catch(error => {

					console.log(error)
				})
			},
			listen(){

				Echo.private('chat-room')
					.listen('SendMessage', (e) => {
						this.messages.push(e.message)
					})
			}
		}


	})
</script>

@endsection