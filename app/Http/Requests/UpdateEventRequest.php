<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow admins, event managers, and customers who own the event
        if ($this->user()->hasRole('admin')) {
            return true;
        }
        
        if ($this->user()->hasRole('event_manager') && $this->event->event_manager_id === $this->user()->id) {
            return true;
        }
        
        if ($this->user()->hasRole('organizer') && $this->event->customer_id === $this->user()->id) {
            return true;
        }
        
        // Allow customer/creator of the event
        return $this->event->customer_id === $this->user()->id;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert datetime-local format to proper datetime format if needed
        if ($this->has('start_date') && strlen($this->start_date) == 16) {
            $this->merge([
                'start_date' => $this->start_date . ':00',
            ]);
        }
        
        if ($this->has('end_date') && strlen($this->end_date) == 16) {
            $this->merge([
                'end_date' => $this->end_date . ':00',
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|string|max:100',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'required|string|max:255',
            'guest_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Event title is required.',
            'title.max' => 'Event title must not exceed 255 characters.',
            'event_type.required' => 'Event type is required.',
            'event_type.in' => 'Please select a valid event type.',
            'start_date.required' => 'Start date is required.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'end_date.required' => 'End date is required.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            'location.required' => 'Event location is required.',
            'location.max' => 'Location must not exceed 255 characters.',
            'guest_count.integer' => 'Guest count must be a valid number.',
            'budget.numeric' => 'Budget must be a valid number.',
        ];
    }
}
