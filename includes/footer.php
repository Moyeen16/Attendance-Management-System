<footer>
	<div class="container">
		<center>
			<h5>
				<marquee class="m1" behavior="scroll" loop="-1" width="30%">
					<i id="time">
							
							<strong>
								Today's date is :
								<span id="time"></span>
							</strong>
					</i>
				</marquee> 
				<script>
					var today = new Date();
					document.getElementById('time').innerHTML=today;
				</script>
			</h5>
	    </center>
	</div>
</footer>