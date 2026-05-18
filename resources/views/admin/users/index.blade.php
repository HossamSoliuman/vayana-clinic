@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Users</h2>
</div>

<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <select name="role" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="provider" {{ request('role') === 'provider' ? 'selected' : '' }}>Provider</option>
                    <option value="client" {{ request('role') === 'client' ? 'selected' : '' }}>Client</option>
                </select>
            </div>
            <div class="w-full sm:w-64">
                <input type="text" name="search" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" placeholder="Search users..." value="{{ request('search') }}">
            </div>
            <div>
                <button type="submit" class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </button>
            </div>
        </form>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Name</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Role</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Joined</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $user->full_name }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'super_admin' ? 'bg-red-50 text-red-700' : ($user->role === 'admin' ? 'bg-amber-50 text-amber-700' : ($user->role === 'provider' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700')) }}">{{ $user->role }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-text">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                    <form action="{{ route('admin.users.status', $user) }}" method="POST" class="inline" onsubmit="return confirm('Toggle user status?')">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $user->is_active ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition-colors">
                                            @if($user->is_active)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect width="4" height="16" x="6" y="4"/><rect width="4" height="16" x="14" y="4"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M20 6 9 17l-5-5"/></svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-text-muted py-8">No users found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection
