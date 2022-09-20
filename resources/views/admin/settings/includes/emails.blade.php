<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Contact Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_to_email">To Email</label>
                        <input class="form-control" type="email" placeholder="Enter To Email" id="contect_smtp_to_email" name="contect_smtp_to_email"
                        value="{{ config('settings.contect_smtp_to_email') }}" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_mail_driver">Mail Driver</label>
                        <select name="contect_smtp_mail_driver" id="contect_smtp_mail_driver" class="form-control">
                            <option value="smtp" {{ (config('settings.contect_smtp_mail_driver'))=='smtp' ? 'selected':'' }}>SMTP</option>
                            <option value="webmail" {{ (config('settings.contect_smtp_mail_driver'))=='webmail' ? 'selected':'' }}>WebMail</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_port">Port Number</label>
                        <input class="form-control" type="text" placeholder="Enter Port Number" id="contect_smtp_port" name="contect_smtp_port"
                        value="{{ config('settings.contect_smtp_port') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_host">Host</label>
                        <input class="form-control" type="text" placeholder="Enter Host" id="contect_smtp_host" name="contect_smtp_host"
                        value="{{ config('settings.contect_smtp_host') }}" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_encryption">Encryption</label>
                        <select name="contect_smtp_encryption" id="contect_smtp_encryption" class="form-control">
                            <option value="tls" {{ (config('settings.contect_smtp_encryption'))=='tls' ? 'selected':'' }}>TLS</option>
                            <option value="ssl" {{ (config('settings.contect_smtp_encryption'))=='ssl' ? 'selected':'' }}>SSL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_user">User Name</label>
                        <input class="form-control" type="text" placeholder="Enter Username" id="contect_smtp_user" name="contect_smtp_user"
                        value="{{ config('settings.contect_smtp_user') }}" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="contect_smtp_pass">Password</label>
                        <input class="form-control" type="password" placeholder="Enter Password To Update" id="contect_smtp_pass" name="contect_smtp_pass"
                        value="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Contact Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>