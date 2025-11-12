<x-app-layout>
@auth

    <h1>Munkák kezelése</h1>
      
    <table>
        <th>
            <tr>
                <td>Címzett neve</td>
                <td>Indulásipont</td>
                <td>Végpont</td>
                <td>Szállító</td>
                <td>Művelet</td>
            </tr>
        </th>
        <tbody>
        @if (is_object($works) || is_array($works))
        @foreach ($works as $work)
        <tr>
            <td>{{ $work->recipient_name }}</td>
            <td>{{ $work->start_place }}</td>
            <td>{{ $work->end_place }}</td>
            <td>{{ $work->carrier }}</td>
            <td><a href="{{ route('works.edit', $work) }}">Szerkesztés</a></td>
            @if (auth()->check() && auth()->user()->hasRole('admin'))
            
                <td><a href="{{ route('works.delete', $work) }}">Törlés</a></td>
            @endif
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>

@else
    <a href="{{ route('login') }}">Bejelentkezés</a>
    <a href="{{ route('register') }}">Regisztráció</a>
@endauth

</x-app-layout>
