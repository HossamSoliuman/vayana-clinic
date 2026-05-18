@extends('layouts.admin')

@section('title', 'Partners')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.partners') }}</h2>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Add Partner</div>
            <div class="p-6">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Name *</label><input type="text" name="name" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Logo *</label><input type="file" name="logo" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*" required></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.website_u_r_l') }}</label><input type="url" name="website_url" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.display_order') }}</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                    <div class="mb-4 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.active') }}</label></div>
                    <button type="submit" class="w-full px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.add_partner') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="p-6">
                <div class="overflow-x-auto mb-4">
                    <table class="w-full text-sm ltr:text-left rtl:text-right">
                        <thead><tr>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.name') }}</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.logo') }}</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.order') }}</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.active') }}</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.actions') }}</th>
                        </tr></thead>
                        <tbody>
                            @forelse($partners as $partner)
                                <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-text">{{ $partner->name }}</td>
                                    <td class="px-6 py-4 text-sm text-text">@if($partner->logo_path)<img src="{{ asset('storage/'.$partner->logo_path) }}" class="h-10 rounded border border-border bg-white object-contain p-1">@else N/A @endif</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $partner->display_order }}</td>
                                    <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $partner->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $partner->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="px-6 py-4 text-sm text-text">
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" onclick="typeof openModal === 'function' ? openModal('editPartner{{ $partner->id }}') : document.getElementById('editPartner{{ $partner->id }}').classList.remove('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg></button>
                                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button></form>
                                        </div>
                                    </td>
                                </tr>
                                <div id="editPartner{{ $partner->id }}" class="fixed inset-0 z-[100] hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="bg-surface rounded-xl shadow-xl w-full max-w-lg border border-border overflow-hidden">
                                        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                                                <h5 class="font-semibold text-text">{{ __('messages.edit_partner') }}</h5>
                                                <button type="button" class="text-text-muted hover:text-text transition-colors" onclick="typeof closeModal === 'function' ? closeModal('editPartner{{ $partner->id }}') : document.getElementById('editPartner{{ $partner->id }}').classList.add('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                                            </div>
                                            <div class="p-6">
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Name *</label><input type="text" name="name" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $partner->name }}" required></div>
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.logo') }}</label>
                                                    <input type="file" name="logo" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*">
                                                    @if($partner->logo_path)<div class="mt-2"><img src="{{ asset('storage/'.$partner->logo_path) }}" class="h-12 rounded border border-border bg-white object-contain p-1"></div>@endif
                                                </div>
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.website_u_r_l') }}</label><input type="url" name="website_url" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $partner->website_url }}"></div>
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.order') }}</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $partner->display_order }}"></div>
                                                <div class="mb-4 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ $partner->is_active?'checked':'' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.active') }}</label></div>
                                            </div>
                                            <div class="px-6 py-4 border-t border-border bg-surface-secondary flex justify-end gap-3">
                                                <button type="button" class="px-4 py-2 border border-border rounded-lg text-text hover:bg-surface transition-colors text-sm font-medium" onclick="typeof closeModal === 'function' ? closeModal('editPartner{{ $partner->id }}') : document.getElementById('editPartner{{ $partner->id }}').classList.add('hidden')">Cancel</button>
                                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.update') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty<tr><td colspan="5" class="text-center text-text-muted py-8">No partners</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $partners->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
