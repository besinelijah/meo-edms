<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script>
		window.Laravel = {
			auth: {
                user: @php
                    $user = auth()->user();
                    echo $user ? json_encode($user->only('id', 'client_id', 'email', 'isAdmin','username')) : 'null';
                @endphp
            }
		};
	</script>
	<style>
		/* For Chrome, Safari, and other WebKit browsers */
::-webkit-scrollbar {
    width: 10px;  /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background of the scrollbar track */
    border-radius: 10px;  /* Rounded edges of the scrollbar track */
}

::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb (the draggable part) */
    border-radius: 10px;    /* Rounded edges of the scrollbar thumb */
    border: 2px solid #f1f1f1; /* Adds a border around the thumb */
}

::-webkit-scrollbar-thumb:hover {
    background-color: #555; /* Darker color when hovered */
}

/* For Firefox */
html {
    scrollbar-width: thin;  /* Makes scrollbar thinner */
    scrollbar-color: #888 #f1f1f1;  /* Thumb color | Track color */
}

		</style>
	@vite('resources/js/app.js')
	@vite('resources/css/app.css')

	@inertiaHead
	@routes
</head>

<body class="bg-gray-100">
	
	@inertia
</body>

</html>