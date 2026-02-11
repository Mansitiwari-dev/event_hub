@extends('layouts.dashboard')

@section('title', 'Users')
@section('page-title', 'All Users')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span style="background: #e1e8ed; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ optional($user->role)->name }}</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.deleteUser', $user) }}" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">Delete</button>
                            </form>
                        @else
                            <span style="color: #7f8c8d; font-size: 12px;">(Your account)</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center; color: #7f8c8d;">No users found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection