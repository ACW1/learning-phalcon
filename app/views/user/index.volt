<h1>User</h1>

{% if single %}

	{{ single.id }}
	{{ single.email }}

	<hr />

	{% set first=single.project.getFirst().toArray() %}
	{{ first['id'] }}

{% endif %}

    <hr />

	<?php foreach($single->project as $p): ?>
	  <?=$p->id?>
	  <?=$p->title?>
	<?php endforeach;?>

<hr />

<h1>All Users</h1>
{% for key, user in all %}
	{{ key }}
	{{ user.id }}
	{{ user.email }}
	<br />
{% endfor %}
