<x-app-layout>
@auth
    <h1>Munka módosítása</h1>
<div class="content">
    <form action="{{ route('works.update') }}" method="POST" style="display:flex">
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
        <input type="hidden" name="id" id="id" value="{{ $work->id }}" />
        <div class="mb-3 w-100">
            <label for="start_place" class="form-label">Kiindulásipont:</label>
            <textarea name="start_place" 
                      id="start_place" 
                      class="form-control @error('start_place') is-invalid @enderror" 
                      rows="5" 
                      required>{{ old('start_place')?old('start_place'):$work->start_place }}</textarea>
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
                      required>{{ old('end_place')?old('end_place'):$work->end_place }}</textarea>
            @error('end_place')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3  w-50">
            <label for="recipient_name" class="form-label">Címzett neve:</label>
            <input type="text" 
                   name="recipient_name" 
                   id="recipient_name" 
                   class="form-control @error('recipient_name') is-invalid @enderror" 
                   value="{{ old('recipient_name')?old('recipient_name'):$work->recipient_name }}" 
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
                   value="{{ old('recipient_phone')?old('recipient_phone'):$work->recipient_phone }}" 
                   required>
            @error('recipient_phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 w-50">
            {{ $carrierVarieble = old('carrier')?old('carrier'):(isset($work->carrier)?$work->carrier:0)}}
            {{ $carrierVarieble }}
            <label for="carrier" class="form-label">Hozzárendelt Fuvaros:</label>
            <select name="carrier" 
                   id="carrier" 
                   class="form-control @error('carrier') is-invalid @enderror" 
                   required>
            @if (is_array($carriers) || is_object($carriers))
                @if ($carrierVarieble == 0)
                    <option value="0" selected>---</option>
                @else
                    <option value="0">---</option>
                @endif
                    @foreach ($carriers as $carrier)
                        @if ($carrierVarieble == $carrier->id))
                            <option value="{{ $carrier->id }}" selected>{{ $carrier->name }}</option>
                        @else
                            <option value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                        @endif
                    @endforeach    
            @endif 
            </select>
            @error('carrier')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 w-50">
            {{ $statusVarieble = old('status')?old('status'):(isset($work->status)?$work->status:0)}}
            {{ $statusVarieble }}
            <label for="status" class="form-label">Státisza:</label>
            <select name="status" 
                   id="status" 
                   class="form-control @error('status') is-invalid @enderror" 
                   required>
                    
            @if (is_array($statuses) || is_object($statuses))
                @if ($statusVarieble == 0)
                    <option value="0" selected>---</option>
                @else
                    <option value="0">---</option>
                @endif
                    @foreach ($statuses as $status)
                        @if ($statusVarieble == $status->id))
                            <option value="{{ $status->id }}" @selected($statusVarieble)>{{ $status->name }}</option>
                        @else
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endif
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
