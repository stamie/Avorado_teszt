<x-app-layout>
@auth
    <h1>Új Munka Létrehozása</h1>
<div class="content">
    <form action="{{ route('works.store') }}" method="POST" style="display:flex">
        @csrf
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
        
        <div class="mb-3 w-100">
            <label for="start_place" class="form-label">Kiindulásipont:</label>
            <textarea name="start_place" 
                      id="start_place" 
                      class="form-control @error('start_place') is-invalid @enderror" 
                      rows="5" 
                      required>{{ old('start_place') }}</textarea>
            @error('start_place')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3 w-100">
            <label for="end_place" class="form-label">Érkezésipont:</label>
            <textarea name="end_place" 
                      id="end_place" 
                      class="form-control @error('end_place') is-invalid @enderror" 
                      rows="5" 
                      required>{{ old('end_place') }}</textarea>
            @error('end_place')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3  w-50">
            <label for="recipient_name" class="form-label">Címzett neve:</label>
            <input type="text" 
                   name="recipient_name" 
                   id="recipient_name" 
                   class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title') }}" 
                   required>
            @error('recipient_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 w-50">
            <label for="recipient_phone" class="form-label">Címzett telefonszáma:</label>
            <input type="text" 
                   name="recipient_phone" 
                   id="recipient_phone" 
                   class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title') }}" 
                   required>
            @error('recipient_phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 w-50">
            <label for="carrier" class="form-label">Hozzárendelt Fuvaros:</label>
            <select name="carrier" 
                   id="carrier" 
                   class="form-control @error('title') is-invalid @enderror" 
                   required>
            @if (is_array($carriers) || is_object($carriers))       
                <option value="0">---</option>
                @foreach ($carriers as $carrier)
                    <option value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                @endforeach    
            @endif
            </select>
            @error('carrier')
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
