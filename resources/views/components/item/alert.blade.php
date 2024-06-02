<div @class([
    'alert-success' => $status == 'success',
    'alert-danger' => 'failed',
])>
    <p>{{ $message }}</p>
</div>
