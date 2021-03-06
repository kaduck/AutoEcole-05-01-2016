﻿{# templates/layout.twig #}
<!DOCTYPE html>
<html>
<head>
	<title>Cas-M-Ping - {% block title %}{% endblock %} </title>
	<meta charset="iso-8859-1">
	{% block stylesheets %}
		<link rel="stylesheet" href="{{bootstrapPath}}">
		<link rel="stylesheet" href="/AutoEcole-05-01-2016/dependencies/styles/layout.css">
		<link rel="stylesheet" href="/AutoEcole-05-01-2016/dependencies/styles/jqueryUI.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	{% endblock %}
</head>
<body>
	<div class="wrapper row1">
	  <header id="header" class="clear">
		<div id="hgroup">
		  <h1><a href="/AutoEcole-05-01-2016/lecons/show/all">Le bon conducteur</a></h1>
		  <h2>Auto école Ruténoise</h2>
		</div>
		<nav>
		  <ul>
			<li><a href="/AutoEcole-05-01-2016/students/show/all">Eleves</a></li>
			<li><a href="/AutoEcole-05-01-2016/instructors/show/all">Moniteurs</a></li>
			<li><a href="/AutoEcole-05-01-2016/lecons/show/all">Leçons de conduites</a></li>
			<li><a href="/AutoEcole-05-01-2016/vehicles/show/all">Véhicules</a></li>
			<li><a href="/AutoEcole-05-01-2016/billings/show/all">Factures</a></li>
			<li><a href="/AutoEcole-05-01-2016/exams/show/all">Examens</a></li>
		  </ul>
		</nav>
	  </header>
	</div>
	<!-- content -->
	<div class="wrapper row2">
		<div id="container">
	  
			<section>
				<img src="/AutoEcole-05-01-2016/dependencies/images/campingRodez.jpg" alt="">
			</section>
		
		</div>
		<section>
			<h2>{% block header %}{% endblock %}</h2>
		</section>
		{% block content %}{% endblock %}
	</div>
</body>
<script type="text/javascript">
	$('#beginDate').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		maxDate: $('#endDate').datepicker('getDate'),
		 onSelect: function(date) {
			$('#beginDate').datepicker('option','minDate', date);
			$('#endDate').datepicker('option','minDate');
		}
	});
	$('#endDate').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		minDate: $('#beginDate').datepicker('getDate'),
		onSelect: function(date) {
			$('#endDate').datepicker('option','minDate', date);
			$('#beginDate').datepicker('option','minDate');
		}
	});
	$.datepicker.setDefaults($.datepicker.regional['fr']);
</script>
</html>
