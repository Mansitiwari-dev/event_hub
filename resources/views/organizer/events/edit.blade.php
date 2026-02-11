@extends('layouts.dashboard')

@section('title','Edit Event')

@section('content')
<style>
    .edit-wrapper{
        max-width:1100px;
        margin:auto;
        padding:30px;
        font-family: 'Segoe UI', sans-serif;
    }
    .edit-card{
        background:#fff;
        padding:30px;
        border-radius:14px;
        box-shadow:0 12px 30px rgba(0,0,0,0.08);
    }
    .edit-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }
    .edit-header h2{
        font-size:26px;
        font-weight:700;
        color:#111827;
    }
    .action-btn a, .action-btn button{
        padding:8px 14px;
        border-radius:8px;
        border:none;
        text-decoration:none;
        font-size:14px;
        cursor:pointer;
    }
    .btn-view{ background:#e5e7eb; color:#111;}
    .btn-delete{ background:#dc2626; color:#fff;}
    .form-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:20px;
        margin-top:20px;
    }
    .form-group{
        display:flex;
        flex-direction:column;
    }
    .form-group label{
        font-weight:600;
        margin-bottom:6px;
        color:#374151;
    }
    .form-group input,
    .form-group select,
    .form-group textarea{
        padding:10px;
        border-radius:8px;
        border:1px solid #d1d5db;
        font-size:14px;
    }
    textarea{ resize:none; }
    .full{ grid-column:1 / -1; }

    .status-badge{
        display:inline-block;
        padding:6px 12px;
        border-radius:20px;
        font-size:13px;
        font-weight:600;
        background:#fef3c7;
        color:#92400e;
    }
    .submit-btn{
        margin-top:30px;
        background:#2563eb;
        color:#fff;
        padding:12px 22px;
        border:none;
        border-radius:10px;
        font-size:15px;
        cursor:pointer;
    }
    .error-box{
        background:#fee2e2;
        padding:15px;
        border-radius:10px;
        margin-bottom:20px;
        color:#7f1d1d;
    }
</style>

<div class="edit-wrapper">

    <!-- HEADER -->
    <div class="edit-header">
        <h2>✏️ Edit Event</h2>
        <div class="action-btn">
            <a href="{{ route('organizer.events.show',$event) }}" class="btn-view">👁 View</a>

            <form action="{{ route('organizer.events.destroy',$event) }}" method="POST" style="display:inline"
                  onsubmit="return confirm('Delete this event permanently?');">
                @csrf
                @method('DELETE')
                <button class="btn-delete">🗑 Delete</button>
            </form>
        </div>
    </div>

    <!-- ERRORS -->
    @if($errors->any())
        <div class="error-box">
            <strong>{{ $errors->count() }} error(s) found:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <div class="edit-card">
        <form action="{{ route('organizer.events.update',$event) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" value="{{ old('title',$event->title) }}">
                </div>

                <div class="form-group">
                    <label>Event Type</label>
                    <select name="event_type">
                        <option>Birthday</option>
                        <option>Wedding</option>
                        <option>Corporate</option>
                        <option>Party</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Description</label>
                    <textarea rows="3" name="description">{{ old('description',$event->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date',$event->start_date) }}">
                </div>

                <div class="form-group">
                    <label>End Date</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date',$event->end_date) }}">
                </div>

                <div class="form-group full">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location',$event->location) }}">
                </div>

                <div class="form-group">
                    <label>Guest Count</label>
                    <input type="number" name="guest_count" value="{{ old('guest_count',$event->guest_count) }}">
                </div>

                <div class="form-group">
                    <label>Budget ($)</label>
                    <input type="number" step="0.01" name="budget" value="{{ old('budget',$event->budget) }}">
                </div>

                <div class="form-group full">
                    <label>Status</label>
                    <span class="status-badge">{{ ucfirst($event->status) }}</span>
                </div>

            </div>

            <button class="submit-btn">💾 Update Event</button>
        </form>
    </div>

</div>
@endsection
