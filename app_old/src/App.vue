<template>
  <div id="app">
    <nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				  	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
				  	</button>
				  	<a class="navbar-brand" href="#">VUE HARD</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><router-link to="/shifts">Shifts</router-link></li>
						<li><router-link to="/subjects">Subjects</router-link></li>
						<li><router-link to="/students">Students</router-link></li>
					</ul>
				</div>
			</div>
		</nav>
    <router-view/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawsome.css">
    <script type="text/javascript" src="assets/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="assets/js/meiomask.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
  </div>
</template>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
