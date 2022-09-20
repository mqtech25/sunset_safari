<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Payment Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="square_payment_method"><strong>Square Payment Method</strong></label>
                <select name="square_payment_method" id="square_payment_method" class="form-control">
                    <option value="1" {{ (config('settings.square_payment_method')) == 1 ? 'selected' : '' }}>Enabled</option>
                    <option value="0" {{ (config('settings.square_payment_method')) == 0 ? 'selected' : '' }}>Disabled</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="square-app-id">Square Application ID</label>
                <input class="form-control" type="text" placeholder="Enter square application ID" id="square-app-id" name="square-app-id"
                    value="{{ config('settings.square-app-id') }}"
                />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="square-access-token">Square Access Token</label>
                <input class="form-control" type="text" placeholder="Enter square access token" id="square-access-token" name="square-access-token"
                    value="{{ config('settings.square-access-token') }}"
                />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="square-location-id">Square Location ID</label>
                <input class="form-control" type="text" placeholder="Enter square location ID" id="square-location-id" name="square-location-id"
                    value="{{ config('settings.square-location-id') }}"
                />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="square-mode">Square Mode</label>
                <select name="square-mode" id="square-mode" class="form-control">
                    <option value="sandbox" {{ (config('settings.square-mode')=='sandbox')? 'selected' : '' }}>Sandbox</option>
                    <option value="production" {{ (config('settings.square-mode')=='production')? 'selected' : '' }}>Production</option>
                </select>
            </div>
            <hr>
            <div class="form-group pt-2">
                <label class="control-label" for="paypal_payment_method"><strong>PayPal Payment Method</strong></label>
                <select name="paypal_payment_method" id="paypal_payment_method" class="form-control">
                    <option value="1" {{ (config('settings.paypal_payment_method')) == 1 ? 'selected' : '' }}>Enabled</option>
                    <option value="0" {{ (config('settings.paypal_payment_method')) == 0 ? 'selected' : '' }}>Disabled</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="paypal_client_id">Client ID</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter paypal client Id"
                    id="paypal_client_id"
                    name="paypal_client_id"
                    value="{{ config('settings.paypal_client_id') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="paypal_secret_id">Secret ID</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter paypal secret id"
                    id="paypal_secret_id"
                    name="paypal_secret_id"
                    value="{{ config('settings.paypal_secret_id') }}"
                />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="paypal-mode">Paypal Mode</label>
                <select name="paypal_mode" id="paypal_mode" class="form-control">
                    <option value="sandbox" {{ (config('settings.paypal-mode')=='sandbox')? 'selected' : '' }}>Sandbox</option>
                    <option value="production" {{ (config('settings.paypal-mode')=='production')? 'selected' : '' }}>Production</option>
                </select>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>