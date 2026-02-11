@csrf

<div class="space-y-6">
    <!-- Basic Information -->
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Event Information</h3>
                <p class="mt-1 text-sm text-gray-500">Basic details about your event.</p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title ?? '') }}" required
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event Type -->
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
                        <select id="event_type" name="event_type"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="conference" {{ (old('event_type', $event->event_type ?? '') == 'conference') ? 'selected' : '' }}>Conference</option>
                            <option value="workshop" {{ (old('event_type', $event->event_type ?? '') == 'workshop') ? 'selected' : '' }}>Workshop</option>
                            <option value="seminar" {{ (old('event_type', $event->event_type ?? '') == 'seminar') ? 'selected' : '' }}>Seminar</option>
                            <option value="meetup" {{ (old('event_type', $event->event_type ?? '') == 'meetup') ? 'selected' : '' }}>Meetup</option>
                            <option value="concert" {{ (old('event_type', $event->event_type ?? '') == 'concert') ? 'selected' : '' }}>Concert</option>
                            <option value="other" {{ (old('event_type', $event->event_type ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Select a category</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $event->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Date & Time -->
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                        <input type="datetime-local" name="start_date" id="start_date" 
                            value="{{ old('start_date', isset($event->start_date) ? $event->start_date->format('Y-m-d\TH:i') : '') }}" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                        <input type="datetime-local" name="end_date" id="end_date" 
                            value="{{ old('end_date', isset($event->end_date) ? $event->end_date->format('Y-m-d\TH:i') : '') }}" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location & Venue -->
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Location & Venue</h3>
                <p class="mt-1 text-sm text-gray-500">Where is your event taking place?</p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
                <!-- Online Event Toggle -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="is_online" name="is_online" type="checkbox" value="1" 
                            {{ old('is_online', $event->is_online ?? false) ? 'checked' : '' }}
                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_online" class="font-medium text-gray-700">This is an online event</label>
                        <p class="text-gray-500">Check this if your event is happening online.</p>
                    </div>
                </div>

                <!-- Online Link (Conditional) -->
                <div id="onlineLinkField" class="hidden">
                    <label for="online_link" class="block text-sm font-medium text-gray-700">Online Event Link</label>
                    <div class="mt-1">
                        <input type="url" name="online_link" id="online_link" 
                            value="{{ old('online_link', $event->online_link ?? '') }}"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="https://">
                        @error('online_link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-2 text-sm text-gray-500">URL where participants can join the event.</p>
                </div>

                <!-- Physical Location (Conditional) -->
                <div id="physicalLocationFields">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" 
                                value="{{ old('location', $event->location ?? '') }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="venue" class="block text-sm font-medium text-gray-700">Venue Name</label>
                            <input type="text" name="venue" id="venue" 
                                value="{{ old('venue', $event->venue ?? '') }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('venue')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-gray-700">Full Address</label>
                        <textarea id="address" name="address" rows="3"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('address', $event->address ?? '') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Full address including city, state, and country.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Image -->
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Event Image</h3>
                <p class="mt-1 text-sm text-gray-500">A beautiful image that represents your event.</p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                @if(isset($event) && $event->image_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="Current event image" class="h-32 w-auto rounded-lg">
                    </div>
                @endif
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Event Settings -->
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Event Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure your event settings.</p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Maximum Capacity</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="capacity" id="capacity" min="1" 
                                value="{{ old('capacity', $event->capacity ?? '') }}" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">people</span>
                            </div>
                        </div>
                        @error('capacity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price per ticket</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" min="0" step="0.01" 
                                value="{{ old('price', $event->price ?? '0') }}" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">USD</span>
                            </div>
                        </div>
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Publish Toggle -->
                <div class="flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        {{ old('is_published', $event->is_published ?? false) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_published" class="ml-2 block text-sm text-gray-900">
                        Publish this event
                    </label>
                </div>
                <p class="text-sm text-gray-500">
                    Unpublished events are only visible to you. You can publish it later.
                </p>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex justify-end">
        <a href="{{ route('organizer.events.index') }}" 
            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Cancel
        </a>
        <button type="submit" 
            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            {{ isset($event) ? 'Update Event' : 'Create Event' }}
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Toggle online/offline fields
    const isOnlineCheckbox = document.getElementById('is_online');
    const onlineLinkField = document.getElementById('onlineLinkField');
    const physicalLocationFields = document.getElementById('physicalLocationFields');
    const onlineLinkInput = document.getElementById('online_link');

    function toggleLocationFields() {
        if (isOnlineCheckbox.checked) {
            onlineLinkField.classList.remove('hidden');
            physicalLocationFields.classList.add('hidden');
            onlineLinkInput.required = true;
        } else {
            onlineLinkField.classList.add('hidden');
            physicalLocationFields.classList.remove('hidden');
            onlineLinkInput.required = false;
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleLocationFields();
        
        // Add event listener for changes
        isOnlineCheckbox.addEventListener('change', toggleLocationFields);
    });
</script>
@endpush
