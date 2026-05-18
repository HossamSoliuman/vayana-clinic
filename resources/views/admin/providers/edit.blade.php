@extends('layouts.admin')

@section('title', 'Edit Provider')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.providers.index') }}" class="inline-flex items-center gap-1 text-sm text-primary hover:text-primary-hover">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 18l-6-6 6-6"/></svg>
        {{ __('messages.back') }}
    </a>
    <h2 class="text-2xl font-bold text-text mt-4">{{ __('messages.edit_provider') }}</h2>
</div>

<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.providers.update', $provider) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-text mb-2">{{ __('messages.email') }}</label>
                    <input type="email" id="email" class="w-full rounded-lg border border-border bg-surface-secondary px-3 py-2 text-sm text-text-muted cursor-not-allowed" value="{{ $provider->user->email }}" disabled>
                    <p class="text-xs text-text-muted mt-1">Email cannot be changed</p>
                </div>

                <div>
                    <label for="license_number" class="block text-sm font-medium text-text mb-2">{{ __('messages.license') }}</label>
                    <input type="text" id="license_number" class="w-full rounded-lg border border-border bg-surface-secondary px-3 py-2 text-sm text-text-muted cursor-not-allowed" value="{{ $provider->license_number }}" disabled>
                    <p class="text-xs text-text-muted mt-1">License cannot be changed</p>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-text mb-2">{{ __('messages.title') }} *</label>
                    <select id="title" name="title" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('title') border-red-500 @enderror" required>
                        <option value="Dr" {{ old('title', $provider->title) === 'Dr' ? 'selected' : '' }}>Dr</option>
                        <option value="Mr" {{ old('title', $provider->title) === 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Ms" {{ old('title', $provider->title) === 'Ms' ? 'selected' : '' }}>Ms</option>
                        <option value="Mrs" {{ old('title', $provider->title) === 'Mrs' ? 'selected' : '' }}>Mrs</option>
                    </select>
                    @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="years_of_experience" class="block text-sm font-medium text-text mb-2">{{ __('messages.years_of_experience') }} *</label>
                    <input type="number" id="years_of_experience" name="years_of_experience" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('years_of_experience') border-red-500 @enderror" value="{{ old('years_of_experience', $provider->years_of_experience) }}" min="0" max="70" required>
                    @error('years_of_experience') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-text mb-2">{{ __('messages.image') }}</label>
                    @if($provider->photo_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$provider->photo_path) }}" alt="Provider photo" class="h-32 w-32 object-cover rounded-lg border border-border">
                        </div>
                    @endif
                    <input type="file" id="photo" name="photo" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('photo') border-red-500 @enderror" accept="image/*">
                    @error('photo') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="first_name_en" class="block text-sm font-medium text-text mb-2">{{ __('messages.first_name_en') }} *</label>
                    <input type="text" id="first_name_en" name="first_name_en" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('first_name_en') border-red-500 @enderror" value="{{ old('first_name_en', $provider->user->first_name_en) }}" required>
                    @error('first_name_en') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="last_name_en" class="block text-sm font-medium text-text mb-2">{{ __('messages.last_name_en') }} *</label>
                    <input type="text" id="last_name_en" name="last_name_en" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('last_name_en') border-red-500 @enderror" value="{{ old('last_name_en', $provider->user->last_name_en) }}" required>
                    @error('last_name_en') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="first_name_ar" class="block text-sm font-medium text-text mb-2">{{ __('messages.first_name_ar') }}</label>
                    <input type="text" id="first_name_ar" name="first_name_ar" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('first_name_ar') border-red-500 @enderror" value="{{ old('first_name_ar', $provider->user->first_name_ar) }}" dir="rtl">
                    @error('first_name_ar') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="last_name_ar" class="block text-sm font-medium text-text mb-2">{{ __('messages.last_name_ar') }}</label>
                    <input type="text" id="last_name_ar" name="last_name_ar" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('last_name_ar') border-red-500 @enderror" value="{{ old('last_name_ar', $provider->user->last_name_ar) }}" dir="rtl">
                    @error('last_name_ar') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="work_type" class="block text-sm font-medium text-text mb-2">{{ __('messages.work_type') }} *</label>
                    <select id="work_type" name="work_type" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('work_type') border-red-500 @enderror" required>
                        <option value="online" {{ old('work_type', $provider->work_type) === 'online' ? 'selected' : '' }}>Online</option>
                        <option value="in_person" {{ old('work_type', $provider->work_type) === 'in_person' ? 'selected' : '' }}>In-Person</option>
                        <option value="hybrid" {{ old('work_type', $provider->work_type) === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    @error('work_type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="session_price_online" class="block text-sm font-medium text-text mb-2">{{ __('messages.session_price_online') }} (USD) *</label>
                    <input type="number" id="session_price_online" name="session_price_online" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('session_price_online') border-red-500 @enderror" value="{{ old('session_price_online', $provider->session_price_online) }}" step="0.01" min="0" required>
                    @error('session_price_online') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="session_price_inperson" class="block text-sm font-medium text-text mb-2">{{ __('messages.session_price_inperson') }} (USD) *</label>
                    <input type="number" id="session_price_inperson" name="session_price_inperson" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('session_price_inperson') border-red-500 @enderror" value="{{ old('session_price_inperson', $provider->session_price_inperson) }}" step="0.01" min="0" required>
                    @error('session_price_inperson') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="biography_en" class="block text-sm font-medium text-text mb-2">{{ __('messages.biography_en') }} *</label>
                <textarea id="biography_en" name="biography_en" rows="4" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('biography_en') border-red-500 @enderror" required>{{ old('biography_en', $provider->biography_en) }}</textarea>
                @error('biography_en') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="biography_ar" class="block text-sm font-medium text-text mb-2">{{ __('messages.biography_ar') }}</label>
                <textarea id="biography_ar" name="biography_ar" rows="4" dir="rtl" class="w-full rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('biography_ar') border-red-500 @enderror">{{ old('biography_ar', $provider->biography_ar) }}</textarea>
                @error('biography_ar') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="specialties" class="block text-sm font-medium text-text mb-2">{{ __('messages.specialties') }} *</label>
                <div class="space-y-2">
                    @foreach($specialties as $specialty)
                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}" class="rounded border-border" {{ in_array($specialty->id, old('specialties', $provider->specialties->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <span class="text-sm text-text">{{ $specialty->name_en }} ({{ $specialty->name_ar }})</span>
                        </label>
                    @endforeach
                </div>
                @error('specialties') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
                @error('specialties.*') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-text mb-2">{{ __('messages.languages') }} *</label>
                <div id="languages-container" class="space-y-2">
                    @forelse(old('languages', $provider->languages->pluck('language')->toArray()) as $index => $language)
                        <div class="flex gap-2">
                            <select name="languages[]" class="flex-1 rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                <option value="">Select language...</option>
                                <option value="arabic" {{ $language === 'arabic' ? 'selected' : '' }}>Arabic</option>
                                <option value="english" {{ $language === 'english' ? 'selected' : '' }}>English</option>
                                <option value="french" {{ $language === 'french' ? 'selected' : '' }}>French</option>
                                <option value="other" {{ $language === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <button type="button" onclick="removeLanguage(this)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">Remove</button>
                        </div>
                    @empty
                        <div class="flex gap-2">
                            <select name="languages[]" class="flex-1 rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                <option value="">Select language...</option>
                                <option value="arabic">Arabic</option>
                                <option value="english">English</option>
                                <option value="french">French</option>
                                <option value="other">Other</option>
                            </select>
                            <button type="button" onclick="removeLanguage(this)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">Remove</button>
                        </div>
                    @endforelse
                </div>
                <button type="button" onclick="addLanguage()" class="mt-2 text-sm text-primary hover:text-primary-hover">+ Add Language</button>
                @error('languages') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
                @error('languages.*') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <label class="flex items-center gap-2">
                    <input type="hidden" name="is_verified" value="0">
                    <input type="checkbox" name="is_verified" value="1" class="rounded border-border" {{ old('is_verified', $provider->is_verified) ? 'checked' : '' }}>
                    <span class="text-sm text-text">{{ __('messages.verified') }}</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="hidden" name="is_available" value="0">
                    <input type="checkbox" name="is_available" value="1" class="rounded border-border" {{ old('is_available', $provider->is_available) ? 'checked' : '' }}>
                    <span class="text-sm text-text">{{ __('messages.available') }}</span>
                </label>
            </div>

            <div class="flex gap-3 pt-4 border-t border-border">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">{{ __('messages.update') }}</button>
                <a href="{{ route('admin.providers.index') }}" class="px-4 py-2 bg-surface-secondary text-text rounded-lg hover:bg-surface-secondary/80 transition-colors">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</div>

<script>
function addLanguage() {
    const container = document.getElementById('languages-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <select name="languages[]" class="flex-1 rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            <option value="">Select language...</option>
            <option value="arabic">Arabic</option>
            <option value="english">English</option>
            <option value="french">French</option>
            <option value="other">Other</option>
        </select>
        <button type="button" onclick="removeLanguage(this)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">Remove</button>
    `;
    container.appendChild(div);
}

function removeLanguage(btn) {
    btn.parentElement.remove();
}
</script>
@endsection
