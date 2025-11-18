<x-app-layout>
@auth
    <h1>Munka módosítása</h1>
<div class="content">
    <form action="{{ route('works.updatecarrier') }}" method="POST" style="display:block">
        @csrf 
        @method('PATCH')
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Hiba!</strong> Kérjük, javítsd a beviteli hibákat:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" name="id" id="id" value="{{ $work->id }}" />
        <h2>Kiindulásipont:</h2>
        <p>{{ $work->start_place }}</p>
           
        <h2>Érkezésipont:</h2>
        <p>{{ $work->end_place }}</p>
        <h2>Címzett neve:</h2>
        <p>{{ $work->recipient_name }}</p>
        <h2>Címzett telefonszáma:</h2>
        <p>{{ $work->recipient_phone }}</p>
        <?php $statusVarieble = old('status')?old('status'):(isset($work->status)?$work->status:0); ?>
        <h2>Státusz:</h2>
            <select name="status" 
                   id="status" 
                   class="form-control @error('status') is-invalid @enderror" 
                   required>
            @if (is_array($statuses) || is_object($statuses))
                @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" @selected($statusVarieble==$status->id)>{{ $status->name }}</option>
                @endforeach    
            @endif 
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Munka Mentése</button>
    </form>
</div>
@else
    <a href="{{ route('login') }}">Bejelentkezés</a>
    <a href="{{ route('register') }}">Regisztráció</a>
@endauth
</x-app-layout>
