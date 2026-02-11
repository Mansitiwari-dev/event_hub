@extends('layouts.dashboard')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Event Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
            @error('title') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
            @error('description') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Event Type</label>
            <select name="event_type" required>
                <option value="">-- Select Type --</option>
                <option value="wedding" {{ old('event_type', $event->event_type) == 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="birthday" {{ old('event_type', $event->event_type) == 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="corporate" {{ old('event_type', $event->event_type) == 'corporate' ? 'selected' : '' }}>Corporate</option>
                <option value="anniversary" {{ old('event_type', $event->event_type) == 'anniversary' ? 'selected' : '' }}>Anniversary</option>
                <option value="other" {{ old('event_type', $event->event_type) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('event_type') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Start Date</label>
            <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}" required>
            @error('start_date') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>End Date</label>
            <input type="datetime-local" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}" required>
            @error('end_date') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" required>
            @error('location') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Guest Count</label>
            <input type="number" name="guest_count" value="{{ old('guest_count', $event->guest_count) }}" min="0">
            @error('guest_count') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Budget ($)</label>
            <input type="number" name="budget" value="{{ old('budget', $event->budget) }}" min="0" step="0.01">
            @error('budget') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="pending" {{ old('status', $event->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $event->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
