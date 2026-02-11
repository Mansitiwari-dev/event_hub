@props(['id' => 'modal', 'title' => ''])

<div id="{{ $id }}" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-bold">{{ $title }}</h3>
            <button class="modal-close" onclick="EH.closeModal('{{ $id }}')">&times;</button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>
