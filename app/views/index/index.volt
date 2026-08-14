<h1>{{title}}</h1>

<ul>

	{% for message in messages %}
		<li>{{ message }}</li>
	{% endfor %}
</ul>
