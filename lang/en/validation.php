<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute không phải là một URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa các chữ cái, chữ số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa các chữ cái và chữ số.',
    'array' => ':attribute phải là một mảng.',
    'ascii' => ':attribute chỉ được chứa các ký tự và ký hiệu chữ và số một byte.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'array' => ':attribute phải có giữa :min và :max phần tử.',
        'file' => ':attribute phải ở giữa :min và :max kilobytes.',
        'numeric' => ':attribute phải ở giữa :min và :max.',
        'string' => ':attribute phải ở giữa :min và :max ký tự.',
    ],
    'boolean' => ':attribute phải đúng hoặc sai.',
    'confirmed' => ':attribute nhận đinh không phù hợp.',
    'current_password' => 'password không đúng.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không phù hợp với định dạng :format.',
    'decimal' => ':attribute phải có :decimal chữ số thập phân.',
    'declined' => ':attribute phải bị từ chối.',
    'declined_if' => ':attribute phải bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác.',
    'digits' => ':attribute cần phải :digits chữ số.',
    'digits_between' => ':attribute phải ở giữa :min và :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => ':attribute có giá trị trùng lặp.',
    'doesnt_end_with' => ':attribute không thể kết thúc bằng một trong những điều sau đây: :values.',
    'doesnt_start_with' => ':attribute không thể bắt đầu bằng một trong những điều sau đây: :values.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong những điều sau đây: :values.',
    'enum' => 'đã chọn :attribute không hợp lệ.',
    'exists' => 'đã chọn :attribute không hợp lệ.',
    'file' => ':attribute phải là một tập tin.',
    'filled' => ':attribute phải có giá trị.',
    'gt' => [
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn :value.',
        'string' => ':attribute phải lớn hơn :value ký tự.',
    ],
    'gte' => [
        'array' => ':attribute must have :value phần tử hoặc hơn.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => 'selected :attribute không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lowercase' => ':attribute phải là chữ thường.',
    'lt' => [
        'array' => ':attribute phải có ít hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'string' => ':attribute phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => ':attribute không được có nhiều hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => ':attribute phải nhỏ hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => ':attribute phải là địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => ':attribute không được có nhiều hơn :max chữ số.',
    'mimes' => ':attribute phải là một loại tệp: :values.',
    'mimetypes' => ':attribute phải là một loại tệp: :values.',
    'min' => [
        'array' => ':attribute phải có ít nhất :min phần tử.',
        'file' => ':attribute ít nhất phải có :min kilobytes.',
        'numeric' => ':attribute ít nhất phải có :min.',
        'string' => ':attribute ít nhất phải có :min ký tự.',
    ],
    'min_digits' => ':attribute phải có ít nhất :min chữ số.',
    'missing' => ':attribute bị thiếu.',
    'missing_if' => ':attribute bị thiếu khi :other là :value.',
    'missing_unless' => ':attribute bị thiếu trừ khi :other là :value.',
    'missing_with' => ':attribute bị thiếu khi :values có mặt.',
    'missing_with_all' => ':attribute bị thiếu khi :values có mặt.',
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => 'đã chọn :attribute không hợp lệ.',
    'not_regex' => ':attribute định dạng không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => [
        'letters' => ':attribute phải chứa ít nhất một chữ cái.',
        'mixed' => ':attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => ':attribute phải chứa ít nhất một số.',
        'symbols' => ':attribute phải chứa ít nhất một ký hiệu.',
        'uncompromised' => 'được cho là :attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một cái khác :attribute.',
    ],
    'present' => ':attribute phải có mặt.',
    'prohibited' => ':attribute bị cấm.',
    'prohibited_if' => ':attribute bị cấm khi :other là :value.',
    'prohibited_unless' => ':attribute bị cấm trước khi :other nằm trong :values.',
    'prohibits' => ':attribute cấm cho giá trị của :other xuất hiện.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => ':attribute là bắt buộc.',
    'required_array_keys' => ':attribute phải chứa các mục nhập cho: :values.',
    'required_if' => ':attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => ':attribute là bắt buộc khi :other được chấp nhận.',
    'required_unless' => ':attribute là bắt buộc trước khi :other nằm trong :values.',
    'required_with' => ':attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => ':attribute là bắt buộc khi :values có mặt.',
    'required_without' => ':attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => ':attribute là bắt buộc khi không có trường nào trong số  :values có mặt.',
    'same' => ':attribute và :other phải phù hợp.',
    'size' => [
        'array' => ':attribute phải chứa :size phần tử.',
        'file' => ':attribute cần phải :size kilobytes.',
        'numeric' => ':attribute cần phải :size.',
        'string' => ':attribute cần phải :size ký tự.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong những điều sau đây: :values.',
    'string' => ':attribute phải là một chuỗi.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => ':attribute đã được thực hiện rồi.',
    'uploaded' => ':attribute không thể tải lên.',
    'uppercase' => ':attribute phải là chữ hoa.',
    'url' => ':attribute phải là một URL hợp lệ.',
    'ulid' => ':attribute phải là ULID hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
