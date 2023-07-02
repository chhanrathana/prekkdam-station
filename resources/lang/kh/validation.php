<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute must be accepted.',
    'active_url' => ':attribute is not a valid URL.',
    'after' => ':attribute must be a date after :date.',
    'after_or_equal' => ':attribute must be a date after or equal to :date.',
    'alpha' => ':attribute may only contain letters.',
    'alpha_dash' => ':attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => ':attribute may only contain letters and numbers.',
    'array' => ':attribute must be an array.',
    'before' => ':attribute must be a date before :date.',
    'before_or_equal' => ':attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => ':attribute must be between :min and :max.',
        'file' => ':attribute must be between :min and :max kilobytes.',
        'string' => ':attribute must be between :min and :max characters.',
        'array' => ':attribute must have between :min and :max items.',
    ],
    'boolean' => ':attribute field must be true or false.',
    'confirmed' => ':attribute confirmation does not match.',
    'date' => ':attribute is not a valid date.',
    'date_equals' => ':attribute must be a date equal to :date.',
    'date_format' => ':attribute មិនត្រឹមត្រូវ :format.',
    'different' => ':attribute and :other must be different.',
    'digits' => ':attribute must be :digits digits.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'dimensions' => ':attribute has invalid image dimensions.',
    'distinct' => ':attribute field has a duplicate value.',
    'email' => ':attribute must be a valid email address.',
    'ends_with' => ':attribute must end with one of following: :values',
    'exists' => 'selected :attribute is invalid.',
    'file' => ':attribute must be a file.',
    'filled' => ':attribute field must have a value.',
    'gt' => [
        'numeric' => ':attribute ចាំបាច់ត្រូវធំជាង :value.',
        'file' => ':attribute ចាំបាច់ត្រូវធំជាង :value kilobytes.',
        'string' => ':attribute ចាំបាច់ត្រូវធំជាង :value characters.',
        'array' => ':attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute ចាំបាច់ត្រូវធំជាង or equal :value.',
        'file' => ':attribute ចាំបាច់ត្រូវធំជាង or equal :value kilobytes.',
        'string' => ':attribute ចាំបាច់ត្រូវធំជាង or equal :value characters.',
        'array' => ':attribute must have :value items or more.',
    ],
    'image' => ':attribute must be an image.',
    'in' => 'selected :attribute is invalid.',
    'in_array' => ':attribute field does not exist in :other.',
    'integer' => ':attribute must be an integer.',
    'ip' => ':attribute must be a valid IP address.',
    'ipv4' => ':attribute must be a valid IPv4 address.',
    'ipv6' => ':attribute must be a valid IPv6 address.',
    'json' => ':attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => ':attribute must be less than :value.',
        'file' => ':attribute must be less than :value kilobytes.',
        'string' => ':attribute must be less than :value characters.',
        'array' => ':attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute must be less than or equal :value.',
        'file' => ':attribute must be less than or equal :value kilobytes.',
        'string' => ':attribute must be less than or equal :value characters.',
        'array' => ':attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute may not be greater than :max.',
        'file' => ':attribute may not be greater than :max kilobytes.',
        'string' => ':attribute may not be greater than :max characters.',
        'array' => ':attribute may not have more than :max items.',
    ],
    'mimes' => ':attribute must be a file of type: :values.',
    'mimetypes' => ':attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute must be at least :min.',
        'file' => ':attribute must be at least :min kilobytes.',
        'string' => ':attribute must be at least :min characters.',
        'array' => ':attribute must have at least :min items.',
    ],
    'not_in' => 'selected :attribute is invalid.',
    'not_regex' => ':attribute format is invalid.',
    'numeric' => ':attribute must be a number.',
    'present' => ':attribute field must be present.',
    'regex' => ':attribute format is invalid.',
    'required' => ':attribute ចាំបាច់ត្រូវបញ្ចូល!',
    'required_if' => ':attribute field is required when :other is :value.',
    'required_unless' => ':attribute field is required unless :other is in :values.',
    'required_with' => ':attribute field is required when :values is present.',
    'required_with_all' => ':attribute field is required when :values are present.',
    'required_without' => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same' => ':attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute must be :size.',
        'file' => ':attribute must be :size kilobytes.',
        'string' => ':attribute must be :size characters.',
        'array' => ':attribute must contain :size items.',
    ],
    'starts_with' => ':attribute must start with one of following: :values',
    'string' => ':attribute must be a string.',
    'timezone' => ':attribute must be a valid zone.',
    'unique' => ':attribute has already been taken.',
    'uploaded' => ':attribute failed to upload.',
    'url' => ':attribute format is invalid.',
    'uuid' => ':attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name_kh' => 'ឈ្មោះខ្មែរ',
        'name_en' => 'ឈ្មោះឡាតាំង',
        'name' => 'ឈ្មោះ',
        'sex' => 'ភេទ',
        'phone_number' => 'លេខទូរសព្ទ',
        'date_of_birth' => 'ថ្ងៃកំណើត',
        'start_work_date' => 'ថ្ងៃខែឆ្នាំចូលបម្រើការងារ',
        'status' => 'សភាព',
        'province_id' => 'ខេត្ត',
        'district_id' => 'ស្រុក',
        'commune_id' => 'ឃុំ',
        'village_id' => 'ភូមិ',
        'principal_amount' => 'ប្រាក់កម្ចី',
        'term' => 'រយៈពេល',
        'staff_id' => 'មន្រ្តីឥណទាន',
        'total_paid_amount' => 'ប្រាក់បានបង់',
        'registration_date' => 'ថ្ងៃខ្ចី',
        'finish_end_interest_date' => 'ថ្ងៃផ្តាច់',
        'transaction_amount' => 'ចំនួនទឹកប្រាក់',
        'amount' => 'ទឹកប្រាក់ចំណាយ',
        'description' => 'ពណ៍នា',
        'expense_type_id' => 'ប្រភេទចំណាយ',
        'branch_id' => 'សាខា',
        'deposit_amount' => 'ទឹកប្រាក់',
        'id_card_no ' => 'អត្តសញ្ញាណប័ណ្ណ',
        'start_end_interest_date' => 'ថ្ងៃបង់ការដំបូង',
        'loan_type_id' => 'ប្រភេកម្ចី',
        'deposit_type_id' => 'ប្រភេសន្សំ',
        'start_interest_date' => 'ថ្ងៃគិតការដំបូង',
        'interest_rate' => 'ការប្រាក់',
        'interest_paid_amount' => 'ការប្រាក់',
        'deduct_paid_amount' => 'រលស់ដើម',
        'oil_type_id' => 'ប្រភេទឥន្ទនៈ',
        'cost_usd' => 'តម្លៃដើម',
        'qty_ton' => 'បរិមាណ',
        'work_shift_id' => 'វេនធ្វើការ',
        'oil_purchase_id' => 'ប្រភេទឥន្ទនៈ',
        'old_motor_right' => 'លេខកុងទ័រចាស់',
        'old_motor_left' => 'លេខកុងទ័រចាស់',
        'new_motor_left' => 'លេខកុងទ័រថ្មី',
        'new_motor_right' => 'លេខកុងទ័រថ្មី',
        'vendor_id' => 'អ្នកផ្គត់ផ្គង់',
        'status_id' => 'សភាព',
        'staff_id' => 'បុគ្គលិក',
],

];