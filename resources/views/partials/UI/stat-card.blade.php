<!-- resources/views/partials/ui/stat-card.blade.php -->
@props(['icon', 'title', 'value', 'change' => null, 'color' => 'primary'])

<div class="card stat-card bg-{{ $color }}-bg-opacity-10 border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-muted mb-2">{{ $title }}</h6>
                <h3 class="mb-0">{{ $value }}</h3>
                @if($change)
                    <small class="text-{{ str_starts_with($change, '+') ? 'success' : 'danger' }}">
                        {{ $change }} from last month
                    </small>
                @endif
            </div>
            <div class="stat-icon text-{{ $color }}">
                <i class="bi bi-{{ $icon }}"></i>
            </div>
        </div>
    </div>
</div>