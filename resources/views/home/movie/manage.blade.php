<table class="ui very basic compact striped center aligned table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Operation</th>
		</tr>
	</thead>
	<tbody>
		@foreach($movies as $movie)
			<tr>
				<td>
					<a href="{{ route('movies.show', ['id' => $user->id, 'movie_id' => $movie->id]) }}">{{ $movie->name }}</a>
				</td>
				<td>
					<a href="{{ route('movies.edit', ['id' => $user->id, 'movie_id' => $movie->id]) }}">Edit</a>
					<span>|</span>
					<a href="{{ route('movies.edit', ['id' => $user->id, 'movie_id' => $movie->id]) }}">Delete</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>